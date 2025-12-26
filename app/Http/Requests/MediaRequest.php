<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'path' => ['required', 'string', 'max:255'],
            'original_name' => ['required', 'string', 'max:255'],
            'mime_type' => ['required', 'string', 'max:100'],
            'size' => ['required', 'integer', 'min:0'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'caption' => ['nullable', 'string', 'max:255'],
            'transforms' => ['nullable', 'array'],
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
            'path' => 'Путь к файлу',
            'original_name' => 'Оригинальное имя',
            'mime_type' => 'MIME тип',
            'size' => 'Размер',
            'alt_text' => 'Альтернативный текст',
            'caption' => 'Подпись',
            'transforms' => 'Трансформации',
            'is_active' => 'Активно',
        ];
    }

    public function messages(): array
    {
        return [
            'path.required' => 'Поле ":attribute" обязательно для заполнения.',
            'path.max' => 'Поле ":attribute" не может превышать :max символов.',
            'original_name.required' => 'Поле ":attribute" обязательно для заполнения.',
            'original_name.max' => 'Поле ":attribute" не может превышать :max символов.',
            'mime_type.required' => 'Поле ":attribute" обязательно для заполнения.',
            'mime_type.max' => 'Поле ":attribute" не может превышать :max символов.',
            'size.required' => 'Поле ":attribute" обязательно для заполнения.',
            'size.integer' => 'Поле ":attribute" должно быть целым числом.',
            'size.min' => 'Поле ":attribute" не может быть отрицательным.',
            'alt_text.max' => 'Поле ":attribute" не может превышать :max символов.',
            'caption.max' => 'Поле ":attribute" не может превышать :max символов.',
            'transforms.array' => 'Поле ":attribute" должно быть массивом.',
        ];
    }
}
