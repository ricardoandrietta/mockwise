<?php

declare(strict_types=1);

namespace MockWise\Services\Repositories;

use App\Models\User;
use App\Models\UserSocialToken;
use Illuminate\Support\Str;
use MockWise\Application\Exceptions\ResourceNotFound;
use MockWise\Domain\Entities\SocialLogin\UserSocialTokenValueObject;
use MockWise\Domain\Entities\User\UserEntity;
use MockWise\Domain\Enums\SocialLogin\ProvidersEnum;
use MockWise\Domain\Interfaces\UserRepositoryInterface;

class UserLaravelRepository implements UserRepositoryInterface
{
    public function create(
        string $name,
        string $email,
        bool $isEmailVerified = false,
        ?string $password = null,
    ): UserEntity {
        $userData = [
            'name' => $name,
            'email' => $email,
            'password' => $password ?: encrypt(Str::password(16)),
            'email_verified_at' => $isEmailVerified ? now()->toDateTimeString() : null
        ];
        $userModel = User::create($userData);
        return $this->map($userModel);
    }

    public function createSocialToken(UserSocialTokenValueObject $socialToken): void
    {
        UserSocialToken::create([
            'user_id' => $socialToken->getUserId(),
            'provider' => $socialToken->getProvider()->value,
            'token' => $socialToken->getToken(),
            'refresh_token' => $socialToken->getRefreshToken(),
        ]);
    }


    /**
     * @param string $email
     * @return UserEntity
     * @throws ResourceNotFound
     */
    public function findByEmail(string $email): UserEntity
    {
        $user = User::firstWhere('email', $email);
        if (!$user instanceof User) {
            throw new ResourceNotFound("User [$email] not found");
        }

        return $this->map($user);
    }

    /**
     * @param int $userId
     * @param ProvidersEnum $provider
     * @return UserSocialTokenValueObject|null
     */
    public function getSocialToken(int $userId, ProvidersEnum $provider): ?UserSocialTokenValueObject
    {
        $token = UserSocialToken::firstWhere('user_id', $userId);
        if (!$token instanceof UserSocialToken) {
            return null;
        }
        return (new UserSocialTokenValueObject(
            userId: $userId,
            provider: $provider,
            token: $token->token,
        ));
    }

    public function getAllSocialTokens(int $userId)
    {
        // TODO: Implement getAllSocialTokens() method.
    }

    public function map(User $userModel): UserEntity
    {
        return (new UserEntity(
            name: $userModel->name,
            email: $userModel->email,
            email_verified_at: $userModel->email_verified_at
        ))->setId($userModel->id);
    }
}
