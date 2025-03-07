<?php

declare(strict_types=1);

namespace MockWise\Application\UseCases\UserSchema;

use MockWise\Application\DTOs\UserSchema\SaveUserSchemaDTO;
use MockWise\Domain\UserSchema\UserSchema;
use MockWise\Domain\UserSchema\UserSchemaRepositoryInterface;

class SaveUserSchemaUseCase
{
    public function __construct(
        private readonly UserSchemaRepositoryInterface $schemaRepository
    ) {
    }

    public function execute(SaveUserSchemaDTO $dto): UserSchema
    {
        // Check if schema with same name exists for this user
        if ($this->schemaRepository->findByNameAndUserId($dto->getName(), $dto->getUserId())) {
            throw new \DomainException('You already have a schema with this name');
        }

        $schema = new UserSchema(
            id: null,
            userId: $dto->getUserId(),
            name: $dto->getName(),
            mockSchema: $dto->getMockSchema(),
            prompt: $dto->getPrompt(),
            createdAt: new \DateTimeImmutable(),
        );

        return $this->schemaRepository->save($schema);
    }
} 