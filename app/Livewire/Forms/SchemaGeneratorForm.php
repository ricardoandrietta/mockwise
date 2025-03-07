<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class SchemaGeneratorForm extends Form
{
    #[Validate('required|string|min:10|max:1000')]
    public string $description = '';

    /**
     * Get validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'description.required' => 'Please provide a description of the API you want to mock.',
            'description.min' => 'The description should be at least :min characters to provide enough context.',
            'description.max' => 'The description should not exceed :max characters.',
        ];
    }
}
