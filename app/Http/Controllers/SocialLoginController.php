<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use MockWise\Application\UseCases\SocialLogin\ConfigureUserSocialAuthenticationUseCase;
use MockWise\Domain\Enums\SocialLogin\ProvidersEnum;
use MockWise\Services\Repositories\UserLaravelRepository;
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
            $authUseCase = new ConfigureUserSocialAuthenticationUseCase(new UserLaravelRepository());
            $userEntity = $authUseCase->exec($socialUser, ProvidersEnum::from($provider));
            $user = User::find($userEntity->getId());
            if (!$user instanceof User) {
                return redirect()->route('welcome');
            }
            Auth::login($user);
            return redirect()->route('dashboard');
        } catch (Throwable) {
            return redirect()->route('welcome');//->withErrors([$exception->getMessage()]);
        }
    }
}
