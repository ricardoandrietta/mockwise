<?php

declare(strict_types=1);

namespace MockWise\Domain\Libraries;

use Faker\Factory;
use Faker\Generator;
use InvalidArgumentException;
use JsonException;
use MockWise\Application\Exceptions\MaxDepthReached;

class SchemaProcessor
{

    protected int $maxNestingLevels = 5;
    private bool $isMaxDepthValidated = false;

    /**
     * @return int
     */
    public function getMaxNestingLevels(): int
    {
        return $this->maxNestingLevels;
    }

    /**
     * @param int $maxNestingLevels
     * @return SchemaProcessor
     */
    public function setMaxNestingLevels(int $maxNestingLevels): SchemaProcessor
    {
        $this->maxNestingLevels = $maxNestingLevels;
        return $this;
    }

    /**
     * @param array|string $schema JSON in a string form
     * @return array
     * @throws JsonException
     * @throws MaxDepthReached
     */
    public function process(string|array $schema): array
    {
        if (empty($schema)) {
            return [];
        }

        $decodedSchema = (is_array($schema)) ? $schema : json_decode($schema, true, 512, JSON_THROW_ON_ERROR);
        $this->validate($decodedSchema);
        if (!$this->isMaxDepthValidated) {
            $this->analyzeMockDepth($decodedSchema, $this->getMaxNestingLevels());
            $this->isMaxDepthValidated = true;
        }
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
            $output[] = $this->mock($faker, $decodedSchema['mock'], $showErrors);
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
     * @throws JsonException|MaxDepthReached
     */
    protected function mock(Generator $faker, array $schema, bool $showErrors = false): array
    {
        $errors = [];
        $output = [];
        foreach ($schema as $key => $value) {
            $type = $this->getReplacement($value['type']);
            $params = $value['params'] ?? [];
            $field = $value['field'] ?? "field_{$key}";

            if ($type === 'nested' && is_array($params) && !empty($params)) {
                $output[$field] = $this->process(json_encode($params));
                continue;
            }

            try {
                //Checking if the type is valid
                $faker->getFormatter($type);
            } catch (\Throwable) {
                //If not, just skip it
                $errors[$field] = "'$type' is not a valid type";
                continue;
            }

            //TODO: if "type" = "unixTime", "params": needs to be new DateTime($param[0])

            try {
                $output[$field] = match (true) {
                    count($params) === 1 => $faker->$type($params[0]),
                    count($params) === 2 => $faker->$type($params[0], $params[1]),
                    count($params) === 3 => $faker->$type($params[0], $params[1], $params[2]),
                    default => $faker->$type(),
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

    /**
     * Analyzes JSON structure to find the deepest nested mock object and its depth
     *
     * @param array $data Array to analyze
     * @return int max nest depth on the mock object
     * @throws MaxDepthReached
     */
    protected function analyzeMockDepth(array $data, int $maxDepthAllowed = 5): int
    {
        // Initialize variables to track the deepest path
        $maxDepth = 0;

        // Start the recursive search
        $this->searchDeepestMock($data, 0, $maxDepth, $maxDepthAllowed);

        return $maxDepth;
    }

    /**
     * Recursively searches for the deepest "mock" object in the data structure
     *
     * @param array $data Current data structure to search
     * @param int $currentDepth Current depth in the data structure
     * @param int &$maxDepth Reference to the maximum depth found
     * @throws MaxDepthReached
     */
    protected function searchDeepestMock(array $data, int $currentDepth, int &$maxDepth, int $maxDepthAllowed): void
    {
        // Check if this is a mock object
        if (isset($data['type']) && $data['type'] === 'nested') {
            // We found a mock, so update the current depth
            $currentDepth++;

            if ($maxDepth > $maxDepthAllowed) {
                throw new MaxDepthReached("Your current plan only allows $maxDepthAllowed nesting levels.");
            }

            // If this is the deepest mock so far, update our tracking variables
            if ($currentDepth > $maxDepth) {
                $maxDepth = $currentDepth;
            }

            // If it has params with a mock, continue searching
            if (isset($data['params']['mock'])) {
                $this->searchDeepestMock($data['params']['mock'], $currentDepth, $maxDepth, $maxDepthAllowed);
            }
        } else {
            // Not a mock object, continue searching all child elements
            foreach ($data as $key => $value) {
                if (is_array($value)) {
                    $this->searchDeepestMock($value, $currentDepth, $maxDepth, $maxDepthAllowed);
                }
            }
        }
    }
}
