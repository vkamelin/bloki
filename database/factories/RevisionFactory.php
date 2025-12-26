<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Revision;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/** @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Revision> */
class RevisionFactory extends Factory
{
    protected $model = Revision::class;

    public function definition(): array
    {
        return [
            'entity_type' => $this->faker->word(),
            'entity_id' => $this->faker->randomNumber(),
            'data' => $this->faker->words(),
            'timestamp' => Carbon::now(),
            'note' => $this->faker->word(),
            'created_by' => Admin::factory(),
        ];
    }
}
