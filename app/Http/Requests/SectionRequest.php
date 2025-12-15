<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'uuid' => ['required'],
            'collection_id' => ['required', 'exists:collections'],
            'parent_id' => ['nullable', 'exists:sections'],
            'lft' => ['required', 'integer'],
            'rgt' => ['required', 'integer'],
            'slug' => ['required'],
            'name' => ['required'],
            'title' => ['required'],
            'description' => ['nullable'],
            'status' => ['required'],
            'meta' => ['nullable'],
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
