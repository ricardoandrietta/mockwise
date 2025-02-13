<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MockIt extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
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
            $parser = new \MockWise\Parser();
            $output = $parser->parse($schema);
            return response()->json($output);
        } catch (\Exception $e) {
            return response()->json(
                data: ["error" => "There was a technical error. Please review your schema."],
                status: 422
            );
        }
    }
}
