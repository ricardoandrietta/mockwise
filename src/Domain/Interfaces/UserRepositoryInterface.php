<?php

namespace MockWise\Domain\Interfaces;

use App\Models\User;
use MockWise\Application\Exceptions\ResourceNotFound;
use MockWise\Domain\Entities\SocialLogin\UserSocialTokenValueObject;
use MockWise\Domain\Entities\User\UserEntity;
use MockWise\Domain\Enums\SocialLogin\ProvidersEnum;

interface UserRepositoryInterface
{

    /**
     * @param string $name
     * @param string $email
     * @param bool $isEmailVerified
     * @param string|null $password
     * @return UserEntity
     */
    public function create(
        string $name,
        string $email,
        bool $isEmailVerified = false,
        ?string $password = null,
    ): UserEntity;

    public function createSocialToken(UserSocialTokenValueObject $socialToken): void;

    /**
     * @param string $email
     * @return UserEntity
     * @throws ResourceNotFound
     */
    public function findByEmail(string $email): UserEntity;

    /**
     * @param int $userId
     * @param ProvidersEnum $provider
     * @return UserSocialTokenValueObject|null
     */
    public function getSocialToken(int $userId, ProvidersEnum $provider): ?UserSocialTokenValueObject;

    public function getAllSocialTokens(int $userId);

    public function map(User $userModel): UserEntity;
}
