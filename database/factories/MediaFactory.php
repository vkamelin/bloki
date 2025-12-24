<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/** @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Media> */
class MediaFactory extends Factory
{
    protected $model = Media::class;

    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'path' => $this->faker->word(),
            'original_name' => $this->faker->name(),
            'mime_type' => $this->faker->word(),
            'size' => $this->faker->randomNumber(),
            'alt_text' => $this->faker->text(),
            'caption' => $this->faker->word(),
            'transforms' => $this->faker->words(),
            'is_active' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'created_by' => Admin::factory(),
            'updated_by' => Admin::factory(),
        ];
    }
}
