<?php

namespace Database\Factories;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/** @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permission> */
class PermissionFactory extends Factory
{
    protected $model = Permission::class;

    public function definition(): array
    {
        return [
            'role_id' => \App\Models\Role::factory(),
            'collection_id' => null,
            'field_group_id' => null,
            'action' => $this->faker->randomElement(['read', 'write', 'delete']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}