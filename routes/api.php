<?php

use App\Http\Controllers\MockIt;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/v1/generate', [MockIt::class, 'index'])
    ->middleware('auth:sanctum');
Route::post('/v1/event', function (Request $request){
    event(new Verified($request->user()));
})->middleware('auth:sanctum');
Route::post('/v1/mail', function (Request $request){

    try {
        $mail = \Illuminate\Support\Facades\Mail::to($request->user())->send(new \App\Mail\RegisterTest());
    } catch (Throwable $e) {
        \Illuminate\Support\Facades\Log::error('Mail sending error:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
    }

    return view('emails.register', ['name' => 'James']);
})->middleware('auth:sanctum');

Route::post('/v1/token/create', function (Request $request) {
    $request->validate([
                           'email' => 'required|email',
                           'password' => 'required',
                           'device_name' => 'required',
                       ]);

    /** @var \App\Models\User $user */
    $user = \App\Models\User::where('email', $request->email)->first();

    if (!$user || !\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
        throw \Illuminate\Validation\ValidationException::withMessages(
            [
                'email' => ['The provided credentials are incorrect.'],
            ]
        );
    }

    if (is_null($user->getAttribute('email_verified_at'))) {
        return 'Your account is not verified.';
    }

    return $user->createToken($request->device_name)->plainTextToken;
});
