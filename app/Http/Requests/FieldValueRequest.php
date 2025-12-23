<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FieldValueRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'field_id' => ['required', 'exists:fields'],
            'entity_type' => ['required'],
            'entity_id' => ['required', 'integer'],
            'value_type' => ['required'],
            'value_string' => ['nullable'],
            'value_text' => ['nullable'],
            'value_int' => ['nullable', 'integer'],
            'value_float' => ['nullable', 'numeric'],
            'value_bool' => ['nullable', 'boolean'],
            'value_json' => ['nullable'],
            'value_date' => ['nullable', 'date'],
            'value_datetime' => ['nullable', 'date'],
            'locale' => ['nullable'],
            'is_active' => ['boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
