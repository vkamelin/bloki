<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FieldValueRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'field_id' => ['required', 'exists:fields,id'],
            'entity_type' => ['required', 'string', 'max:50'],
            'entity_id' => ['required', 'integer'],
            'value_type' => ['required', 'string', 'max:20'],
            'value_string' => ['nullable', 'string', 'max:255'],
            'value_text' => ['nullable', 'string'],
            'value_int' => ['nullable', 'integer'],
            'value_float' => ['nullable', 'numeric'],
            'value_bool' => ['nullable', 'boolean'],
            'value_json' => ['nullable', 'json'],
            'value_date' => ['nullable', 'date'],
            'value_datetime' => ['nullable', 'date'],
            'locale' => ['nullable', 'string', 'max:10'],
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
            'field_id' => 'Поле',
            'entity_type' => 'Тип сущности',
            'entity_id' => 'ID сущности',
            'value_type' => 'Тип значения',
            'value_string' => 'Строковое значение',
            'value_text' => 'Текстовое значение',
            'value_int' => 'Целочисленное значение',
            'value_float' => 'Числовое значение',
            'value_bool' => 'Логическое значение',
            'value_json' => 'JSON значение',
            'value_date' => 'Дата',
            'value_datetime' => 'Дата и время',
            'locale' => 'Локаль',
            'is_active' => 'Активно',
        ];
    }

    public function messages(): array
    {
        return [
            'field_id.required' => 'Поле ":attribute" обязательно для заполнения.',
            'field_id.exists' => 'Указанное поле не существует.',
            'entity_type.required' => 'Поле ":attribute" обязательно для заполнения.',
            'entity_type.max' => 'Поле ":attribute" не может превышать :max символов.',
            'entity_id.required' => 'Поле ":attribute" обязательно для заполнения.',
            'entity_id.integer' => 'Поле ":attribute" должно быть целым числом.',
            'value_type.required' => 'Поле ":attribute" обязательно для заполнения.',
            'value_type.max' => 'Поле ":attribute" не может превышать :max символов.',
            'value_string.max' => 'Поле ":attribute" не может превышать :max символов.',
            'value_int.integer' => 'Поле ":attribute" должно быть целым числом.',
            'value_float.numeric' => 'Поле ":attribute" должно быть числом.',
            'value_bool.boolean' => 'Поле ":attribute" должно быть истинным или ложным.',
            'value_json.json' => 'Поле ":attribute" должно быть корректным JSON.',
            'value_date.date' => 'Поле ":attribute" должно быть корректной датой.',
            'value_datetime.date' => 'Поле ":attribute" должно быть корректной датой и временем.',
            'locale.max' => 'Поле ":attribute" не может превышать :max символов.',
        ];
    }
}
