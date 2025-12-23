<?php

namespace App\Services\Dashboard;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;

class FieldConfiguration
{
    /**
     * Get all available field types
     *
     * @return array
     */
    public function getFieldTypes(): array
    {
        return Config::get('field_types', []);
    }

    /**
     * Get a specific field type configuration
     *
     * @param string $type
     * @return array|null
     */
    public function getFieldType(string $type): ?array
    {
        return Config::get("field_types.{$type}");
    }

    /**
     * Check if a field type exists
     *
     * @param string $type
     * @return bool
     */
    public function fieldTypeExists(string $type): bool
    {
        return Config::has("field_types.{$type}");
    }

    /**
     * Get available field type names
     *
     * @return array
     */
    public function getFieldTypeNames(): array
    {
        return array_keys($this->getFieldTypes());
    }

    /**
     * Get validation rules for a field type
     *
     * @param string $type
     * @param array $customRules
     * @return array
     */
    public function getValidationRules(string $type, array $customRules = []): array
    {
        $fieldType = $this->getFieldType($type);
        
        if (!$fieldType) {
            return $customRules;
        }
        
        $defaultRules = $fieldType['validation']['default_rules'] ?? [];
        $typeRules = $fieldType['validation']['rules'] ?? [];
        
        return array_merge($defaultRules, $typeRules, $customRules);
    }

    /**
     * Get database value type for a field type
     *
     * @param string $type
     * @return string|null
     */
    public function getDatabaseValueType(string $type): ?string
    {
        $fieldType = $this->getFieldType($type);
        
        if (!$fieldType) {
            return null;
        }
        
        return $fieldType['database']['value_type'] ?? null;
    }

    /**
     * Check if a field type is translatable
     *
     * @param string $type
     * @return bool
     */
    public function isTranslatable(string $type): bool
    {
        $fieldType = $this->getFieldType($type);
        
        if (!$fieldType) {
            return false;
        }
        
        return $fieldType['translatable'] ?? false;
    }

    /**
     * Check if a field type is searchable
     *
     * @param string $type
     * @return bool
     */
    public function isSearchable(string $type): bool
    {
        $fieldType = $this->getFieldType($type);
        
        if (!$fieldType) {
            return false;
        }
        
        return $fieldType['searchable'] ?? false;
    }

    /**
     * Get admin UI configuration for a field type
     *
     * @param string $type
     * @return array
     */
    public function getAdminUIConfig(string $type): array
    {
        $fieldType = $this->getFieldType($type);
        
        if (!$fieldType) {
            return [];
        }
        
        return $fieldType['admin_ui'] ?? [];
    }

    /**
     * Get public UI configuration for a field type
     *
     * @param string $type
     * @return array
     */
    public function getPublicUIConfig(string $type): array
    {
        $fieldType = $this->getFieldType($type);
        
        if (!$fieldType) {
            return [];
        }
        
        return $fieldType['public_ui'] ?? [];
    }

    /**
     * Validate field settings against field type configuration
     *
     * @param string $type
     * @param array $settings
     * @return array
     */
    public function validateSettings(string $type, array $settings): array
    {
        $fieldType = $this->getFieldType($type);
        
        if (!$fieldType) {
            return $settings;
        }
        
        // Add any field type specific validation here
        // For now, we just return the settings as-is
        return $settings;
    }
}