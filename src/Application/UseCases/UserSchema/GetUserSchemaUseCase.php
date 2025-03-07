<?php

declare(strict_types=1);

namespace MockWise\Application\UseCases\UserSchema;

use MockWise\Domain\UserSchema\UserSchema;
use MockWise\Domain\UserSchema\UserSchemaRepositoryInterface;

class GetUserSchemaUseCase
{
    public function __construct(
        private readonly UserSchemaRepositoryInterface $schemaRepository
    ) {
    }

    public function execute(int $schemaId): UserSchema
    {
        $schema = $this->schemaRepository->findById($schemaId);

        if (!$schema) {
            throw new \DomainException('Schema not found');
        }

        return $schema;
    }
} 