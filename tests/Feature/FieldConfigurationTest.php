<?php

namespace Tests\Feature;

use App\Models\Field;
use App\Models\FieldGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FieldConfigurationTest extends TestCase
{
    use RefreshDatabase;

    public function test_field_types_are_loaded_from_configuration()
    {
        // Create a field group
        $group = FieldGroup::factory()->create();

        // Create a field with a valid type from configuration
        $field = Field::factory()->withType('text')->create([
            'group_id' => $group->id,
        ]);

        // Check that the field was created successfully
        $this->assertDatabaseHas('fields', [
            'id' => $field->id,
            'type' => 'text'
        ]);

        // Check that the field has the correct configuration
        $this->assertTrue($field->isTranslatable());
        $this->assertTrue($field->isSearchable());
        $this->assertEquals('string', $field->getDatabaseValueType());
    }

    public function test_field_validation_rules_are_loaded_from_configuration()
    {
        // Create a field group
        $group = FieldGroup::factory()->create();

        // Create a field with a valid type from configuration
        $field = Field::factory()->withType('email')->create([
            'group_id' => $group->id,
        ]);

        // Check that the field has the correct validation rules
        $rules = $field->validation_rules;
        $this->assertContains('email', $rules);
        $this->assertContains('required', $rules);
    }

    public function test_field_value_is_set_with_correct_type()
    {
        // Create a field group
        $group = FieldGroup::factory()->create();

        // Create a field with a valid type from configuration
        $field = Field::factory()->withType('number')->create([
            'group_id' => $group->id,
        ]);

        // Check that the field has the correct database value type
        $this->assertEquals('integer', $field->getDatabaseValueType());
    }

    public function test_get_field_types_endpoint()
    {
        // Test that the field types endpoint returns the configuration
        $response = $this->get('/api/fields/types');
        
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'text',
            'textarea',
            'richtext',
            'number',
            'email',
            'url',
            'date',
            'datetime',
            'boolean',
            'select',
            'multiselect',
            'file',
            'image'
        ]);
    }
}