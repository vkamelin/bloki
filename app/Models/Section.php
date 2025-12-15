<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'collection_id',
        'parent_id',
        'lft',
        'rgt',
        'slug',
        'name',
        'title',
        'description',
        'status',
        'meta',
        'is_active',
        'created_by',
        'updated_by',
    ];

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'parent_id');
    }

    // hasMany Sections (children)
    public function children(): HasMany
    {
        return $this->hasMany(Section::class, 'parent_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    public function getMetaAttribute(): array
    {
        return json_decode($this->attributes['meta'], true);
    }

    public function setMetaAttribute($value): void
    {
        $this->attributes['meta'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Получение дочерних разделов
     */
    public function getChildren(): Collection
    {
        return $this->children()->get();
    }

    protected function casts(): array
    {
        return [
            'uuid' => 'string',
            'meta' => 'array',
            'is_active' => 'boolean',
        ];
    }
}
