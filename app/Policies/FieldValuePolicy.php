<?php

namespace App\Policies;

use App\Models\FieldValue;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class FieldValuePolicy
{
    use HandlesAuthorization;

    public function viewAny(Admin $user): bool
    {

    }

    public function view(Admin $user, FieldValue $fieldValue): bool
    {
    }

    public function create(Admin $user): bool
    {
    }

    public function update(Admin $user, FieldValue $fieldValue): bool
    {
    }

    public function delete(Admin $user, FieldValue $fieldValue): bool
    {
    }

    public function restore(Admin $user, FieldValue $fieldValue): bool
    {
    }

    public function forceDelete(Admin $user, FieldValue $fieldValue): bool
    {
    }
}
