<?php

namespace Tests\Unit;

use App\Models\Admin;
use App\Models\Field;
use App\Models\FieldGroup;
use App\Services\Dashboard\FieldConfiguration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FieldTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_field()
    {
        $fieldGroup = FieldGroup::factory()->create();
        
        $field = Field::factory()->create([
            'group_id' => $fieldGroup->id,
            'name' => 'Test Field',
            'slug' => 'test-field',
            'type' => 'text',
            'description' => 'This is a test field',
            'instructions' => 'Enter some text',
            'required' => true,
            'translatable' => true,
            'searchable' => true,
            'is_active' => true,
        ]);

        $this->assertInstanceOf(Field::class, $field);
        $this->assertEquals($fieldGroup->id, $field->group_id);
        $this->assertEquals('Test Field', $field->name);
        $this->assertEquals('test-field', $field->slug);
        $this->assertEquals('text', $field->type);
        $this->assertEquals('This is a test field', $field->description);
        $this->assertEquals('Enter some text', $field->instructions);
        $this->assertTrue($field->required);
        $this->assertTrue($field->translatable);
        $this->assertTrue($field->searchable);
        $this->assertTrue($field->isActive());
    }

    /** @test */
    public function it_belongs_to_a_field_group()
    {
        $fieldGroup = FieldGroup::factory()->create();
        $field = Field::factory()->create(['group_id' => $fieldGroup->id]);

        $this->assertInstanceOf(FieldGroup::class, $field->group);
        $this->assertEquals($fieldGroup->id, $field->group->id);
    }

    /** @test */
    public function it_belongs_to_created_by_admin()
    {
        $admin = Admin::factory()->create();
        $field = Field::factory()->create([
            'created_by' => $admin->id,
        ]);

        $this->assertInstanceOf(Admin::class, $field->createdBy);
        $this->assertEquals($admin->id, $field->createdBy->id);
    }

    /** @test */
    public function it_belongs_to_updated_by_admin()
    {
        $admin = Admin::factory()->create();
        $field = Field::factory()->create([
            'updated_by' => $admin->id,
        ]);

        $this->assertInstanceOf(Admin::class, $field->updatedBy);
        $this->assertEquals($admin->id, $field->updatedBy->id);
    }

    /** @test */
    public function get_settings_returns_array()
    {
        $settings = ['max_length' => 255, 'placeholder' => 'Enter text'];
        $field = Field::factory()->create([
            'settings' => json_encode($settings),
            'type' => 'text',
        ]);

        $result = $field->getSettingsAttribute();
        $this->assertIsArray($result);
        $this->assertEquals(255, $result['max_length']);
        $this->assertEquals('Enter text', $result['placeholder']);
    }

    /** @test */
    public function set_settings_validates_and_encodes()
    {
        $field = Field::factory()->create(['type' => 'text']);
        $settings = ['max_length' => 255, 'placeholder' => 'Enter text'];

        $field->setSettingsAttribute($settings);

        $this->assertEquals(json_encode($settings), $field->attributes['settings']);
    }

    /** @test */
    public function get_validation_rules_returns_array()
    {
        $rules = ['min:3', 'max:255'];
        $field = Field::factory()->create([
            'validation_rules' => json_encode($rules),
            'type' => 'text',
        ]);

        $result = $field->getValidationRulesAttribute();
        $this->assertIsArray($result);
        $this->assertContains('min:3', $result);
        $this->assertContains('max:255', $result);
    }

    /** @test */
    public function set_validation_rules_encodes_to_json()
    {
        $field = Field::factory()->create();
        $rules = ['min:3', 'max:255'];

        $field->setValidationRulesAttribute($rules);

        $this->assertEquals(json_encode($rules), $field->attributes['validation_rules']);
    }

    /** @test */
    public function get_type_returns_field_type()
    {
        $field = Field::factory()->create(['type' => 'text']);

        $this->assertEquals('text', $field->getType());
    }

    /** @test */
    public function is_required_returns_correct_value()
    {
        $requiredField = Field::factory()->create(['required' => true]);
        $optionalField = Field::factory()->create(['required' => false]);

        $this->assertTrue($requiredField->isRequired());
        $this->assertFalse($optionalField->isRequired());
    }

    /** @test */
    public function is_translatable_uses_explicit_value_when_set()
    {
        $translatableField = Field::factory()->create([
            'translatable' => true,
            'type' => 'text',
        ]);
        $nonTranslatableField = Field::factory()->create([
            'translatable' => false,
            'type' => 'text',
        ]);

        $this->assertTrue($translatableField->isTranslatable());
        $this->assertFalse($nonTranslatableField->isTranslatable());
    }

    /** @test */
    public function is_searchable_uses_explicit_value_when_set()
    {
        $searchableField = Field::factory()->create([
            'searchable' => true,
            'type' => 'text',
        ]);
        $nonSearchableField = Field::factory()->create([
            'searchable' => false,
            'type' => 'text',
        ]);

        $this->assertTrue($searchableField->isSearchable());
        $this->assertFalse($nonSearchableField->isSearchable());
    }

    /** @test */
    public function get_list_visibility_returns_value()
    {
        $field = Field::factory()->create(['list_visibility' => 'visible']);

        $this->assertEquals('visible', $field->getListVisibility());
    }

    /** @test */
    public function is_active_returns_correct_value()
    {
        $activeField = Field::factory()->create(['is_active' => true]);
        $inactiveField = Field::factory()->create(['is_active' => false]);

        $this->assertTrue($activeField->isActive());
        $this->assertFalse($inactiveField->isActive());
    }

    /** @test */
    public function get_database_value_type_uses_field_configuration()
    {
        $field = Field::factory()->create(['type' => 'text']);

        // Тестируем, что метод существует
        $this->assertTrue(method_exists($field, 'getDatabaseValueType'));
        
        // TODO: Тестирование реального поведения после реализации
        // $this->assertEquals('string', $field->getDatabaseValueType());
    }

    /** @test */
    public function get_admin_ui_config_uses_field_configuration()
    {
        $field = Field::factory()->create(['type' => 'text']);

        // Тестируем, что метод существует
        $this->assertTrue(method_exists($field, 'getAdminUIConfig'));
    }

    /** @test */
    public function get_public_ui_config_uses_field_configuration()
    {
        $field = Field::factory()->create(['type' => 'text']);

        // Тестируем, что метод существует
        $this->assertTrue(method_exists($field, 'getPublicUIConfig'));
    }

    /** @test */
    public function it_handles_soft_deletes()
    {
        $field = Field::factory()->create();
        $fieldId = $field->id;

        $field->delete();

        $this->assertSoftDeleted($field);
        $this->assertNotNull(Field::withTrashed()->find($fieldId));
    }

    /** @test */
    public function it_casts_settings_to_array()
    {
        $settings = ['key' => 'value', 'number' => 42];
        $field = Field::factory()->create([
            'settings' => $settings,
            'type' => 'text',
        ]);

        $this->assertIsArray($field->settings);
        $this->assertEquals('value', $field->settings['key']);
        $this->assertEquals(42, $field->settings['number']);
    }

    /** @test */
    public function it_casts_required_to_boolean()
    {
        $field = Field::factory()->create(['required' => true]);
        $this->assertIsBool($field->required);
        $this->assertTrue($field->required);
    }

    /** @test */
    public function it_casts_translatable_to_boolean()
    {
        $field = Field::factory()->create(['translatable' => true]);
        $this->assertIsBool($field->translatable);
        $this->assertTrue($field->translatable);
    }

    /** @test */
    public function it_casts_searchable_to_boolean()
    {
        $field = Field::factory()->create(['searchable' => true]);
        $this->assertIsBool($field->searchable);
        $this->assertTrue($field->searchable);
    }

    /** @test */
    public function it_casts_list_visibility_to_boolean()
    {
        $field = Field::factory()->create(['list_visibility' => true]);
        $this->assertIsBool($field->list_visibility);
        $this->assertTrue($field->list_visibility);
    }

    /** @test */
    public function it_casts_is_active_to_boolean()
    {
        $field = Field::factory()->create(['is_active' => true]);
        $this->assertIsBool($field->is_active);
        $this->assertTrue($field->is_active);
    }

    /** @test */
    public function it_handles_different_field_types()
    {
        $types = ['text', 'textarea', 'number', 'email', 'url', 'select'];
        
        foreach ($types as $type) {
            $field = Field::factory()->create(['type' => $type]);
            $this->assertEquals($type, $field->type);
        }
    }

    /** @test */
    public function it_handles_uuid()
    {
        $field = Field::factory()->create();

        $this->assertNotNull($field->uuid);
        $this->assertIsString($field->uuid);
    }
}