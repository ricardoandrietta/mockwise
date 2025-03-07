<?php

declare(strict_types=1);

namespace MockWise\Application\DTOs\UserSchema;

class SaveUserSchemaDTO
{
    public function __construct(
        private readonly int $userId,
        private readonly string $name,
        private readonly array $mockSchema,
        private readonly string $prompt,
    ) {
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
} 