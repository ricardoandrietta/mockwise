<?php

declare(strict_types=1);

namespace MockWise\Services\AIProvider;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use MockWise\Domain\Interfaces\AIProviderInterface;

class AISchemaGeneratorService
{
    protected AIProviderInterface $provider;
    protected int $cacheMinutes = 60;

    public function __construct(AIProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Generate a JSON schema based on user input
     */
    public function generateSchema(string $userInput): array
    {
        $cacheKey = 'ai_schema_' . md5($userInput);

        // Try to get from cache first
        if (Cache::has($cacheKey)) {    
            return Cache::get($cacheKey);
        }

        try {
            $schemaTemplate = $this->getSchemaTemplate();
            $prompt = $this->buildPrompt($userInput, $schemaTemplate);

            // Get the response from the AI provider
            $response = $this->provider->generateSchema($prompt, [
                'system_prompt' => 'You are a helpful API mock generator assistant. Generate only valid JSON without explanations or comments.',
                'temperature' => 0.3,
                'max_tokens' => 2000
            ]);

            // Extract and validate the schema
            $extractedSchema = $this->provider->extractSchema($response);

            if (!$extractedSchema['success']) {
                return [
                    'success' => false,
                    'error' => $extractedSchema['error'] ?? 'Failed to generate schema'
                ];
            }

            // Validate the schema
//            $validatedSchema = $this->validateSchema($extractedSchema['schema']);
            $validatedSchema = $extractedSchema['schema'];

            // Cache the result
            Cache::put($cacheKey, $validatedSchema, $this->cacheMinutes * 60);

            return $validatedSchema;
        } catch (\Throwable $e) {
            Log::error('AI Schema generation failed', [
                'error' => $e->getMessage(),
                'userInput' => $userInput,
            ]);

            return [
                'success' => false,
                'error' => 'Failed to generate schema: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Get the schema template
     */
    protected function getSchemaTemplate(): string
    {
        return file_get_contents(base_path('src/Services/AIProvider/mock-schema-template.json'));
    }

    /**
     * Build the prompt for the AI
     */
    protected function buildPrompt(string $userInput, string $schemaTemplate): string
    {
        return <<<EOT
Generate a valid JSON mock data definition based on the following user description:

"$userInput"

Follow this JSON schema structure (but add only fields requested in the user description):
$schemaTemplate

The JSON should include:
1. The required "mock" array containing field definitions (field, type, params)
2. Optional fields like locale, repeat, show_errors, single_item, and wrap
2.1 locale defaults to en_US
2.2 repeat defaults to 1
2.3 show_errors defaults to false
2.4 single_item defaults to false
2.5 wrap defaults to null
3. type:
3.1 For "date" type, params can include format string that follows PHP DateTime format

Important notes:
- Each item in the mock array needs "field" and "type" properties
- For "nested" types, the "params" should contain an array of field definitions
- Types follow FakerPHP formatters
- Common types include: firstName, lastName, name, email, phoneNumber, address, city, country, date, autoIncrement, number, boolean, uuid, image, color
- Date and Time follow PHP DateTime string format e.g., "Y-m-d" or "Y-m-d H:i:s" or "H:i:s"

Return only the valid JSON without any additional text or explanations.
EOT;
    }

    /**
     * Validate the schema against our defined structure
     */
    protected function validateSchema(array $schema): array
    {
        // Basic validation - mock must exist
        if (!isset($schema['mock']) || !is_array($schema['mock'])) {
            throw new \Exception('Generated schema is missing required mock property');
        }

        // Validate each field in the mock array
        foreach ($schema['mock'] as $field) {
            if (!isset($field['field']) || !isset($field['type'])) {
                throw new \Exception('Field definition is missing required properties (field, type)');
            }

            // Special validation for nested types
            if (isset($field['type']) && $field['type'] === 'nested') {
                if (!isset($field['params']) || !is_array($field['params'])) {
                    throw new \Exception('Nested type requires params array with field definitions');
                }

                // Recursively validate nested fields
                foreach ($field['params'] as $nestedField) {
                    if (!isset($nestedField['field']) || !isset($nestedField['type'])) {
                        throw new \Exception('Nested field definition is missing required properties (field, type)');
                    }
                }
            }
        }

        return [
            'success' => true,
            'schema' => $schema
        ];
    }
}
