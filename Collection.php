<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collection extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'description',
        'icon',
        'has_sections',
        'section_structure',
        'entry_behavior',
        'is_singleton',
        'full_text_search',
        'default_template_section',
        'default_template_entry',
        'route_patterns',
        'api_visibility',
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

    protected function casts(): array
    {
        return [
            'uuid' => 'string',
            'entry_behavior' => 'array',
            'is_singleton' => 'boolean',
            'full_text_search' => 'boolean',
            'route_patterns' => 'array',
            'api_visibility' => 'array',
            'is_active' => 'boolean',
        ];
    }
}
