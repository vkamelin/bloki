<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'path',
        'original_name',
        'mime_type',
        'size',
        'alt_text',
        'caption',
        'transforms',
        'is_active',
        'created_by',
        'updated_by',
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    public function getTransformsAttribute(): array
    {
        return json_decode($this->attributes['transforms'], true);
    }

    public function setTransformsAttribute(array $attributes): void
    {
        $this->attributes['transforms'] = json_encode($attributes, JSON_UNESCAPED_UNICODE);
    }

    public function getFullPath(): string
    {
        return $this->attributes['path'] . '/' . $this->attributes['original_name'];
    }

    /**
     * @param array $preset Установки для трансформации файла
     * @return string
     */
    public function getTransformedPath(array $preset): string
    {
        // TODO: Реализовать трансформацию файла (изображения) в соответствии с переданными установками

        return '';
    }

    public function isActive(): bool
    {
        return (bool)$this->attributes['is_active'];
    }

    protected function casts(): array
    {
        return [
            'uuid' => 'string',
            'transforms' => 'array',
            'is_active' => 'boolean',
        ];
    }
}
