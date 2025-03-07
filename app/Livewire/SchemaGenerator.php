<?php

namespace App\Livewire;

use App\Livewire\Forms\SaveSchemaForm;
use App\Livewire\Forms\SchemaGeneratorForm;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use MockWise\Application\Adapters\AIProvider\ClaudeAdapter;
use MockWise\Application\DTOs\UserSchema\SaveUserSchemaDTO;
use MockWise\Application\UseCases\UserSchema\SaveUserSchemaUseCase;
use MockWise\Services\AIProvider\AISchemaGeneratorService;

class SchemaGenerator extends Component
{
    public SchemaGeneratorForm $form;
    public SaveSchemaForm $saveForm;
    
    public ?array $schema = null;
    public ?string $schemaId = null;
    public ?string $errorMessage = null;
    public bool $showSaveModal = false;
    
    public function render()
    {
        return view('livewire.schema-generator');
    }
    
    public function generateSchema()
    {
        $this->resetState();
        
        try {
            $this->form->validate();
            
            $aiService = new AISchemaGeneratorService(new ClaudeAdapter());
            $result = $aiService->generateSchema($this->form->description);
            
            if (isset($result['success']) && $result['success'] === false) {
                $this->errorMessage = $result['error'] ?? 'Failed to generate schema';
                return;
            }
            
            // Generate a unique ID for this schema
            $this->schemaId = uniqid('schema_');
            
            // Store the schema in cache
            Cache::put('ai_schema_' . $this->schemaId, [
                'schema' => $result,
                'created_at' => now(),
                'description' => $this->form->description
            ], now()->addHours(24));
            
            $this->schema = $result;
        } catch (\Exception $e) {
            $this->errorMessage = $e->getMessage();
        }
    }

    public function openSaveModal()
    {
        $this->showSaveModal = true;
    }

    public function closeSaveModal()
    {
        $this->showSaveModal = false;
        $this->saveForm->reset();
    }

    public function saveSchema(SaveUserSchemaUseCase $useCase)
    {
        try {
            $this->saveForm->validate();

            $dto = new SaveUserSchemaDTO(
                userId: auth()->id(),
                name: $this->saveForm->name,
                mockSchema: $this->schema,
                prompt: $this->form->description,
            );

            $useCase->execute($dto);

            $this->closeSaveModal();
            $this->dispatch('schema-saved', name: $this->saveForm->name);
        } catch (\DomainException $e) {
            $this->addError('saveForm.name', $e->getMessage());
        } catch (\Exception $e) {
            $this->addError('saveForm.name', 'An error occurred while saving the schema.');
        }
    }
    
    private function resetState()
    {
        $this->schema = null;
        $this->schemaId = null;
        $this->errorMessage = null;
    }
}
