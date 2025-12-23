<?php

namespace App\Policies;

use App\Models\FieldGroup;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class FieldGroupPolicy
{
    use HandlesAuthorization;

    public function viewAny(Admin $user): bool
    {

    }

    public function view(Admin $user, FieldGroup $fieldGroup): bool
    {
    }

    public function create(Admin $user): bool
    {
    }

    public function update(Admin $user, FieldGroup $fieldGroup): bool
    {
    }

    public function delete(Admin $user, FieldGroup $fieldGroup): bool
    {
    }

    public function restore(Admin $user, FieldGroup $fieldGroup): bool
    {
    }

    public function forceDelete(Admin $user, FieldGroup $fieldGroup): bool
    {
    }
}
