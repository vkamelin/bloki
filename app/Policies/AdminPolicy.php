<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    public function viewAny(Admin $user): bool
    {
        // Администраторы могут просматривать список всех администраторов
        return true;
    }

    public function view(Admin $user, Admin $admin): bool
    {
        // Администраторы могут просматривать профили других администраторов
        return true;
    }

    public function create(Admin $user): bool
    {
        // Только суперадминистраторы могут создавать новых администраторов
        return $user->hasRole('superadmin');
    }

    public function update(Admin $user, Admin $admin): bool
    {
        // Администраторы могут обновлять свои собственные данные
        // Суперадминистраторы могут обновлять данные любых администраторов
        return $user->id === $admin->id || $user->hasRole('superadmin');
    }

    public function delete(Admin $user, Admin $admin): bool
    {
        // Администраторы не могут удалять сами себя
        // Суперадминистраторы могут удалять любых администраторов, кроме себя
        return $user->id !== $admin->id && $user->hasRole('superadmin');
    }

    public function restore(Admin $user, Admin $admin): bool
    {
        // Только суперадминистраторы могут восстанавливать удаленных администраторов
        return $user->hasRole('superadmin');
    }

    public function forceDelete(Admin $user, Admin $admin): bool
    {
        // Только суперадминистраторы могут окончательно удалять администраторов
        return $user->hasRole('superadmin');
    }
}
