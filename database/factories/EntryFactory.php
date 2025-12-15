<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Collection;
use App\Models\Entry;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/** @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entry> */
class EntryFactory extends Factory
{
    protected $model = Entry::class;

    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'slug' => $this->faker->slug(),
            'name' => $this->faker->name(),
            'title' => $this->faker->word(),
            'status' => $this->faker->word(),
            'published_at' => Carbon::now(),
            'meta' => $this->faker->words(),
            'is_active' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'collection_id' => Collection::factory(),
            'cteated_by' => Admin::factory(),
            'updated_by' => Admin::factory(),
        ];
    }
}
