<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchemaGenerationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'description' => ['required', 'string', 'min:10', 'max:1000'],
        ];
    }

    /**
     * Get custom messages for validator errors.
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
