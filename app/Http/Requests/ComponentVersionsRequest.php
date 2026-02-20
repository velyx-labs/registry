<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class ComponentVersionsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [];
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
