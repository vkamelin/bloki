<?php

namespace App\Services\Dashboard\UI;

class TableBuilder
{
    protected $columns = [];
    protected $data = [];
    protected $actions = [];

    public function addColumn($name, $label, $callback = null)
    {
        $this->columns[$name] = [
            'label' => $label,
            'callback' => $callback
        ];
        
        return $this;
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function addAction($label, $url, $class = 'btn btn-sm btn-outline-secondary')
    {
        $this->actions[] = [
            'label' => $label,
            'url' => $url,
            'class' => $class
        ];
        
        return $this;
    }

    public function render()
    {
        $html = '<div class="table-responsive">';
        $html .= '<table class="table table-striped">';
        $html .= '<thead><tr>';
        
        foreach ($this->columns as $name => $column) {
            $html .= '<th>' . $column['label'] . '</th>';
        }
        
        if (!empty($this->actions)) {
            $html .= '<th>Actions</th>';
        }
        
        $html .= '</tr></thead><tbody>';
        
        foreach ($this->data as $row) {
            $html .= '<tr>';
            
            foreach ($this->columns as $name => $column) {
                $value = $row[$name] ?? '';
                
                if ($column['callback']) {
                    $value = call_user_func($column['callback'], $value, $row);
                }
                
                $html .= '<td>' . $value . '</td>';
            }
            
            if (!empty($this->actions)) {
                $html .= '<td>';
                
                foreach ($this->actions as $action) {
                    $url = is_callable($action['url']) ? call_user_func($action['url'], $row) : $action['url'];
                    $html .= '<a href="' . $url . '" class="' . $action['class'] . '">' . $action['label'] . '</a> ';
                }
                
                $html .= '</td>';
            }
            
            $html .= '</tr>';
        }
        
        $html .= '</tbody></table></div>';
        
        return $html;
    }
}