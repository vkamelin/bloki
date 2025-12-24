<?php

namespace App\Policies;

use App\Models\Revision;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RevisionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Revision $revision): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Revision $revision): bool
    {
    }

    public function delete(User $user, Revision $revision): bool
    {
    }

    public function restore(User $user, Revision $revision): bool
    {
    }

    public function forceDelete(User $user, Revision $revision): bool
    {
    }
}
