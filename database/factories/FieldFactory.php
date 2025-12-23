<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Field;
use App\Models\FieldGroup;
use App\Services\Dashboard\FieldConfiguration;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/** @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Field> */
class FieldFactory extends Factory
{
    protected $model = Field::class;
    
    protected $fieldConfig;
    
    protected function getFieldConfig(): FieldConfiguration
    {
        if ($this->fieldConfig === null) {
            $this->fieldConfig = new FieldConfiguration();
        }
        return $this->fieldConfig;
    }

    public function definition(): array
    {
        $fieldTypes = $this->getFieldConfig()->getFieldTypeNames();
        $randomType = $this->faker->randomElement($fieldTypes);
        
        return [
            'uuid' => $this->faker->uuid(),
            'name' => $this->faker->name(),
            'description' => $this->faker->word(),
            'instructions' => $this->faker->word(),
            'type' => $randomType,
            'settings' => $this->faker->words(),
            'required' => $this->faker->boolean(),
            'validation_rules' => $this->faker->words(),
            'list_visibility' => $this->faker->boolean(),
            'translatable' => $this->getFieldConfig()->isTranslatable($randomType),
            'searchable' => $this->getFieldConfig()->isSearchable($randomType),
            'is_active' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'group_id' => FieldGroup::factory(),
            'created_by' => Admin::factory(),
            'updated_by' => Admin::factory(),
        ];
    }
    
    /**
     * Create a field with a specific type
     *
     * @param string $type
     * @return static
     */
    public function withType(string $type): static
    {
        return $this->state(function (array $attributes) use ($type) {
            return [
                'type' => $type,
                'translatable' => $this->getFieldConfig()->isTranslatable($type),
                'searchable' => $this->getFieldConfig()->isSearchable($type),
            ];
        });
    }
}
