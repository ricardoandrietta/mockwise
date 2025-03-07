<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use MockWise\Domain\Enums\SocialLogin\ProvidersEnum;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static where(string $field, string $value)
 * @method static User find(int $id)
 * @method static User first(int $id)
 * @method static User firstWhere(string $field, mixed $value)
 * @method static User create(array $data)
 */
class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * @param ProvidersEnum $provider
     * @return UserSocialToken|null
     */
    public function getSocialToken(ProvidersEnum $provider): ?UserSocialToken
    {
        return $this
            ->hasOne(UserSocialToken::class, 'user_id')
            ->where('provider', $provider->value)
            ->firstOr(fn() => null);
    }

    public function schemas(): HasMany
    {
        return $this->hasMany(UserSchema::class);
    }
}
