<?php

namespace MockWise\Domain\SocialLogin;

enum ProvidersEnum: string
{
    case Github = 'github';
    case Google = 'google';

    public static function getAll(): array
    {
        return [
            self::Github->value,
            self::Google->value,
        ];
    }
}
