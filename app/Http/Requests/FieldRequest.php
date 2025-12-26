<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\Dashboard\FieldConfiguration;

class FieldRequest extends FormRequest
{
    protected $fieldConfig;

    public function __construct()
    {
        parent::__construct();
        $this->fieldConfig = new FieldConfiguration();
    }

    public function rules(): array
    {
        $fieldId = $this->field?->id;
        $fieldTypes = implode(',', $this->fieldConfig->getFieldTypeNames());

        return [
            'group_id' => ['required', 'exists:field_groups,id'],
            'slug' => ['required', 'string', 'max:100', 'regex:/^[a-z0-9_]+$/', 'unique:fields,slug,' . $fieldId],
            'name' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:255'],
            'instructions' => ['nullable', 'string'],
            'type' => ['required', 'string', 'in:' . $fieldTypes],
            'settings' => ['nullable', 'array'],
            'required' => ['boolean'],
            'validation_rules' => ['nullable', 'array'],
            'list_visibility' => ['boolean'],
            'translatable' => ['boolean'],
            'searchable' => ['boolean'],
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
            'group_id' => 'Группа полей',
            'slug' => 'Slug',
            'name' => 'Название',
            'description' => 'Описание',
            'instructions' => 'Инструкции',
            'type' => 'Тип поля',
            'settings' => 'Настройки',
            'required' => 'Обязательное',
            'validation_rules' => 'Правила валидации',
            'list_visibility' => 'Видимость в списке',
            'translatable' => 'Переводимое',
            'searchable' => 'Доступно для поиска',
            'is_active' => 'Активно',
        ];
    }

    public function messages(): array
    {
        return [
            'group_id.required' => 'Поле ":attribute" обязательно для заполнения.',
            'group_id.exists' => 'Указанная группа полей не существует.',
            'slug.required' => 'Поле ":attribute" обязательно для заполнения.',
            'slug.max' => 'Поле ":attribute" не может превышать :max символов.',
            'slug.regex' => 'Поле ":attribute" может содержать только строчные буквы, цифры и подчёркивание.',
            'slug.unique' => 'Поле с таким slug уже существует.',
            'name.required' => 'Поле ":attribute" обязательно для заполнения.',
            'name.max' => 'Поле ":attribute" не может превышать :max символов.',
            'description.max' => 'Поле ":attribute" не может превышать :max символов.',
            'type.required' => 'Поле ":attribute" обязательно для заполнения.',
            'type.in' => 'Указанный тип поля не существует.',
            'settings.array' => 'Поле ":attribute" должно быть массивом.',
            'validation_rules.array' => 'Поле ":attribute" должно быть массивом.',
        ];
    }
}
