<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/test', function (Request $request) {
    $schema = $request->post('schema');
    $parser = new \FakeMock\Parser();
    $output = $parser->parse($schema);
    return response()->json($output);
})->middleware('auth:sanctum');

Route::post('/tokens/create', function (Request $request) {
    $request->validate([
                           'email' => 'required|email',
                           'password' => 'required',
                           'device_name' => 'required',
                       ]);

    $user = \App\Models\User::where('email', $request->email)->first();

    if (!$user || !\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
        throw \Illuminate\Validation\ValidationException::withMessages([
                                                                           'email' => ['The provided credentials are incorrect.'],
                                                                       ]);
    }

    return $user->createToken($request->device_name)->plainTextToken;
});
