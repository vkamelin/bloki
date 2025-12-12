<?php

namespace App\Services\Dashboard\UI;

class FormBuilder
{
    protected $fields = [];
    protected $action = '';
    protected $method = 'POST';
    protected $model = null;

    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    public function addField($name, $type, $label, $options = [])
    {
        $this->fields[$name] = [
            'type' => $type,
            'label' => $label,
            'options' => $options
        ];
        
        return $this;
    }

    public function render()
    {
        $html = '<form method="' . $this->method . '" action="' . $this->action . '">';
        $html .= csrf_field();
        
        if ($this->method !== 'POST') {
            $html .= method_field($this->method);
        }
        
        foreach ($this->fields as $name => $field) {
            $value = old($name);
            
            if ($this->model) {
                $value = $this->model->$name ?? $value;
            }
            
            $html .= '<div class="mb-3">';
            $html .= '<label for="' . $name . '" class="form-label">' . $field['label'] . '</label>';
            
            switch ($field['type']) {
                case 'text':
                case 'email':
                case 'password':
                    $html .= '<input type="' . $field['type'] . '" class="form-control" id="' . $name . '" name="' . $name . '" value="' . $value . '">';
                    break;
                    
                case 'textarea':
                    $html .= '<textarea class="form-control" id="' . $name . '" name="' . $name . '" rows="' . ($field['options']['rows'] ?? 3) . '">' . $value . '</textarea>';
                    break;
                    
                case 'select':
                    $html .= '<select class="form-control" id="' . $name . '" name="' . $name . '">';
                    foreach ($field['options']['choices'] as $key => $choice) {
                        $selected = $value == $key ? 'selected' : '';
                        $html .= '<option value="' . $key . '" ' . $selected . '>' . $choice . '</option>';
                    }
                    $html .= '</select>';
                    break;
            }
            
            $html .= '</div>';
        }
        
        $html .= '<button type="submit" class="btn btn-primary">Save</button>';
        $html .= '<a href="' . ($this->fields['cancel_url']['options']['url'] ?? '#') . '" class="btn btn-secondary">Cancel</a>';
        $html .= '</form>';
        
        return $html;
    }
}