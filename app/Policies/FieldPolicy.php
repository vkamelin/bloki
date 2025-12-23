<?php

namespace App\Policies;

use App\Models\Field;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class FieldPolicy
{
    use HandlesAuthorization;

    public function viewAny(Admin $user): bool
    {

    }

    public function view(Admin $user, Field $field): bool
    {
    }

    public function create(Admin $user): bool
    {
    }

    public function update(Admin $user, Field $field): bool
    {
    }

    public function delete(Admin $user, Field $field): bool
    {
    }

    public function restore(Admin $user, Field $field): bool
    {
    }

    public function forceDelete(Admin $user, Field $field): bool
    {
    }
}
