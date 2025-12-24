<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'collection_id',
        'field_group_id',
        'action',
    ];

    public $timestamps = true;

    /**
     * Get the role that owns the permission.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the collection that owns the permission.
     */
    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    /**
     * Get the field group that owns the permission.
     */
    public function fieldGroup()
    {
        return $this->belongsTo(FieldGroup::class);
    }
}