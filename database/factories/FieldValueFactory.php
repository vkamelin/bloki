<?php

namespace Database\Factories;

use App\Models\Field;
use App\Models\FieldValue;
use App\Services\Dashboard\FieldConfiguration;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/** @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FieldValue> */
class FieldValueFactory extends Factory
{
    protected $model = FieldValue::class;
    
    protected $fieldConfig;
    
    public function __construct($parameters = [])
    {
        parent::__construct($parameters);
        $this->fieldConfig = new FieldConfiguration();
    }

    public function definition(): array
    {
        // Create a field first to get a valid field type
        $field = Field::factory()->create();
        
        // Create a field value with the correct value type for the field
        $fieldValue = new FieldValue();
        $fieldValue->setValue($this->generateValueForType($field->getDatabaseValueType()), $field->getDatabaseValueType());
        
        return [
            'entity_type' => $this->faker->word(),
            'entity_id' => $this->faker->randomNumber(),
            'value_type' => $fieldValue->value_type,
            'value_string' => $fieldValue->value_string,
            'value_text' => $fieldValue->value_text,
            'value_int' => $fieldValue->value_int,
            'value_float' => $fieldValue->value_float,
            'value_bool' => $fieldValue->value_bool,
            'value_json' => $fieldValue->value_json,
            'value_date' => $fieldValue->value_date,
            'value_datetime' => $fieldValue->value_datetime,
            'locale' => $this->faker->word(),
            'is_active' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'field_id' => $field->id,
        ];
    }
    
    protected function generateValueForType(?string $valueType): mixed
    {
        switch ($valueType) {
            case 'string':
                return $this->faker->word();
            case 'text':
                return $this->faker->text();
            case 'integer':
                return $this->faker->randomNumber();
            case 'float':
                return $this->faker->randomFloat();
            case 'boolean':
                return $this->faker->boolean();
            case 'json':
                return $this->faker->words();
            case 'date':
                return Carbon::now()->toDateString();
            case 'datetime':
                return Carbon::now();
            default:
                return $this->faker->word();
        }
    }
}
