<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/** @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Collection> */
class CollectionFactory extends Factory
{
    protected $model = Collection::class;

    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->text(),
            'icon' => $this->faker->word(),
            'has_sections' => $this->faker->word(),
            'section_structure' => $this->faker->word(),
            'entry_behavior' => $this->faker->words(),
            'is_singleton' => $this->faker->boolean(),
            'full_text_search' => $this->faker->text(),
            'default_template_section' => $this->faker->word(),
            'default_template_entry' => $this->faker->word(),
            'route_patterns' => $this->faker->words(),
            'api_visibility' => $this->faker->words(),
            'is_active' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'created_by' => Admin::factory(),
            'updated_by' => Admin::factory(),
        ];
    }
}
