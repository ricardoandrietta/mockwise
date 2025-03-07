<?php

namespace App\Livewire;

use Livewire\Component;
use MockWise\Domain\UserSchema\UserSchemaRepositoryInterface;

class UserSchemas extends Component
{
    public array $schemas = [];
    public string $viewMode = 'detailed';
    public array $expandedSchemas = [];

    public function mount(UserSchemaRepositoryInterface $repository)
    {
        $userSchemas = $repository->findAllByUserId(auth()->id());
        $this->schemas = array_map(function ($schema) {
            return [
                'id' => $schema->getId(),
                'name' => $schema->getName(),
                'prompt' => $schema->getPrompt(),
                'created_at' => $schema->getCreatedAt()->format('Y-m-d H:i:s'),
                'mock_schema' => $schema->getMockSchema(),
            ];
        }, $userSchemas);
        
        // Initialize all schemas as collapsed
        foreach ($this->schemas as $schema) {
            $this->expandedSchemas[$schema['id']] = false;
        }
    }

    public function toggleSchemaExpansion($schemaId)
    {
        if (isset($this->expandedSchemas[$schemaId])) {
            $this->expandedSchemas[$schemaId] = !$this->expandedSchemas[$schemaId];
        }
    }

    public function toggleViewMode()
    {
        $this->viewMode = $this->viewMode === 'simple' ? 'detailed' : 'simple';
    }

    public function render()
    {
        return view('livewire.user-schemas');
    }

    public function deleteSchema(int $schemaId, UserSchemaRepositoryInterface $repository)
    {
        $schema = $repository->findById($schemaId);
        
        if ($schema && $schema->getUserId() === auth()->id()) {
            $repository->delete($schemaId);
            
            // Update local schemas array
            $this->schemas = array_values(array_filter($this->schemas, function($schema) use ($schemaId) {
                return $schema['id'] !== $schemaId;
            }));
            
            $this->dispatch('notify', type: 'success', message: 'Schema deleted successfully.');
        }
    }
} 