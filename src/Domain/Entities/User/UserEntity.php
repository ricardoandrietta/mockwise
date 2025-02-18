<?php

declare(strict_types=1);

namespace MockWise\Domain\Entities\User;

use DateTime;

class UserEntity
{
    protected ?int $id = null;

    public function __construct(
        protected string $name,
        protected string $email,
        protected ?DateTime $email_verified_at
    )
    {
    }

    /**
     * @param int $id
     * @return UserEntity
     */
    public function setId(int $id): UserEntity
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getEmailVerifiedAt(): string
    {
        return $this->email_verified_at;
    }
}
