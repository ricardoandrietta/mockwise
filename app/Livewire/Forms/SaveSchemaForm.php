<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class SaveSchemaForm extends Form
{
    #[Validate('required|string|min:3|max:255')]
    public string $name = '';

    public function messages(): array
    {
        return [
            'name.required' => 'Please provide a name for your schema.',
            'name.min' => 'The schema name must be at least :min characters.',
            'name.max' => 'The schema name cannot exceed :max characters.',
        ];
    }
} 