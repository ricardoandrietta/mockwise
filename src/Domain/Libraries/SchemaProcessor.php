<?php

declare(strict_types=1);

namespace MockWise\Domain\Libraries;

use Faker\Factory;
use Faker\Generator;
use InvalidArgumentException;
use JsonException;

class SchemaProcessor {

    /**
     * @param string $schema JSON in a string form
     *
     * @return array
     * @throws JsonException|InvalidArgumentException
     */
    public function process(string $schema): array
    {
        if (empty($schema)) {
            return [];
        }

        $decodedSchema = json_decode($schema, true, 512, JSON_THROW_ON_ERROR);
        $this->validate($decodedSchema);
        $locale = $decodedSchema['locale'] ?? Factory::DEFAULT_LOCALE;
        $faker = Factory::create($locale);
        $wrap = false;
        if (isset($decodedSchema['wrap']) && is_string($decodedSchema['wrap'])) {
            $wrap = $decodedSchema['wrap'];
        }
        $repeat = $decodedSchema['repeat'] ?? 1;
        if ($repeat > 100) {
            $repeat = 100;
        }
        $singleItem = $decodedSchema['single_item'] ?? true;
        $showErrors = $decodedSchema['show_errors'] ?? true;
        $output = [];
        for ($i = 0; $i < $repeat; $i++) {
            $output[$i] = $this->mock($faker, $decodedSchema['mock'], $showErrors);
        }
        if ($singleItem && $repeat === 1) {
            $output = $output[0];
        }
        return ($wrap === false) ? $output : [$wrap => $output];
    }

    /**
     * @param Generator $faker
     * @param array $schema
     * @param bool $showErrors
     *
     * @return array
     * @throws JsonException
     */
    protected function mock(Generator $faker, array $schema, bool $showErrors = false): array
    {
        $errors = [];
        $output = [];
        foreach ($schema as $key => $value) {
            $type = $this->getReplacement($value['type']);
            $params = $value['params'] ?? [];

            if ($type === 'mock' && is_array($params) && !empty($params)) {
                $output[$key] = $this->process(json_encode($params));
                continue;
            }

            try {
                //Checking if the type is valid
                $faker->getFormatter($type);
            } catch (\Throwable) {
                //If not, just skip it
                $errors[$key] = "'$type' is not a valid type";
                continue;
            }

            //TODO: if "type" = "unixTime", "params": needs to be new DateTime($param[0])

            try {
                $output[$key] = match (true) {
                    count($params) === 1 => $faker->$type($params[0]),
                    count($params) === 2 => $faker->$type($params[0], $params[1]),
                    count($params) === 3 => $faker->$type($params[0], $params[1], $params[2]),
                    default => $faker->$type(),
                };
            } catch (\Throwable $throwable) {
                if ($throwable instanceof InvalidArgumentException) {
                    throw new InvalidArgumentException(
                        message:  "Missing or Invalid parameters for type '$type'",
                        previous: $throwable
                    );
                }
            }
        }

        if ($showErrors && count($errors) > 0) {
            $output['errors'] = $errors;
        }

        return $output;
    }

    /**
     * @param array $input
     *
     * @return void
     */
    protected function validate(array $input): void
    {
        if (!array_key_exists('mock', $input)) {
            throw new InvalidArgumentException('Your schema must contain a "mock" key.');
        }
    }

    /**
     * @param string $type
     *
     * @return string
     */
    protected function getReplacement(string $type): string
    {
        $replacements = [
            'maskify' => 'bothify',
        ];

        return $replacements[$type] ?? $type;
    }

}
