<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default roles
        $adminRole = Role::create([
            'name' => 'Administrator',
            'slug' => 'admin',
            'description' => 'Full access to all system features'
        ]);

        $editorRole = Role::create([
            'name' => 'Editor',
            'slug' => 'editor',
            'description' => 'Can manage content but not users or settings'
        ]);

        $authorRole = Role::create([
            'name' => 'Author',
            'slug' => 'author',
            'description' => 'Can create and edit own content'
        ]);

        // Create default permissions for admin role
        Permission::create([
            'role_id' => $adminRole->id,
            'action' => 'read',
        ]);

        Permission::create([
            'role_id' => $adminRole->id,
            'action' => 'write',
        ]);

        Permission::create([
            'role_id' => $adminRole->id,
            'action' => 'delete',
        ]);

        // Create default permissions for editor role
        Permission::create([
            'role_id' => $editorRole->id,
            'action' => 'read',
        ]);

        Permission::create([
            'role_id' => $editorRole->id,
            'action' => 'write',
        ]);

        // Create default permissions for author role
        Permission::create([
            'role_id' => $authorRole->id,
            'action' => 'read',
        ]);

        Permission::create([
            'role_id' => $authorRole->id,
            'action' => 'write',
        ]);
    }
}