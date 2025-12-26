<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'uuid' => ['required'],
            'collection_id' => ['required', 'exists:collections'],
            'slug' => ['required'],
            'name' => ['required'],
            'title' => ['required'],
            'status' => ['required'],
            'published_at' => ['nullable', 'date'],
            'meta' => ['nullable'],
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
