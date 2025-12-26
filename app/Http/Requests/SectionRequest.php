<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
{
    public function rules(): array
    {
        $sectionId = $this->section?->id;

        return [
            'collection_id' => ['required', 'exists:collections,id'],
            'parent_id' => ['nullable', 'exists:sections,id'],
            'slug' => ['required', 'string', 'max:120', 'regex:/^[a-z0-9_-]+$/', 'unique:sections,slug,' . $sectionId],
            'name' => ['required', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'boolean'],
            'meta' => ['nullable', 'array'],
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
            'collection_id' => 'Коллекция',
            'parent_id' => 'Родительская секция',
            'slug' => 'Slug',
            'name' => 'Имя',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'status' => 'Статус',
            'meta' => 'Метаданные',
            'is_active' => 'Активен',
        ];
    }

    public function messages(): array
    {
        return [
            'collection_id.required' => 'Поле ":attribute" обязательно для заполнения.',
            'collection_id.exists' => 'Указанная коллекция не существует.',
            'parent_id.exists' => 'Указанная родительская секция не существует.',
            'slug.required' => 'Поле ":attribute" обязательно для заполнения.',
            'slug.max' => 'Поле ":attribute" не может превышать :max символов.',
            'slug.regex' => 'Поле ":attribute" может содержать только строчные буквы, цифры, дефис и подчёркивание.',
            'slug.unique' => 'Секция с таким slug уже существует.',
            'name.required' => 'Поле ":attribute" обязательно для заполнения.',
            'name.max' => 'Поле ":attribute" не может превышать :max символов.',
            'title.required' => 'Поле ":attribute" обязательно для заполнения.',
            'title.max' => 'Поле ":attribute" не может превышать :max символов.',
            'status.required' => 'Поле ":attribute" обязательно для заполнения.',
            'status.boolean' => 'Поле ":attribute" должно быть истинным или ложным.',
            'meta.array' => 'Поле ":attribute" должно быть массивом.',
        ];
    }
}
