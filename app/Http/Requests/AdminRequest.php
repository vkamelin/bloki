<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:320', 'unique:admins,email,' . $this->admin],
            'password' => ['required', 'string', 'min:8'],
            'is_active' => ['boolean'],
            'role_id' => ['nullable', 'exists:roles,id'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
    
    public function messages(): array
    {
        return [
            'email.unique' => 'Администратор с таким email уже существует.',
            'role_id.exists' => 'Указанная роль не существует.',
        ];
    }
}
