<?php

namespace Tests\Unit;

use App\Models\Field;
use App\Models\FieldGroup;
use App\Services\FieldService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FieldServiceTest extends TestCase
{
    use RefreshDatabase;

    protected FieldService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new FieldService();
    }

    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(FieldService::class, $this->service);
    }

    /** @test */
    public function create_returns_field()
    {
        $group = FieldGroup::factory()->create();
        $data = [
            'name' => 'Test Field',
            'slug' => 'test-field',
            'type' => 'text',
            'group_id' => $group->id,
        ];

        $result = $this->service->create($data);

        $this->assertInstanceOf(Field::class, $result);
        $this->assertEquals('Test Field', $result->name);
        $this->assertEquals('text', $result->type);
    }

    /** @test */
    public function update_returns_updated_field()
    {
        $field = Field::factory()->create([
            'name' => 'Original Name',
        ]);

        $result = $this->service->update($field, ['name' => 'Updated Name']);

        $this->assertInstanceOf(Field::class, $result);
        $this->assertEquals('Updated Name', $result->name);
    }

    /** @test */
    public function delete_returns_true_on_success()
    {
        $field = Field::factory()->create();

        $result = $this->service->delete($field);

        $this->assertTrue($result);
    }

    /** @test */
    public function delete_performs_soft_delete()
    {
        $field = Field::factory()->create();
        $id = $field->id;

        $this->service->delete($field);

        $this->assertSoftDeleted($field);
        $this->assertNotNull(Field::withTrashed()->find($id));
    }

    /** @test */
    public function restore_returns_restored_field()
    {
        $field = Field::factory()->create();
        $field->delete();

        $result = $this->service->restore($field);

        $this->assertInstanceOf(Field::class, $result);
        $this->assertNotNull($result->fresh());
    }

    /** @test */
    public function duplicate_returns_new_field()
    {
        $field = Field::factory()->create([
            'name' => 'Original Field',
            'slug' => 'original-field',
        ]);

        $duplicate = $this->service->duplicate($field);

        $this->assertInstanceOf(Field::class, $duplicate);
        $this->assertNotEquals($field->id, $duplicate->id);
        $this->assertStringContainsString('Original Field', $duplicate->name);
    }

    /** @test */
    public function duplicate_copies_all_attributes()
    {
        $field = Field::factory()->create([
            'name' => 'Test Field',
            'type' => 'text',
            'description' => 'Test description',
            'required' => true,
            'translatable' => true,
        ]);

        $duplicate = $this->service->duplicate($field);

        $this->assertEquals($field->type, $duplicate->type);
        $this->assertEquals($field->description, $duplicate->description);
        $this->assertEquals($field->required, $duplicate->required);
        $this->assertEquals($field->translatable, $duplicate->translatable);
    }

    /** @test */
    public function get_all_returns_fields()
    {
        Field::factory()->count(3)->create();

        $result = $this->service->getAll();

        $this->assertIsArray($result);
        $this->assertCount(3, $result);
    }

    /** @test */
    public function get_all_respects_filters()
    {
        Field::factory()->count(2)->create(['is_active' => true]);
        Field::factory()->count(1)->create(['is_active' => false]);

        $result = $this->service->getAll(['is_active' => true]);

        $this->assertIsArray($result);
    }

    /** @test */
    public function get_by_id_returns_field()
    {
        $field = Field::factory()->create();

        $result = $this->service->getById($field->id);

        $this->assertInstanceOf(Field::class, $result);
        $this->assertEquals($field->id, $result->id);
    }

    /** @test */
    public function get_by_slug_returns_field()
    {
        $field = Field::factory()->create([
            'slug' => 'test-field-slug',
        ]);

        $result = $this->service->getBySlug('test-field-slug');

        $this->assertInstanceOf(Field::class, $result);
        $this->assertEquals('test-field-slug', $result->slug);
    }

    /** @test */
    public function get_by_type_returns_fields()
    {
        Field::factory()->create(['type' => 'text']);
        Field::factory()->create(['type' => 'number']);

        $result = $this->service->getByType('text');

        $this->assertIsArray($result);
        $this->assertContainsOnlyInstancesOf(Field::class, $result);
    }

    /** @test */
    public function get_by_group_returns_fields()
    {
        $group = FieldGroup::factory()->create();
        Field::factory()->count(2)->create(['group_id' => $group->id]);

        $result = $this->service->getByGroup($group);

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
    }

    /** @test */
    public function get_group_returns_field_group()
    {
        $group = FieldGroup::factory()->create();
        $field = Field::factory()->create(['group_id' => $group->id]);

        $result = $this->service->getGroup($field);

        $this->assertInstanceOf(FieldGroup::class, $result);
        $this->assertEquals($group->id, $result->id);
    }

    /** @test */
    public function is_required_returns_true_for_required_field()
    {
        $field = Field::factory()->create(['required' => true]);

        $result = $this->service->isRequired($field);

        $this->assertTrue($result);
    }

    /** @test */
    public function is_required_returns_false_for_optional_field()
    {
        $field = Field::factory()->create(['required' => false]);

        $result = $this->service->isRequired($field);

        $this->assertFalse($result);
    }

    /** @test */
    public function is_translatable_returns_true_for_translatable_field()
    {
        $field = Field::factory()->create([
            'type' => 'text',
            'translatable' => true,
        ]);

        $result = $this->service->isTranslatable($field);

        $this->assertTrue($result);
    }

    /** @test */
    public function is_searchable_returns_true_for_searchable_field()
    {
        $field = Field::factory()->create([
            'type' => 'text',
            'searchable' => true,
        ]);

        $result = $this->service->isSearchable($field);

        $this->assertTrue($result);
    }

    /** @test */
    public function is_active_returns_true_for_active_field()
    {
        $field = Field::factory()->create(['is_active' => true]);

        $result = $this->service->isActive($field);

        $this->assertTrue($result);
    }

    /** @test */
    public function is_active_returns_false_for_inactive_field()
    {
        $field = Field::factory()->create(['is_active' => false]);

        $result = $this->service->isActive($field);

        $this->assertFalse($result);
    }
}