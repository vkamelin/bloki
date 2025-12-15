<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entry extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'collection_id',
        'slug',
        'name',
        'title',
        'status',
        'published_at',
        'meta',
        'is_active',
        'created_by',
        'updated_by',
    ];

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
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

    public function getCollection(): Collection
    {
        return $this->collection()->first();
    }

    public function isActive(): bool
    {
        return ($this->is_active ?? false);
    }

    public function isDraft(): bool
    {
        return $this->attributes['status'] === 'draft';
    }

    public function isPublished(): bool
    {
        return $this->attributes['status'] === 'published';
    }

    public function isReview(): bool
    {
        return $this->attributes['status'] === 'review';
    }

    public function isArchived(): bool
    {
        return $this->attributes['status'] === 'archived';
    }

    public function getFieldValue(string $fieldHandle)
    {
        // TODO: Получение значения поля $fieldHandle для текущей записи
    }

    public function setFieldValue(string $fieldHandle, $value)
    {
        // TODO: Запись значения $value поля $fieldHandle для текущей записи
    }

    protected function casts(): array
    {
        return [
            'uuid' => 'string',
            'published_at' => 'timestamp',
            'meta' => 'array',
            'is_active' => 'boolean',
        ];
    }
}
