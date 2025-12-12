<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'remember_token',
        'is_active',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Hash the password when setting it.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Get the role for the admin.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the roles for the admin (many-to-many).
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles');
    }

    /**
     * Check if admin has a specific role.
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('slug', $role);
        }

        return !!$role->intersect($this->roles)->count();
    }

    /**
     * Check if admin has a specific permission.
     */
    public function hasPermission($permission)
    {
        // If admin has role, check role permissions
        if ($this->role) {
            return $this->role->permissions->contains('action', $permission);
        }

        return false;
    }
}