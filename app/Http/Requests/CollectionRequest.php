<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CollectionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'uuid' => ['required'],
            'name' => ['required'],
            'slug' => ['required'],
            'description' => ['nullable'],
            'icon' => ['nullable'],
            'has_sections' => ['required'],
            'section_structure' => ['required'],
            'entry_behavior' => ['nullable'],
            'is_singleton' => ['boolean'],
            'full_text_search' => ['boolean'],
            'default_template_section' => ['nullable'],
            'default_template_entry' => ['nullable'],
            'route_patterns' => ['nullable'],
            'api_visibility' => ['nullable'],
            'is_active' => ['boolean'],
            'created_by' => ['nullable', 'exists:admins'],
            'updated_by' => ['nullable', 'exists:admins'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
