<?php

namespace Tests\Unit;

use App\Models\Field;
use App\Models\FieldGroup;
use App\Services\FieldGroupService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FieldGroupServiceTest extends TestCase
{
    use RefreshDatabase;

    protected FieldGroupService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new FieldGroupService();
    }

    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(FieldGroupService::class, $this->service);
    }

    /** @test */
    public function create_returns_field_group()
    {
        $data = [
            'name' => 'Test Group',
            'slug' => 'test-group',
            'description' => 'Test description',
        ];

        $result = $this->service->create($data);

        $this->assertInstanceOf(FieldGroup::class, $result);
        $this->assertEquals('Test Group', $result->name);
    }

    /** @test */
    public function create_generates_slug_if_not_provided()
    {
        $data = [
            'name' => 'My Test Group',
        ];

        $result = $this->service->create($data);

        $this->assertInstanceOf(FieldGroup::class, $result);
        $this->assertEquals('my-test-group', $result->slug);
    }

    /** @test */
    public function update_returns_updated_field_group()
    {
        $group = FieldGroup::factory()->create([
            'name' => 'Original Name',
        ]);

        $result = $this->service->update($group, ['name' => 'Updated Name']);

        $this->assertInstanceOf(FieldGroup::class, $result);
        $this->assertEquals('Updated Name', $result->name);
    }

    /** @test */
    public function delete_returns_true_on_success()
    {
        $group = FieldGroup::factory()->create();

        $result = $this->service->delete($group);

        $this->assertTrue($result);
    }

    /** @test */
    public function delete_performs_soft_delete()
    {
        $group = FieldGroup::factory()->create();
        $id = $group->id;

        $this->service->delete($group);

        $this->assertSoftDeleted($group);
        $this->assertNotNull(FieldGroup::withTrashed()->find($id));
    }

    /** @test */
    public function restore_returns_restored_field_group()
    {
        $group = FieldGroup::factory()->create();
        $group->delete();

        $result = $this->service->restore($group);

        $this->assertInstanceOf(FieldGroup::class, $result);
        $this->assertNotNull($result->fresh());
    }

    /** @test */
    public function duplicate_returns_new_field_group()
    {
        $group = FieldGroup::factory()->create([
            'name' => 'Original Group',
            'slug' => 'original-group',
        ]);

        $duplicate = $this->service->duplicate($group);

        $this->assertInstanceOf(FieldGroup::class, $duplicate);
        $this->assertNotEquals($group->id, $duplicate->id);
        $this->assertStringContainsString('Original Group', $duplicate->name);
    }

    /** @test */
    public function duplicate_copies_all_attributes()
    {
        $group = FieldGroup::factory()->create([
            'name' => 'Test Group',
            'description' => 'Test description',
            'is_global' => true,
            'is_active' => true,
        ]);

        $duplicate = $this->service->duplicate($group);

        $this->assertEquals($group->description, $duplicate->description);
        $this->assertEquals($group->is_global, $duplicate->is_global);
        $this->assertEquals($group->is_active, $duplicate->is_active);
    }

    /** @test */
    public function get_all_returns_field_groups()
    {
        FieldGroup::factory()->count(3)->create();

        $result = $this->service->getAll();

        $this->assertIsArray($result);
        $this->assertCount(3, $result);
    }

    /** @test */
    public function get_all_respects_filters()
    {
        FieldGroup::factory()->count(2)->create(['is_active' => true]);
        FieldGroup::factory()->count(1)->create(['is_active' => false]);

        $result = $this->service->getAll(['is_active' => true]);

        $this->assertIsArray($result);
    }

    /** @test */
    public function get_by_id_returns_field_group()
    {
        $group = FieldGroup::factory()->create();

        $result = $this->service->getById($group->id);

        $this->assertInstanceOf(FieldGroup::class, $result);
        $this->assertEquals($group->id, $result->id);
    }

    /** @test */
    public function get_by_slug_returns_field_group()
    {
        $group = FieldGroup::factory()->create([
            'slug' => 'test-group-slug',
        ]);

        $result = $this->service->getBySlug('test-group-slug');

        $this->assertInstanceOf(FieldGroup::class, $result);
        $this->assertEquals('test-group-slug', $result->slug);
    }

    /** @test */
    public function get_fields_returns_fields()
    {
        $group = FieldGroup::factory()->create();
        Field::factory()->count(2)->create(['group_id' => $group->id]);

        $result = $this->service->getFields($group);

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertContainsOnlyInstancesOf(Field::class, $result);
    }

    /** @test */
    public function add_field_adds_field_to_group()
    {
        $group = FieldGroup::factory()->create();

        $result = $this->service->addField($group, [
            'name' => 'New Field',
            'slug' => 'new-field',
            'type' => 'text',
        ]);

        $this->assertInstanceOf(Field::class, $result);
        $this->assertEquals($group->id, $result->group_id);
    }

    /** @test */
    public function remove_field_removes_field_from_group()
    {
        $group = FieldGroup::factory()->create();
        $field = Field::factory()->create(['group_id' => $group->id]);

        $result = $this->service->removeField($field);

        $this->assertTrue($result);
        $this->assertNull($field->fresh()->group_id);
    }

    /** @test */
    public function is_global_returns_true_for_global_group()
    {
        $group = FieldGroup::factory()->create(['is_global' => true]);

        $result = $this->service->isGlobal($group);

        $this->assertTrue($result);
    }

    /** @test */
    public function is_global_returns_false_for_local_group()
    {
        $group = FieldGroup::factory()->create(['is_global' => false]);

        $result = $this->service->isGlobal($group);

        $this->assertFalse($result);
    }

    /** @test */
    public function is_active_returns_true_for_active_group()
    {
        $group = FieldGroup::factory()->create(['is_active' => true]);

        $result = $this->service->isActive($group);

        $this->assertTrue($result);
    }

    /** @test */
    public function is_active_returns_false_for_inactive_group()
    {
        $group = FieldGroup::factory()->create(['is_active' => false]);

        $result = $this->service->isActive($group);

        $this->assertFalse($result);
    }

    /** @test */
    public function get_field_count_returns_integer()
    {
        $group = FieldGroup::factory()->create();
        Field::factory()->count(3)->create(['group_id' => $group->id]);

        $result = $this->service->getFieldCount($group);

        $this->assertIsInt($result);
        $this->assertEquals(3, $result);
    }
}