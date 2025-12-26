<?php

namespace Tests\Unit;

use App\Models\Admin;
use App\Models\Field;
use App\Models\FieldGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FieldGroupTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_field_group()
    {
        $fieldGroup = FieldGroup::factory()->create([
            'name' => 'Test Field Group',
            'description' => 'This is a test field group',
            'is_global' => true,
            'is_active' => true,
        ]);

        $this->assertInstanceOf(FieldGroup::class, $fieldGroup);
        $this->assertEquals('Test Field Group', $fieldGroup->name);
        $this->assertEquals('This is a test field group', $fieldGroup->description);
        $this->assertTrue($fieldGroup->isGlobal());
        $this->assertTrue($fieldGroup->isActive());
    }

    /** @test */
    public function it_has_many_fields()
    {
        $fieldGroup = FieldGroup::factory()->create();
        $field1 = Field::factory()->create(['group_id' => $fieldGroup->id]);
        $field2 = Field::factory()->create(['group_id' => $fieldGroup->id]);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $fieldGroup->fields);
        $this->assertEquals(2, $fieldGroup->fields->count());
        $this->assertTrue($fieldGroup->fields->contains($field1));
        $this->assertTrue($fieldGroup->fields->contains($field2));
    }

    /** @test */
    public function it_belongs_to_created_by_admin()
    {
        $admin = Admin::factory()->create();
        $fieldGroup = FieldGroup::factory()->create([
            'created_by' => $admin->id,
        ]);

        $this->assertInstanceOf(Admin::class, $fieldGroup->createdBy);
        $this->assertEquals($admin->id, $fieldGroup->createdBy->id);
    }

    /** @test */
    public function it_belongs_to_updated_by_admin()
    {
        $admin = Admin::factory()->create();
        $fieldGroup = FieldGroup::factory()->create([
            'updated_by' => $admin->id,
        ]);

        $this->assertInstanceOf(Admin::class, $fieldGroup->updatedBy);
        $this->assertEquals($admin->id, $fieldGroup->updatedBy->id);
    }

    /** @test */
    public function get_rules_returns_array()
    {
        $rules = ['required' => true, 'validation' => 'string'];
        $fieldGroup = FieldGroup::factory()->create([
            'rules' => json_encode($rules),
        ]);

        $result = $fieldGroup->getRulesAttribute();
        $this->assertIsArray($result);
        $this->assertTrue($result['required']);
        $this->assertEquals('string', $result['validation']);
    }

    /** @test */
    public function set_rules_encodes_to_json()
    {
        $fieldGroup = FieldGroup::factory()->create();
        $rules = ['required' => true, 'validation' => 'string'];

        $fieldGroup->setRulesAttribute($rules);

        $this->assertEquals(json_encode($rules), $fieldGroup->attributes['rules']);
    }

    /** @test */
    public function get_fields_returns_collection()
    {
        $fieldGroup = FieldGroup::factory()->create();
        $field1 = Field::factory()->create(['group_id' => $fieldGroup->id]);
        $field2 = Field::factory()->create(['group_id' => $fieldGroup->id]);

        $fields = $fieldGroup->getFields();
        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $fields);
        $this->assertEquals(2, $fields->count());
        $this->assertTrue($fields->contains($field1));
        $this->assertTrue($fields->contains($field2));
    }

    /** @test */
    public function is_global_returns_correct_value()
    {
        $globalFieldGroup = FieldGroup::factory()->create(['is_global' => true]);
        $localFieldGroup = FieldGroup::factory()->create(['is_global' => false]);

        $this->assertTrue($globalFieldGroup->isGlobal());
        $this->assertFalse($localFieldGroup->isGlobal());
    }

    /** @test */
    public function is_active_returns_correct_value()
    {
        $activeFieldGroup = FieldGroup::factory()->create(['is_active' => true]);
        $inactiveFieldGroup = FieldGroup::factory()->create(['is_active' => false]);

        $this->assertTrue($activeFieldGroup->isActive());
        $this->assertFalse($inactiveFieldGroup->isActive());
    }

    /** @test */
    public function it_handles_soft_deletes()
    {
        $fieldGroup = FieldGroup::factory()->create();
        $fieldGroupId = $fieldGroup->id;

        $fieldGroup->delete();

        $this->assertSoftDeleted($fieldGroup);
        $this->assertNotNull(FieldGroup::withTrashed()->find($fieldGroupId));
    }

    /** @test */
    public function it_casts_is_global_to_boolean()
    {
        $fieldGroup = FieldGroup::factory()->create(['is_global' => true]);
        $this->assertIsBool($fieldGroup->is_global);
        $this->assertTrue($fieldGroup->is_global);
    }

    /** @test */
    public function it_casts_rules_to_array()
    {
        $rules = ['key' => 'value', 'number' => 42];
        $fieldGroup = FieldGroup::factory()->create([
            'rules' => $rules,
        ]);

        $this->assertIsArray($fieldGroup->rules);
        $this->assertEquals('value', $fieldGroup->rules['key']);
        $this->assertEquals(42, $fieldGroup->rules['number']);
    }

    /** @test */
    public function it_casts_is_active_to_boolean()
    {
        $fieldGroup = FieldGroup::factory()->create(['is_active' => true]);
        $this->assertIsBool($fieldGroup->is_active);
        $this->assertTrue($fieldGroup->is_active);
    }

    /** @test */
    public function it_handles_empty_rules()
    {
        $fieldGroup = FieldGroup::factory()->create([
            'rules' => json_encode([]),
        ]);

        $rules = $fieldGroup->getRulesAttribute();
        $this->assertIsArray($rules);
        $this->assertEmpty($rules);
    }

    /** @test */
    public function it_handles_null_rules()
    {
        $fieldGroup = FieldGroup::factory()->create([
            'rules' => null,
        ]);

        $rules = $fieldGroup->getRulesAttribute();
        $this->assertNull($rules);
    }

    /** @test */
    public function it_handles_complex_rules()
    {
        $rules = [
            'validation' => [
                'required' => true,
                'min_length' => 3,
                'max_length' => 255,
            ],
            'display' => [
                'show_in_list' => true,
                'show_in_form' => true,
            ],
            'behavior' => [
                'translatable' => false,
                'searchable' => true,
            ],
        ];

        $fieldGroup = FieldGroup::factory()->create([
            'rules' => json_encode($rules),
        ]);

        $result = $fieldGroup->getRulesAttribute();
        $this->assertIsArray($result);
        $this->assertTrue($result['validation']['required']);
        $this->assertEquals(3, $result['validation']['min_length']);
        $this->assertTrue($result['display']['show_in_list']);
        $this->assertFalse($result['behavior']['translatable']);
    }

    /** @test */
    public function it_handles_uuid()
    {
        $fieldGroup = FieldGroup::factory()->create();

        $this->assertNotNull($fieldGroup->uuid);
        $this->assertIsString($fieldGroup->uuid);
    }

    /** @test */
    public function get_fields_can_handle_empty_collection()
    {
        $fieldGroup = FieldGroup::factory()->create();

        $fields = $fieldGroup->getFields();
        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $fields);
        $this->assertEquals(0, $fields->count());
    }

    /** @test */
    public function it_can_be_created_with_minimal_data()
    {
        $fieldGroup = FieldGroup::factory()->create([
            'name' => 'Minimal Field Group',
        ]);

        $this->assertInstanceOf(FieldGroup::class, $fieldGroup);
        $this->assertEquals('Minimal Field Group', $fieldGroup->name);
        $this->assertFalse($fieldGroup->isGlobal());
        $this->assertTrue($fieldGroup->isActive());
    }
}