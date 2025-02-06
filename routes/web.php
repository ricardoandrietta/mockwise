<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('profile', function (Request $request) {
    return $request->user();
})
    ->middleware(['auth', 'verified'])
    ->name('profile');

//Route::view('profile', 'profile')
//    ->middleware(['auth', 'verified'])
//    ->name('profile');

//Route::post('/tokens/create', function (Request $request) {
//    $token = $request->user()->createToken($request->token_name);
//
//    return ['token' => $token->plainTextToken];
//});

require __DIR__.'/auth.php';
