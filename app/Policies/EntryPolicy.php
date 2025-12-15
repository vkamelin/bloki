<?php

namespace App\Policies;

use App\Models\Entry;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class EntryPolicy
{
    use HandlesAuthorization;

    public function viewAny(Admin $user): bool
    {

    }

    public function view(Admin $user, Entry $entry): bool
    {
    }

    public function create(Admin $user): bool
    {
    }

    public function update(Admin $user, Entry $entry): bool
    {
    }

    public function delete(Admin $user, Entry $entry): bool
    {
    }

    public function restore(Admin $user, Entry $entry): bool
    {
    }

    public function forceDelete(Admin $user, Entry $entry): bool
    {
    }
}
