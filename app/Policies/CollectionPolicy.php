<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Collection;
use Illuminate\Auth\Access\HandlesAuthorization;

class CollectionPolicy
{
    use HandlesAuthorization;

    public function viewAny(Admin $user): bool
    {

    }

    public function view(Admin $user, Collection $collection): bool
    {
    }

    public function create(Admin $user): bool
    {
    }

    public function update(Admin $user, Collection $collection): bool
    {
    }

    public function delete(Admin $user, Collection $collection): bool
    {
    }

    public function restore(Admin $user, Collection $collection): bool
    {
    }

    public function forceDelete(Admin $user, Collection $collection): bool
    {
    }
}
