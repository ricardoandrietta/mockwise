<?php

namespace App\Http\Controllers;

use App\Models\UserSocialToken;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\UnauthorizedException;
use Laravel\Socialite\Contracts\User;
use Laravel\Socialite\Facades\Socialite;
use MockWise\Domain\SocialLogin\ProvidersEnum;
use Throwable;

class SocialLoginController extends Controller
{

    /**
     * @param string $provider
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirect(string $provider): RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * @param string $provider
     * @return Application|RedirectResponse|Redirector
     */
    public function callback(string $provider): Application|RedirectResponse|Redirector
    {
        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();
            $user = $this->authenticate($socialUser, $provider);
            Auth::login($user);
            return redirect()->route('dashboard');
        } catch (Throwable) {
            return redirect()->route('welcome');//->withErrors([$exception->getMessage()]);
        }
    }

    /**
     * @param User $socialUser
     * @param string $provider
     * @return \App\Models\User
     */
    protected function authenticate(User $socialUser, string $provider): \App\Models\User
    {
        if (!in_array($provider, ProvidersEnum::getAll())) {
            throw new UnauthorizedException("$provider is an invalid provider");
        }

        $user = \App\Models\User::firstWhere('email', $socialUser->email);
        if (!$user instanceof \App\Models\User) {
            $user = \App\Models\User::create([
                'name' => $socialUser->name,
                'email' => $socialUser->email,
                'password' => encrypt(Str::password(16)),
                'email_verified_at' => now()->toDateTimeString(),
            ]);
        }

        $token = $user->getSocialToken($provider);
        if (!$token instanceof UserSocialToken) {
            UserSocialToken::create([
                'user_id' => $user->id,
                'provider' => $provider,
                'token' => $socialUser->token,
                'refresh_token' => $socialUser->refreshToken,
            ]);
        }

        return $user;
    }
}
