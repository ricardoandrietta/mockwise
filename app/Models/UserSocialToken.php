<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static UserSocialToken create(array $data)
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
