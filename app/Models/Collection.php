<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string $slug
 * @property string|null $description
 * @property string|null $icon
 * @property bool $has_sections
 * @property string $section_structure
 * @property array $entry_behavior
 * @property bool $is_singleton
 * @property bool $full_text_search
 * @property string|null $default_template_section
 * @property string|null $default_template_entry
 * @property array $route_patterns
 * @property array $api_visibility
 * @property bool $is_active
 * @property int|null $created_by
 * @property int|null $updated_by
 */
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

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }

    public function entries(): HasMany
    {
        return $this->hasMany(Entry::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    public function isSingleton(): bool
    {
        return (bool)$this->is_singleton;
    }

    public function hasSections(): bool
    {
        return (bool)$this->has_sections;
    }

    public function getSectionStructure(): array
    {
        return json_decode($this->section_structure, true);
    }

    public function getDefaultTemplateSection(): ?string
    {
        return $this->default_template_section;
    }

    public function getDefaultTemplateEntry(): ?string
    {
        return $this->default_template_entry;
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
