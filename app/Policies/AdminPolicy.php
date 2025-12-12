<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    public function viewAny(Admin $user): bool
    {

    }

    public function view(Admin $user, Admin $admin): bool
    {
    }

    public function create(Admin $user): bool
    {
    }

    public function update(Admin $user, Admin $admin): bool
    {
    }

    public function delete(Admin $user, Admin $admin): bool
    {
    }

    public function restore(Admin $user, Admin $admin): bool
    {
    }

    public function forceDelete(Admin $user, Admin $admin): bool
    {
    }
}
