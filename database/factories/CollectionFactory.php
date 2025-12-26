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
            'has_sections' => $this->faker->boolean(),
            'section_structure' => $this->faker->randomElement(['tree', 'single']),
            'entry_behavior' => $this->faker->randomElements(['auto_slug', 'revision_control', 'publishing_workflow', 'custom_permissions'], $count = $this->faker->numberBetween(0, 4)),
            'is_singleton' => $this->faker->boolean(),
            'full_text_search' => $this->faker->boolean(),
            'default_template_section' => $this->faker->word(),
            'default_template_entry' => $this->faker->word(),
            'route_patterns' => $this->faker->randomElements(['/collections/{slug}', '/{slug}', '/category/{slug}', '/tags/{slug}'], $count = $this->faker->numberBetween(0, 4)),
            'api_visibility' => $this->faker->randomElements(['public', 'admin', 'authenticated'], $count = $this->faker->numberBetween(1, 3)),
            'is_active' => $this->faker->boolean(),
            'created_by' => Admin::factory(),
            'updated_by' => Admin::factory(),
        ];
    }
}
