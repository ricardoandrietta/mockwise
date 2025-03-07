<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchemaGenerationRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use MockWise\Application\Adapters\AIProvider\ClaudeAdapter;
use MockWise\Application\Adapters\AIProvider\OpenAIAdapter;
use MockWise\Services\AIProvider\AISchemaGeneratorService;
use App\Models\UserSchema;
use MockWise\Application\UseCases\UserSchema\GetUserSchemaUseCase;

class SchemaGeneratorController extends Controller
{
    protected AISchemaGeneratorService $aiService;

//    public function __construct(AISchemaGeneratorService $aiService)
    public function __construct()
    {
        $this->aiService = new AISchemaGeneratorService(new ClaudeAdapter());
    }

    /**
     * Show the schema generator form
     */
    public function index(): View
    {
        return view('schema-generator.index');
    }

    /**
     * Generate a schema from user input
     * This endpoint is kept for API compatibility
     */
    public function generate(SchemaGenerationRequest $request): JsonResponse
    {
        $userInput = $request->validated('description');
        $result = $this->aiService->generateSchema($userInput);
        
        // Generate a unique ID for this schema
        $schemaId = uniqid('schema_');
        
        // Store the schema in cache
        Cache::put('ai_schema_' . $schemaId, [
            'schema' => $result,
            'created_at' => now(),
            'description' => $userInput
        ], now()->addHours(24));
        
        // Return the schema and the ID
        return response()->json([
            'success' => true,
            'schema' => $result,
            'id' => $schemaId
        ]);
    }

    /**
     * Show the schema preview
     */
    public function preview(string $schemaId): View
    {
        try {
            $useCase = app()->make(GetUserSchemaUseCase::class);
            $schema = $useCase->execute((int) $schemaId);

            return view('schema-generator.preview', [
                'schema' => json_encode($schema->getMockSchema())
            ]);
        } catch (\DomainException $e) {
            abort(404, $e->getMessage());
        }
    }

    /**
     * Show the list of saved user schemas
     */
    public function list(): View
    {
        return view('schema-generator.list');
    }

}
