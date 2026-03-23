<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreInstallationRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'project_id' => 'required|ulid',
            'project_name' => 'nullable|string',
            'component_name' => 'required|string',
            'component_version' => 'required|string',
            'component_categories' => 'nullable|array',
            'installed_at' => 'nullable|date',
            'completed_at' => 'nullable|date',
            'status' => 'required|in:pending,success,failed,cancelled',
            'laravel_version' => 'required|string',
            'php_version' => 'required|string',
            'package_manager' => 'required|in:npm,yarn,pnpm,bun',
            'composer_dependencies' => 'nullable|array',
            'npm_dependencies' => 'nullable|array',
            'requires_alpine' => 'required|boolean',
            'files_count' => 'required|integer',
            'files_installed' => 'nullable|array',
            'error_message' => 'nullable|string',
            'error_stack' => 'nullable|string',
        ];
    }
}
