<?php

namespace App\Models;

use Dom\Entity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Revision extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'entry_type',
        'entry_id',
        'data',
        'created_by',
        'timestamp',
        'note',
    ];

    public function entry(): BelongsTo
    {
        return $this->belongsTo(Entry::class, 'entity_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function getDataAttribute(): array
    {
        return json_decode($this->attributes['data'], true);
    }

    public function setDataAttribute(array $data): void
    {
        $this->attributes['data'] = json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    protected function casts(): array
    {
        return [
            'data' => 'array',
            'timestamp' => 'timestamp',
        ];
    }
}
