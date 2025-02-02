<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class MockIt extends Controller
{
    /**
     * Display a listing of the resource.
     * @OA\Info(
     *     title="Mock Data Generation API",
     *     version="1.0.0"
     * )
     * @OA\Post(
     *     path="/v1/generate",
     *     tags={"MockIt"},
     *     description="Generates mock data based on specified types and repetition count",
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     )
     * )
     */
    public function index(Request $request)
    {
        $schema = $request->post('schema');
        $parser = new \MockWise\Parser();
        $output = $parser->parse($schema);
        return response()->json($output);
    }
}
