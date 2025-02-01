<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/v1/generate', [\App\Http\Controllers\MockIt::class, 'index'])->middleware('auth:sanctum');

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
