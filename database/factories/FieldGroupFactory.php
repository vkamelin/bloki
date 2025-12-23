<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\FieldGroup;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/** @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FieldGroup> */
class FieldGroupFactory extends Factory
{
    protected $model = FieldGroup::class;

    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'is_global' => $this->faker->boolean(),
            'rules' => $this->faker->words(),
            'is_active' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'created_by' => Admin::factory(),
            'updated_by' => Admin::factory(),
        ];
    }
}
