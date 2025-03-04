<?php

namespace MockWise\Domain\Interfaces;

interface AIProviderInterface
{
    /**
     * Generate a schema based on a user prompt
     *
     * @param string $prompt The user's description of the API
     * @param array $options Additional options for the AI request
     * @return array The AI response containing the generated schema
     */
    public function generateSchema(string $prompt, array $options = []): array;

    /**
     * Extract and parse the schema from the AI's response
     *
     * @param array $response The raw API response
     * @return array The extracted schema
     */
    public function extractSchema(array $response): array;
}
