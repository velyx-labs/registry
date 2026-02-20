<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class ComponentShowRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'version' => ['nullable', 'regex:/^\d+\.\d+\.\d+$/'],
            'include' => ['nullable', 'string', 'in:files'],
        ];
    }

    public function messages(): array
    {
        return [
            'version.regex' => 'Version must follow semantic versioning format (e.g., 1.0.0)',
            'include.in' => 'Include parameter must be one of: files',
        ];
    }

    protected function prepareForValidation(): void
    {
        $name = $this->route('name');

        if (! preg_match('/^[a-z][a-z0-9-_]*$/', $name)) {
            $validator = $this->getValidatorInstance();
            $validator->errors()->add('name', 'Component name must contain only lowercase letters, numbers, hyphens, and underscores');

            throw new ValidationException($validator);
        }
    }
}
