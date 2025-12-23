<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class FieldGroup extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'name',
        'description',
        'is_global',
        'rules',
        'is_active',
        'created_by',
        'updated_by',
    ];

    public function fields(): HasMany
    {
        return $this->hasMany(Fields::class, 'group_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    public function getRulesAttribute(): array
    {
        return json_decode($this->attributes['rules'], true);
    }

    public function setRulesAttribute(): void
    {
        $this->attributes['rules'] = json_encode(json_decode($this->attributes['rules'], true));
    }

    public function getFields(): \Illuminate\Support\Collection
    {
        return $this->fileds->get();
    }

    public function isGlobal(): bool
    {
        return (bool)$this->attributes['is_global'];
    }

    public function isActive(): bool
    {
        return (bool)$this->attributes['is_active'];
    }

    protected function casts(): array
    {
        return [
            'uuid' => 'string',
            'is_global' => 'boolean',
            'rules' => 'array',
            'is_active' => 'boolean',
        ];
    }
}
