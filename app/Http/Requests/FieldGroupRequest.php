<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FieldGroupRequest extends FormRequest
{
    public function rules(): array
    {
        $fieldGroupId = $this->fieldGroup?->id;

        return [
            'name' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:255'],
            'is_global' => ['boolean'],
            'rules' => ['nullable', 'array'],
            'is_active' => ['boolean'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function attributes(): array
    {
        return [
            'name' => 'Название',
            'description' => 'Описание',
            'is_global' => 'Глобальная группа',
            'rules' => 'Правила',
            'is_active' => 'Активна',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Поле ":attribute" обязательно для заполнения.',
            'name.max' => 'Поле ":attribute" не может превышать :max символов.',
            'description.max' => 'Поле ":attribute" не может превышать :max символов.',
            'rules.array' => 'Поле ":attribute" должно быть массивом.',
        ];
    }
}
