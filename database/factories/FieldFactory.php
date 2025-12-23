<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Field;
use App\Models\FieldGroup;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/** @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Field> */
class FieldFactory extends Factory
{
    protected $model = Field::class;

    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'name' => $this->faker->name(),
            'description' => $this->faker->word(),
            'instructions' => $this->faker->word(),
            'type' => $this->faker->word(),
            'settings' => $this->faker->words(),
            'required' => $this->faker->boolean(),
            'validation_rules' => $this->faker->words(),
            'list_visibility' => $this->faker->boolean(),
            'translatable' => $this->faker->boolean(),
            'searchable' => $this->faker->boolean(),
            'is_active' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'group_id' => FieldGroup::factory(),
            'created_by' => Admin::factory(),
            'updated_by' => Admin::factory(),
        ];
    }
}
