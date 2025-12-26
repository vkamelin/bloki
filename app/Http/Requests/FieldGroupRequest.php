<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FieldGroupRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'uuid' => ['required'],
            'name' => ['required'],
            'description' => ['nullable'],
            'is_global' => ['boolean'],
            'rules' => ['nullable'],
            'is_active' => ['boolean'],
            'created_by' => ['required', 'exists:admins'],
            'updated_by' => ['required', 'exists:admins'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function attributes(): array
    {
        return [];
    }

    public function messages(): array
    {
        return [];
    }
}
