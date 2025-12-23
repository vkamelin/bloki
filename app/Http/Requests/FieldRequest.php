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
        return [
            'group_id' => ['required', 'exists:field_groups'],
            'uuid' => ['required'],
            'name' => ['required'],
            'description' => ['nullable'],
            'instructions' => ['nullable'],
            'type' => ['required', 'in:' . implode(',', $this->fieldConfig->getFieldTypeNames())],
            'settings' => ['nullable'],
            'required' => ['boolean'],
            'validation_rules' => ['nullable'],
            'list_visibility' => ['boolean'],
            'translatable' => ['boolean'],
            'searchable' => ['boolean'],
            'is_active' => ['boolean'],
            'created_by' => ['required', 'exists:admins'],
            'updated_by' => ['required', 'exists:admins'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
