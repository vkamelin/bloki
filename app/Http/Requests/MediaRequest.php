<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'uuid' => ['required'],
            'path' => ['required'],
            'original_name' => ['required'],
            'mime_type' => ['required'],
            'size' => ['required', 'integer'],
            'alt_text' => ['nullable'],
            'caption' => ['nullable'],
            'transforms' => ['nullable'],
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
