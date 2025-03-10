<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\TokenController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('welcome');
Route::view('/terms', 'terms')->name('terms');
Route::view('/privacy', 'privacy')->name('privacy');
Route::view('/contact', 'contact')->name('contact');
Route::view('/documentation', 'documentation.documentation')
    ->name('documentation');

Route::get('dashboard', [Dashboard::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth', 'verified'])
    ->name('profile');

Route::post('/token/store', [TokenController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('token.store');

//Route::get('test', function () {
//    $user = User::find(7);
//    return redirect(\route('login'))
////        ->with('status', 'Profile updated!');
//        ->withErrors('Error 001');
//});

//Route::post('/tokens', [TokenController::class, 'store'])
//    ->middleware(['auth', 'verified'])
//    ->name('tokens.store');

require __DIR__.'/auth.php';
