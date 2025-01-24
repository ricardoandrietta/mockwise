<?php

declare(strict_types=1);

namespace FakeMock;

use Faker\Factory;
use Faker\Generator;
use InvalidArgumentException;
use JsonException;

class Parser {

    protected Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    /**
     * @param string $schema JSON in a string form
     *
     * @return array
     * @throws JsonException|InvalidArgumentException
     */
    public function parse(string $schema): array
    {
        if (empty($schema)) {
            return [];
        }

        $decodedSchema = json_decode($schema, true, 512, JSON_THROW_ON_ERROR);
        $this->validate($decodedSchema);
        $repeat = $decodedSchema['repeat'] ?? 1;
        $output = [];
        for ($i = 0; $i < $repeat; $i++) {
            $output[$i] = $this->mock($decodedSchema['mock']);
        }
        return $output;
    }

    /**
     * @param array $schema
     *
     * @return array
     * @throws JsonException|InvalidArgumentException
     */
    protected function mock(array $schema): array
    {
        $output = [];
        foreach ($schema as $key => $value) {
            $type = $this->getReplacement($value['type']);
            $params = $value['params'] ?? [];

            if ($type === 'submock' && is_array($params) && !empty($params)) {
                $output[$key] = $this->parse(json_encode($params));
                continue;
            }

            try {
                //Checking if the type is valid
                $this->faker->getFormatter($type);
            } catch (\Throwable) {
                //If not, just skip it
                continue;
            }

            try {
                $output[$key] = match (true) {
                    count($params) === 1 => $this->faker->$type($params[0]),
                    count($params) === 2 => $this->faker->$type($params[0], $params[1]),
                    count($params) === 3 => $this->faker->$type($params[0], $params[1], $params[2]),
                    default => $this->faker->$type(),
                };
            } catch (\Throwable $throwable) {
                if ($throwable instanceof InvalidArgumentException) {
                    throw new InvalidArgumentException(
                        message: "Missing or Invalid parameters for type '$type'",
                        previous: $throwable
                    );
                }
            }
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

    protected function getReplacement(string $type): string
    {
        $replacements = [
            'maskify' => 'bothify',
        ];

        return $replacements[$type] ?? $type;
    }

}
