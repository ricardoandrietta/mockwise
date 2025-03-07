<?php

declare(strict_types=1);

namespace MockWise\Infrastructure\Persistence\Eloquent\UserSchema;

use App\Models\UserSchema as UserSchemaModel;
use MockWise\Domain\UserSchema\UserSchema;
use MockWise\Domain\UserSchema\UserSchemaRepositoryInterface;

class UserSchemaRepository implements UserSchemaRepositoryInterface
{
    public function save(UserSchema $schema): UserSchema
    {
        $model = new UserSchemaModel();
        $model->user_id = $schema->getUserId();
        $model->name = $schema->getName();
        $model->mock_schema = $schema->getMockSchema();
        $model->prompt = $schema->getPrompt();
        $model->save();

        return $this->toEntity($model);
    }

    public function findById(int $id): ?UserSchema
    {
        $model = UserSchemaModel::find($id);
        return $model ? $this->toEntity($model) : null;
    }

    public function findByNameAndUserId(string $name, int $userId): ?UserSchema
    {
        $model = UserSchemaModel::where('name', $name)
            ->where('user_id', $userId)
            ->first();
        return $model ? $this->toEntity($model) : null;
    }

    public function findAllByUserId(int $userId): array
    {
        return UserSchemaModel::where('user_id', $userId)
            ->orderBy('id', 'asc')
            ->get()
            ->map(fn ($model) => $this->toEntity($model))
            ->all();
    }

    public function delete(int $id): void
    {
        UserSchemaModel::destroy($id);
    }

    private function toEntity(UserSchemaModel $model): UserSchema
    {
        return new UserSchema(
            id: $model->id,
            userId: $model->user_id,
            name: $model->name,
            mockSchema: $model->mock_schema,
            prompt: $model->prompt,
            createdAt: $model->created_at,
            updatedAt: $model->updated_at,
        );
    }
} 