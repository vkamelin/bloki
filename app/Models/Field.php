<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Field extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'group_id',
        'uuid',
        'name',
        'description',
        'instructions',
        'type',
        'settings',
        'required',
        'validation_rules',
        'list_visibility',
        'translatable',
        'searchable',
        'is_active',
        'created_by',
        'updated_by',
        'updated_by',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(FieldGroup::class, 'group_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }

    public function getSettingsAttribute(): array
    {
        return json_decode($this->attributes['settings'], true);
    }

    public function setSettingsAttribute(array $settings): void
    {
        $this->attributes['settings'] = json_encode($settings, JSON_UNESCAPED_UNICODE);
    }

    public function getValidationRulesAttribute(): array
    {
        return json_decode($this->attributes['validation_rules'], true);
    }

    public function setValidationRulesAttribute(array $validation_rules): void
    {
        $this->attributes['validation_rules'] = json_encode($validation_rules, JSON_UNESCAPED_UNICODE);
    }

    public function getType(): string
    {
        return $this->attributes['type'];
    }

    public function isRequired(): bool
    {
        return (bool)$this->attributes['required'];
    }

    public function isTranslatable(): bool
    {
        return (bool)$this->attributes['translatable'];
    }

    public function isSearchable(): bool
    {
        return (bool)$this->attributes['searchable'];
    }

    public function getListVisibility(): string
    {
        return $this->attributes['list_visibility'];
    }

    public function isActive(): bool
    {
        return (bool)$this->attributes['is_active'];
    }

    protected function casts(): array
    {
        return [
            'uuid' => 'string',
            'settings' => 'array',
            'required' => 'boolean',
            'validation_rules' => 'array',
            'list_visibility' => 'boolean',
            'translatable' => 'boolean',
            'searchable' => 'boolean',
            'is_active' => 'boolean',
        ];
    }
}
