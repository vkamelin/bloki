<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FieldValue extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'field_id',
        'entity_type',
        'entity_id',
        'value_type',
        'value_string',
        'value_text',
        'value_int',
        'value_float',
        'value_bool',
        'value_json',
        'value_date',
        'value_datetime',
        'locale',
        'is_active',
    ];

    public function field(): BelongsTo
    {
        return $this->belongsTo(Field::class);
    }

    public function getValue(): mixed
    {
        switch ($this->value_type) {
            case 'string':
                return $this->value_string;
            case 'text':
                return $this->value_text;
            case 'integer':
                return $this->value_int;
            case 'float':
                return $this->value_float;
            case 'boolean':
                return $this->value_bool;
            case 'json':
                return $this->value_json;
            case 'date':
                return $this->value_date;
            case 'datetime':
                return $this->value_datetime;
            default:
                return null;
        }
    }
    
    public function setValue(mixed $value, ?string $valueType = null): void
    {
        // If value type is not provided, try to determine it from the field
        if (!$valueType && $this->field) {
            $valueType = $this->field->getDatabaseValueType();
        }
        
        // If we still don't have a value type, try to infer it from the value
        if (!$valueType) {
            $valueType = $this->inferValueType($value);
        }
        
        $this->value_type = $valueType;
        
        // Set the appropriate value field based on the value type
        switch ($valueType) {
            case 'string':
                $this->value_string = (string)$value;
                break;
            case 'text':
                $this->value_text = (string)$value;
                break;
            case 'integer':
                $this->value_int = (int)$value;
                break;
            case 'float':
                $this->value_float = (float)$value;
                break;
            case 'boolean':
                $this->value_bool = (bool)$value;
                break;
            case 'json':
                $this->value_json = $value;
                break;
            case 'date':
                $this->value_date = $value;
                break;
            case 'datetime':
                $this->value_datetime = $value;
                break;
        }
    }
    
    protected function inferValueType(mixed $value): string
    {
        if (is_bool($value)) {
            return 'boolean';
        } elseif (is_int($value)) {
            return 'integer';
        } elseif (is_float($value)) {
            return 'float';
        } elseif (is_array($value) || is_object($value)) {
            return 'json';
        } elseif ($this->isDate($value)) {
            return 'date';
        } elseif ($this->isDateTime($value)) {
            return 'datetime';
        } elseif (strlen((string)$value) > 255) {
            return 'text';
        } else {
            return 'string';
        }
    }
    
    public function isDate(mixed $value): bool
    {
        if (!is_string($value)) {
            return false;
        }
        
        $date = date_parse($value);
        return $date['error_count'] === 0 && $date['warning_count'] === 0 && strlen($value) <= 10;
    }
    
    public function isDateTime(mixed $value): bool
    {
        if (!is_string($value)) {
            return false;
        }
        
        $date = date_parse($value);
        return $date['error_count'] === 0 && $date['warning_count'] === 0 && strlen($value) > 10;
    }

    protected function casts(): array
    {
        return [
            'value_bool' => 'boolean',
            'value_json' => 'array',
            'value_date' => 'date',
            'value_datetime' => 'datetime',
            'is_active' => 'boolean',
        ];
    }
}
