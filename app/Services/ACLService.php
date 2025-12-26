<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\Permission;
use App\Models\Role;

class ACLService
{
    public function __construct()
    {
    }

    public function assignRole(Admin|int $admin, Role|int $role)
    {
        // TODO: Реализовать назначение роли администратору
    }

    public function removeRole(Admin|int $admin, Role|int $role)
    {
        // TODO: Реализовать удаление роли у администратора
    }

    public function assignRoles(Admin|array $admins, array $roles)
    {
        // TODO: Реализовать назначение ролей администратору
    }

    public function hasRole(Admin|int $admin, string $roleSlug): bool
    {
        // TODO: Реализовать проверка наличия роли у администратора
    }

    public function hasPermission(Admin|int $admin, Permission|string $permission): bool
    {
        // TODO: Реализовать проверка наличия разрешения у администратора
    }

    public function createRole(array $data): Role|null
    {
        // TODO: Реализовать создание роли
    }

    public function updateRole(Role|int $role, array $data): Role|null
    {
        // TODO: Реализовать обновление роли
    }

    public function deleteRole(Role|int $role): bool
    {
        // TODO: Реализовать удаление роли
    }

    public function createPermission(array $data): Permission|null
    {
        // TODO: Реализовать создание разрешения
    }

    public function updatePermission(Permission|int $permission, array $data): Permission|null
    {
        // TODO: Реализовать обновление разрешения
    }

    public function deletePermission(Permission|int $permission): bool
    {
        // TODO: Реализовать удаление разрешения
    }

    public function getAdminRoles(Admin|int $admin): array
    {
        // TODO: Реализовать получение ролей администратора
    }

    public function getRolePermissions(Role|int $role): array
    {
        // TODO: Реализовать получение разрешений роли
    }
}
