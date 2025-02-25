<?php

use App\Http\Controllers\MockItController;
use App\Http\Controllers\StatusController;
use App\Mail\RegisterTest;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

Route::post('/v1/generate', [MockItController::class, 'index'])
    ->middleware(['auth:sanctum', 'api-analytics']);

Route::any('/v1/status/{code}', [StatusController::class, 'simulateCode'])
    ->middleware(['auth:sanctum', 'api-analytics'])
    ->whereNumber('code')
    ->name('status.code');


Route::any('/v1/status/random', [StatusController::class, 'generateRandomCode'])
    ->middleware(['auth:sanctum', 'api-analytics'])
    ->name('status.random');


//Tests
//Route::post('/v1/event', function (Request $request) {
//    event(new Verified($request->user()));
//})->middleware('auth:sanctum');
//
//Route::post('/v1/mail', function (Request $request) {
//    try {
//        $mail = Mail::to($request->user())->send(new RegisterTest());
//    } catch (Throwable $e) {
//        Log::error('Mail sending error:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
//    }
//
//    return view('emails.register', ['name' => 'James']);
//})->middleware('auth:sanctum');

//Route::post('/v1/token/create', function (Request $request) {
//    $request->validate([
//                           'email' => 'required|email',
//                           'password' => 'required',
//                           'device_name' => 'required',
//                       ]);
//
//    /** @var User $user */
//    $user = User::where('email', $request->email)->first();
//
//    if (!$user || !Hash::check($request->password, $user->password)) {
//        throw ValidationException::withMessages(
//            [
//                'email' => ['The provided credentials are incorrect.'],
//            ]
//        );
//    }
//
//    if (is_null($user->getAttribute('email_verified_at'))) {
//        return 'Your account is not verified.';
//    }
//
//    return $user->createToken($request->device_name)->plainTextToken;
//});
