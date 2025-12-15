<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Collection;
use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/** @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Section> */
class SectionFactory extends Factory
{
    protected $model = Section::class;

    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'lft' => $this->faker->randomNumber(),
            'rgt' => $this->faker->randomNumber(),
            'slug' => $this->faker->slug(),
            'name' => $this->faker->name(),
            'title' => $this->faker->word(),
            'description' => $this->faker->text(),
            'status' => $this->faker->word(),
            'meta' => $this->faker->words(),
            'is_active' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'collection_id' => Collection::factory(),
            'parent_id' => Section::factory(),
            'created_by' => Admin::factory(),
            'updated_by' => Admin::factory(),
        ];
    }
}
