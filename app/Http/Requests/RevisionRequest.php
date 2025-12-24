<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RevisionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'entry_type' => ['required'],
            'entry_id' => ['required', 'integer'],
            'data' => ['required'],
            'created_by' => ['nullable', 'exists:admins'],
            'timestamp' => ['required', 'date'],
            'note' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
