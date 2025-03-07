<?php

declare(strict_types=1);

namespace MockWise\Domain\UserSchema;

interface UserSchemaRepositoryInterface
{
    public function save(UserSchema $schema): UserSchema;
    public function findById(int $id): ?UserSchema;
    public function findByNameAndUserId(string $name, int $userId): ?UserSchema;
    public function findAllByUserId(int $userId): array;
    public function delete(int $id): void;
} 