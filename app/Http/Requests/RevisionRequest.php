<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RevisionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'entity_type' => ['required', 'string', 'max:50'],
            'entity_id' => ['required', 'integer'],
            'data' => ['required', 'array'],
            'created_by' => ['nullable', 'exists:admins,id'],
            'timestamp' => ['required', 'date'],
            'note' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function attributes(): array
    {
        return [
            'entity_type' => 'Тип сущности',
            'entity_id' => 'ID сущности',
            'data' => 'Данные',
            'created_by' => 'Создано',
            'timestamp' => 'Временная метка',
            'note' => 'Примечание',
        ];
    }

    public function messages(): array
    {
        return [
            'entity_type.required' => 'Поле ":attribute" обязательно для заполнения.',
            'entity_type.max' => 'Поле ":attribute" не может превышать :max символов.',
            'entity_id.required' => 'Поле ":attribute" обязательно для заполнения.',
            'entity_id.integer' => 'Поле ":attribute" должно быть целым числом.',
            'data.required' => 'Поле ":attribute" обязательно для заполнения.',
            'data.array' => 'Поле ":attribute" должно быть массивом.',
            'created_by.exists' => 'Указанный администратор не существует.',
            'timestamp.required' => 'Поле ":attribute" обязательно для заполнения.',
            'timestamp.date' => 'Поле ":attribute" должно быть корректной датой.',
            'note.max' => 'Поле ":attribute" не может превышать :max символов.',
        ];
    }
}
