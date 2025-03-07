<?php

declare(strict_types=1);

namespace MockWise\Domain\UserSchema;

use DateTimeInterface;

class UserSchema
{
    public function __construct(
        private readonly ?int $id,
        private readonly int $userId,
        private readonly string $name,
        private readonly array $mockSchema,
        private readonly string $prompt,
        private readonly DateTimeInterface $createdAt,
        private readonly ?DateTimeInterface $updatedAt = null,
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getMockSchema(): array
    {
        return $this->mockSchema;
    }

    public function getPrompt(): string
    {
        return $this->prompt;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }
} 