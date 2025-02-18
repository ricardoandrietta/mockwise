<?php

declare(strict_types=1);

namespace MockWise\Application\UseCases\SocialLogin;

use Laravel\Socialite\Contracts\User;
use MockWise\Application\Exceptions\ResourceNotFound;
use MockWise\Domain\Entities\SocialLogin\UserSocialTokenValueObject;
use MockWise\Domain\Entities\User\UserEntity;
use MockWise\Domain\Enums\SocialLogin\ProvidersEnum;
use MockWise\Domain\Interfaces\UserRepositoryInterface;

class ConfigureUserSocialAuthenticationUseCase
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {
    }

    /**
     * @param User $socialUser
     * @param ProvidersEnum $provider
     * @return UserEntity
     */
    public function exec(User $socialUser, ProvidersEnum $provider): UserEntity
    {
        try {
            $user = $this->userRepository->findByEmail($socialUser->email);
        } catch (ResourceNotFound) {
            $user = $this->userRepository->create(
                name: $socialUser->name,
                email: $socialUser->email,
                isEmailVerified: true
            );
        }

        $token = $this->userRepository->getSocialToken($user->getId(), $provider);
        if (!$token instanceof UserSocialTokenValueObject) {
            $userSocialToken = new UserSocialTokenValueObject(
                userId: $user->getId(),
                provider: $provider,
                token: $socialUser->token,
                refreshToken: $socialUser->refreshToken,
            );
            $this->userRepository->createSocialToken($userSocialToken);
        }

        return $user;
    }
}
