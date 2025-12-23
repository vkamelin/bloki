<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\Dashboard\FieldConfiguration;

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

    protected $fieldConfig;

    protected function getFieldConfig(): FieldConfiguration
    {
        if ($this->fieldConfig === null) {
            $this->fieldConfig = new FieldConfiguration();
        }
        return $this->fieldConfig;
    }

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
        return json_decode($this->attributes['settings'], true) ?? [];
    }

    public function setSettingsAttribute(array $settings): void
    {
        // Validate settings against field type configuration
        $validatedSettings = $this->getFieldConfig()->validateSettings($this->attributes['type'], $settings);
        $this->attributes['settings'] = json_encode($validatedSettings, JSON_UNESCAPED_UNICODE);
    }

    public function getValidationRulesAttribute(): array
    {
        $customRules = json_decode($this->attributes['validation_rules'], true) ?? [];
        return $this->getFieldConfig()->getValidationRules($this->attributes['type'], $customRules);
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
        // If translatable is explicitly set, use that value
        if (isset($this->attributes['translatable'])) {
            return (bool)$this->attributes['translatable'];
        }
        
        // Otherwise, use the field type configuration
        return $this->getFieldConfig()->isTranslatable($this->attributes['type']);
    }

    public function isSearchable(): bool
    {
        // If searchable is explicitly set, use that value
        if (isset($this->attributes['searchable'])) {
            return (bool)$this->attributes['searchable'];
        }
        
        // Otherwise, use the field type configuration
        return $this->getFieldConfig()->isSearchable($this->attributes['type']);
    }

    public function getListVisibility(): string
    {
        return $this->attributes['list_visibility'];
    }

    public function isActive(): bool
    {
        return (bool)$this->attributes['is_active'];
    }

    public function getDatabaseValueType(): ?string
    {
        return $this->getFieldConfig()->getDatabaseValueType($this->attributes['type']);
    }

    public function getAdminUIConfig(): array
    {
        return $this->getFieldConfig()->getAdminUIConfig($this->attributes['type']);
    }

    public function getPublicUIConfig(): array
    {
        return $this->getFieldConfig()->getPublicUIConfig($this->attributes['type']);
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
