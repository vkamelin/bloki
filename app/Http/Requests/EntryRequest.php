<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntryRequest extends FormRequest
{
    public function rules(): array
    {
        $entryId = $this->entry?->id;

        return [
            'collection_id' => ['required', 'exists:collections,id'],
            'slug' => ['required', 'string', 'max:120', 'regex:/^[a-z0-9_-]+$/', 'unique:entries,slug,' . $entryId],
            'name' => ['required', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:100'],
            'status' => ['required', 'boolean'],
            'published_at' => ['nullable', 'date'],
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
            'slug' => 'Slug',
            'name' => 'Имя',
            'title' => 'Заголовок',
            'status' => 'Статус',
            'published_at' => 'Дата публикации',
            'meta' => 'Метаданные',
            'is_active' => 'Активен',
        ];
    }

    public function messages(): array
    {
        return [
            'collection_id.required' => 'Поле ":attribute" обязательно для заполнения.',
            'collection_id.exists' => 'Указанная коллекция не существует.',
            'slug.required' => 'Поле ":attribute" обязательно для заполнения.',
            'slug.max' => 'Поле ":attribute" не может превышать :max символов.',
            'slug.regex' => 'Поле ":attribute" может содержать только строчные буквы, цифры, дефис и подчёркивание.',
            'slug.unique' => 'Запись с таким slug уже существует.',
            'name.required' => 'Поле ":attribute" обязательно для заполнения.',
            'name.max' => 'Поле ":attribute" не может превышать :max символов.',
            'title.required' => 'Поле ":attribute" обязательно для заполнения.',
            'title.max' => 'Поле ":attribute" не может превышать :max символов.',
            'status.required' => 'Поле ":attribute" обязательно для заполнения.',
            'status.boolean' => 'Поле ":attribute" должно быть истинным или ложным.',
            'published_at.date' => 'Поле ":attribute" должно быть корректной датой.',
            'meta.array' => 'Поле ":attribute" должно быть массивом.',
        ];
    }
}
