<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    /**
     * Get the admins for the role.
     */
    public function admins()
    {
        return $this->belongsToMany(Admin::class, 'admin_roles');
    }

    /**
     * Get the permissions for the role.
     */
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
