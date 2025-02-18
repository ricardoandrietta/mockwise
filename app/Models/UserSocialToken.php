<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static UserSocialToken create(array $data)
 * @method static UserSocialToken firstWhere(string $field, mixed $value)
 */
class UserSocialToken extends Model
{
    protected $fillable = [
        'user_id',
        'provider',
        'token',
        'refresh_token',
    ];
}
