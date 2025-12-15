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
        'cteated_by',
        'updated_by',
    ];

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

    public function cteatedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'cteated_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'updated_by');
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
