<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CollectionRequest extends FormRequest
{
    public function rules(): array
    {
        $collectionId = $this->collection?->id;

        return [
            'title' => ['required', 'string', 'max:100'],
            'slug' => ['required', 'string', 'max:120', 'regex:/^[a-z0-9_-]+$/', 'unique:collections,slug,' . $collectionId],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'string', 'max:255'],
            'field_groups' => ['nullable', 'array'],
            'field_groups.*' => ['exists:field_groups,id'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function attributes(): array
    {
        return [
            'title' => 'Название',
            'slug' => 'Slug',
            'description' => 'Описание',
            'image' => 'Изображение',
            'field_groups' => 'Группы полей',
            'field_groups.*' => 'Группа полей',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Поле ":attribute" обязательно для заполнения.',
            'title.max' => 'Поле ":attribute" не может превышать :max символов.',
            'slug.required' => 'Поле ":attribute" обязательно для заполнения.',
            'slug.max' => 'Поле ":attribute" не может превышать :max символов.',
            'slug.regex' => 'Поле ":attribute" может содержать только строчные буквы, цифры, дефис и подчёркивание.',
            'slug.unique' => 'Коллекция с таким slug уже существует.',
            'image.max' => 'Поле ":attribute" не может превышать :max символов.',
            'field_groups.array' => 'Поле ":attribute" должно быть массивом.',
            'field_groups.*.exists' => 'Одна из указанных групп полей не существует.',
        ];
    }
}
