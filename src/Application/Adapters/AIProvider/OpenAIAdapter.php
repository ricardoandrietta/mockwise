<?php

declare(strict_types=1);

namespace MockWise\Application\Adapters\AIProvider;


use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use MockWise\Domain\Interfaces\AIProviderInterface;

class OpenAIAdapter implements AIProviderInterface
{

    protected string $apiKey;
    protected string $apiEndpoint;
    protected string $model;

    public function __construct()
    {
        $this->apiKey = config('services.openai.api_key');
        $this->apiEndpoint = config('services.openai.api_endpoint', 'https://api.openai.com/v1/chat/completions');
        $this->model = config('services.openai.model', 'gpt-4-turbo');
    }

    /**
     * @inheritDoc
     */
    public function generateSchema(string $prompt, array $options = []): array
    {
        try {
            $response = $this->makeApiRequest($prompt, $options);
            return $response->json();
        } catch (\Throwable $e) {
//            Log::error('OpenAI API request failed', [
//                'error' => $e->getMessage(),
//            ]);

            return [
                'error' => true,
                'message' => 'API request failed: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Make the actual API request to OpenAI
     */
    protected function makeApiRequest(string $prompt, array $options = []): Response
    {
        return Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->apiEndpoint, [
            'model' => $options['model'] ?? $this->model,
            'messages' => [
                ['role' => 'system', 'content' => $options['system_prompt'] ?? 'You are a helpful API mock generator assistant. Generate only valid JSON without explanations or comments.'],
                ['role' => 'user', 'content' => $prompt]
            ],
            'temperature' => $options['temperature'] ?? 0.3,
            'max_tokens' => $options['max_tokens'] ?? 2000,
            'response_format' => ['type' => 'json_object']
        ]);
    }

    /**
     * @inheritDoc
     */
    public function extractSchema(array $response): array
    {
        if (isset($response['error'])) {
            return [
                'success' => false,
                'error' => $response['error']['message'] ?? 'Unknown API error'
            ];
        }

        $content = $response['choices'][0]['message']['content'] ?? '';

        // Try to decode the content
        $decodedJson = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            // If direct decoding fails, try to extract JSON from potential text
            preg_match('/```(?:json)?\s*([\s\S]*?)\s*```/', $content, $matches);

            if (!empty($matches[1])) {
                $decodedJson = json_decode($matches[1], true);
            }

            if (json_last_error() !== JSON_ERROR_NONE) {
                return [
                    'success' => false,
                    'error' => 'Failed to parse JSON response: ' . json_last_error_msg()
                ];
            }
        }

        // Ensure mock is always an array
        if (isset($decodedJson['mock']) && !is_array($decodedJson['mock'])) {
            return [
                'success' => false,
                'error' => 'The mock property must be an array'
            ];
        }

        return [
            'success' => true,
            'schema' => $decodedJson
        ];
    }
}
