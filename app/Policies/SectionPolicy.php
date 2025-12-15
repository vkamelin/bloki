<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Section;
use Illuminate\Auth\Access\HandlesAuthorization;

class SectionPolicy
{
    use HandlesAuthorization;

    public function viewAny(Admin $user): bool
    {

    }

    public function view(Admin $user, Section $section): bool
    {
    }

    public function create(Admin $user): bool
    {
    }

    public function update(Admin $user, Section $section): bool
    {
    }

    public function delete(Admin $user, Section $section): bool
    {
    }

    public function restore(Admin $user, Section $section): bool
    {
    }

    public function forceDelete(Admin $user, Section $section): bool
    {
    }
}
