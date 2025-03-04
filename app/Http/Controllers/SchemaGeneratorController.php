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
     */
    public function generate(SchemaGenerationRequest $request): JsonResponse
    {
        $userInput = $request->validated('description');
        $result = $this->aiService->generateSchema($userInput);

        return response()->json($result);
    }

    /**
     * Show the schema preview
     */
    public function preview(string $schemaId): View
    {
        $schema = Cache::get('ai_schema_' . $schemaId);

        if (!$schema) {
            abort(404, 'Schema not found');
        }

        return view('schema-generator.preview', [
            'schema' => $schema['schema']
        ]);
    }

}
