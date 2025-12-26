<?php

namespace Tests\Unit\Repositories;

use App\Models\Field;
use App\Models\FieldGroup;
use App\Repositories\FieldGroupRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FieldGroupRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected FieldGroupRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new FieldGroupRepository();
    }

    public function testCreateReturnsFieldGroup(): void
    {
        $data = [
            'uuid' => 'group-uuid',
            'name' => 'Test Group',
            'description' => 'Test description',
            'is_global' => false,
            'rules' => ['required_if'],
            'is_active' => true,
        ];

        $group = $this->repository->create($data);

        $this->assertInstanceOf(FieldGroup::class, $group);
        $this->assertEquals('group-uuid', $group->uuid);
        $this->assertEquals('Test Group', $group->name);
    }

    public function testUpdateReturnsUpdatedFieldGroup(): void
    {
        $group = FieldGroup::factory()->create([
            'name' => 'Original Name',
        ]);

        $updated = $this->repository->update($group->id, [
            'name' => 'Updated Name',
        ]);

        $this->assertInstanceOf(FieldGroup::class, $updated);
        $this->assertEquals('Updated Name', $updated->name);
    }

    public function testDeleteReturnsTrue(): void
    {
        $group = FieldGroup::factory()->create();

        $result = $this->repository->delete($group->id);

        $this->assertTrue($result);
        $this->assertSoftDeleted($group);
    }

    public function testRestoreReturnsRestoredFieldGroup(): void
    {
        $group = FieldGroup::factory()->create();
        $group->delete();

        $restored = $this->repository->restore($group->id);

        $this->assertInstanceOf(FieldGroup::class, $restored);
        $this->assertNull($restored->deleted_at);
    }

    public function testGetByIdReturnsFieldGroup(): void
    {
        $created = FieldGroup::factory()->create([
            'uuid' => 'test-uuid-123',
        ]);

        $found = $this->repository->getById($created->id);

        $this->assertInstanceOf(FieldGroup::class, $found);
        $this->assertEquals('test-uuid-123', $found->uuid);
    }

    public function testGetByIdReturnsNullForNonexistent(): void
    {
        $result = $this->repository->getById(999999);

        $this->assertNull($result);
    }

    public function testGetByUuidReturnsFieldGroup(): void
    {
        FieldGroup::factory()->create([
            'uuid' => 'my-group-uuid',
        ]);

        $found = $this->repository->getByUuid('my-group-uuid');

        $this->assertInstanceOf(FieldGroup::class, $found);
        $this->assertEquals('my-group-uuid', $found->uuid);
    }

    public function testGetAllReturnsArray(): void
    {
        FieldGroup::factory()->count(3)->create();

        $all = $this->repository->getAll();

        $this->assertIsArray($all);
        $this->assertCount(3, $all);
    }

    public function testGetAllWithFilters(): void
    {
        FieldGroup::factory()->create(['is_active' => true]);
        FieldGroup::factory()->create(['is_active' => false]);

        $active = $this->repository->getAll(['is_active' => true]);

        $this->assertIsArray($active);
        $this->assertCount(1, $active);
    }

    public function testPaginateReturnsLengthAwarePaginator(): void
    {
        FieldGroup::factory()->count(20)->create();

        $paginator = $this->repository->paginate(10);

        $this->assertInstanceOf(\Illuminate\Contracts\Pagination\LengthAwarePaginator::class, $paginator);
        $this->assertEquals(20, $paginator->total());
        $this->assertCount(10, $paginator->items());
    }

    public function testWhereReturnsFilteredArray(): void
    {
        FieldGroup::factory()->create(['is_global' => true]);
        FieldGroup::factory()->create(['is_global' => false]);

        $global = $this->repository->where(['is_global' => true]);

        $this->assertIsArray($global);
        $this->assertCount(1, $global);
    }

    public function testWithReturnsRelations(): void
    {
        $group = FieldGroup::factory()->create();

        $result = $this->repository->with(['fields', 'createdBy']);

        $this->assertIsArray($result);
    }

    public function testGetFieldsReturnsArray(): void
    {
        $group = FieldGroup::factory()->create();
        Field::factory()->count(3)->create([
            'group_id' => $group->id,
        ]);

        $fields = $this->repository->getFields($group->id);

        $this->assertIsArray($fields);
        $this->assertCount(3, $fields);
    }

    public function testAddFieldReturnsTrue(): void
    {
        $group = FieldGroup::factory()->create();
        $field = Field::factory()->create([
            'group_id' => null,
        ]);

        $result = $this->repository->addField($group, $field->id);

        $this->assertTrue($result);
        $this->assertEquals($group->id, $field->fresh()->group_id);
    }

    public function testRemoveFieldReturnsTrue(): void
    {
        $group = FieldGroup::factory()->create();
        $field = Field::factory()->create([
            'group_id' => $group->id,
        ]);

        $result = $this->repository->removeField($group->id, $field->id);

        $this->assertTrue($result);
        $this->assertNull($field->fresh()->group_id);
    }

    public function testGetRulesReturnsArray(): void
    {
        $group = FieldGroup::factory()->create([
            'rules' => json_encode(['required', 'max:100']),
        ]);

        $rules = $this->repository->getRules($group);

        $this->assertIsArray($rules);
    }

    public function testAddRuleReturnsTrue(): void
    {
        $group = FieldGroup::factory()->create([
            'rules' => json_encode([]),
        ]);

        $result = $this->repository->addRule($group, ['min:3']);

        $this->assertTrue($result);
    }

    public function testUpdateRuleReturnsTrue(): void
    {
        $group = FieldGroup::factory()->create([
            'rules' => json_encode([['id' => 1, 'rule' => 'required']]),
        ]);

        $result = $this->repository->updateRule($group, 1, ['rule' => 'nullable']);

        $this->assertTrue($result);
    }

    public function testRemoveRuleReturnsTrue(): void
    {
        $group = FieldGroup::factory()->create([
            'rules' => json_encode([['id' => 1, 'rule' => 'required']]),
        ]);

        $result = $this->repository->removeRule($group, 1);

        $this->assertTrue($result);
    }

    public function testGetFlagsReturnsArray(): void
    {
        $group = FieldGroup::factory()->create([
            'flags' => json_encode(['visible', 'editable']),
        ]);

        $flags = $this->repository->getFlags($group);

        $this->assertIsArray($flags);
    }

    public function testAddFlagReturnsTrue(): void
    {
        $group = FieldGroup::factory()->create([
            'flags' => json_encode([]),
        ]);

        $result = $this->repository->addFlag($group, 'new-flag');

        $this->assertTrue($result);
    }

    public function testRemoveFlagReturnsTrue(): void
    {
        $group = FieldGroup::factory()->create([
            'flags' => json_encode(['existing-flag']),
        ]);

        $result = $this->repository->removeFlag($group, 'existing-flag');

        $this->assertTrue($result);
    }

    public function testIsGlobalReturnsCorrectValue(): void
    {
        $global = FieldGroup::factory()->create(['is_global' => true]);
        $local = FieldGroup::factory()->create(['is_global' => false]);

        $this->assertTrue($this->repository->isGlobal($global));
        $this->assertFalse($this->repository->isGlobal($local));
    }

    public function testIsActiveReturnsCorrectValue(): void
    {
        $active = FieldGroup::factory()->create(['is_active' => true]);
        $inactive = FieldGroup::factory()->create(['is_active' => false]);

        $this->assertTrue($this->repository->isActive($active));
        $this->assertFalse($this->repository->isActive($inactive));
    }
}