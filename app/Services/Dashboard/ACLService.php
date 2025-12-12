<?php

namespace App\Services\Dashboard;

use App\Models\Admin;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class ACLService
{
    /**
     * Assign a role to an admin.
     */
    public function assignRole(Admin $admin, Role $role): void
    {
        $admin->roles()->syncWithoutDetaching([$role->id]);
    }

    /**
     * Remove a role from an admin.
     */
    public function removeRole(Admin $admin, Role $role): void
    {
        $admin->roles()->detach($role->id);
    }

    /**
     * Assign multiple roles to an admin.
     */
    public function assignRoles(Admin $admin, array $roles): void
    {
        $admin->roles()->sync($roles);
    }

    /**
     * Check if admin has a specific role.
     */
    public function hasRole(Admin $admin, string $roleSlug): bool
    {
        return $admin->hasRole($roleSlug);
    }

    /**
     * Check if admin has a specific permission.
     */
    public function hasPermission(Admin $admin, string $permission): bool
    {
        return $admin->hasPermission($permission);
    }

    /**
     * Create a new role.
     */
    public function createRole(array $data): Role
    {
        return Role::create($data);
    }

    /**
     * Update an existing role.
     */
    public function updateRole(Role $role, array $data): Role
    {
        $role->update($data);
        return $role;
    }

    /**
     * Delete a role.
     */
    public function deleteRole(Role $role): void
    {
        $role->delete();
    }

    /**
     * Create a new permission.
     */
    public function createPermission(array $data): Permission
    {
        return Permission::create($data);
    }

    /**
     * Update an existing permission.
     */
    public function updatePermission(Permission $permission, array $data): Permission
    {
        $permission->update($data);
        return $permission;
    }

    /**
     * Delete a permission.
     */
    public function deletePermission(Permission $permission): void
    {
        $permission->delete();
    }

    /**
     * Get all roles for an admin.
     */
    public function getAdminRoles(Admin $admin): array
    {
        return $admin->roles->toArray();
    }

    /**
     * Get all permissions for a role.
     */
    public function getRolePermissions(Role $role): array
    {
        return $role->permissions->toArray();
    }
}