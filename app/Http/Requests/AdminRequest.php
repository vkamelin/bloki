<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    public function rules(): array
    {
        $adminId = $this->admin?->id;

        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:320', 'unique:admins,email,' . $adminId],
            'password' => [$this->isMethod('POST') ? 'required' : 'sometimes', 'string', 'min:8'],
            'remember_token' => ['nullable', 'string', 'max:100'],
            'role_id' => ['nullable', 'exists:roles,id'],
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
            'name' => 'Имя',
            'email' => 'Email',
            'password' => 'Пароль',
            'remember_token' => 'Токен запоминания',
            'role_id' => 'Роль',
            'is_active' => 'Активен',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Поле ":attribute" обязательно для заполнения.',
            'name.max' => 'Поле ":attribute" не может превышать :max символов.',
            'email.required' => 'Поле ":attribute" обязательно для заполнения.',
            'email.email' => 'Поле ":attribute" должно быть действительным email адресом.',
            'email.max' => 'Поле ":attribute" не может превышать :max символов.',
            'email.unique' => 'Администратор с таким email уже существует.',
            'password.required' => 'Поле ":attribute" обязательно для заполнения.',
            'password.min' => 'Поле ":attribute" должно содержать минимум :min символов.',
            'role_id.exists' => 'Указанная роль не существует.',
        ];
    }
}
