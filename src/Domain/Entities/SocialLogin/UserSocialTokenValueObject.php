<?php

declare(strict_types=1);

namespace MockWise\Domain\Entities\SocialLogin;

use MockWise\Domain\Enums\SocialLogin\ProvidersEnum;

class UserSocialTokenValueObject
{
    public function __construct(
        private int $userId,
        private ProvidersEnum $provider,
        private string $token,
        private ?string $refreshToken = null
    ) {
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getProvider(): ProvidersEnum
    {
        return $this->provider;
    }

    /**
     * @return string|null
     */
    public function getRefreshToken(): ?string
    {
        return $this->refreshToken;
    }
}
