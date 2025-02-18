<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use MockWise\Domain\Libraries\SchemaProcessor;

class MockItController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $schema = $request->post('schema');
        if (is_null($schema)) {
            return response()
                ->json(
                    data: ['error' => 'Invalid Argument: `schema` is required'],
                    status: 422
                );
        }
        try {
            $schemaProcessor = new SchemaProcessor();
            $output = $schemaProcessor->process($schema);
            return response()->json($output);
        } catch (Exception) {
            return response()->json(
                data: ["error" => "There was a technical error. Please review your schema."],
                status: 422
            );
        }
    }
}
