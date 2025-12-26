<?php

namespace Tests\Unit\Repositories;

use App\Models\Field;
use App\Models\FieldGroup;
use App\Repositories\FieldRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FieldRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected FieldRepository $repository;
    protected FieldGroup $fieldGroup;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new FieldRepository();
        $this->fieldGroup = FieldGroup::factory()->create();
    }

    public function testCreateReturnsField(): void
    {
        $data = [
            'group_id' => $this->fieldGroup->id,
            'uuid' => 'field-uuid',
            'slug' => 'test-field',
            'name' => 'Test Field',
            'description' => 'Test description',
            'instructions' => 'Test instructions',
            'type' => 'text',
            'settings' => ['max_length' => 255],
            'required' => false,
            'validation_rules' => ['max:255'],
            'list_visibility' => true,
            'translatable' => false,
            'searchable' => true,
            'is_active' => true,
        ];

        $field = $this->repository->create($data);

        $this->assertInstanceOf(Field::class, $field);
        $this->assertEquals('field-uuid', $field->uuid);
        $this->assertEquals('Test Field', $field->name);
        $this->assertEquals('text', $field->type);
    }

    public function testUpdateReturnsUpdatedField(): void
    {
        $field = Field::factory()->create([
            'name' => 'Original Name',
        ]);

        $updated = $this->repository->update($field->id, [
            'name' => 'Updated Name',
        ]);

        $this->assertInstanceOf(Field::class, $updated);
        $this->assertEquals('Updated Name', $updated->name);
    }

    public function testDeleteReturnsTrue(): void
    {
        $field = Field::factory()->create();

        $result = $this->repository->delete($field->id);

        $this->assertTrue($result);
        $this->assertSoftDeleted($field);
    }

    public function testRestoreReturnsRestoredField(): void
    {
        $field = Field::factory()->create();
        $field->delete();

        $restored = $this->repository->restore($field->id);

        $this->assertInstanceOf(Field::class, $restored);
        $this->assertNull($restored->deleted_at);
    }

    public function testGetByIdReturnsField(): void
    {
        $created = Field::factory()->create([
            'uuid' => 'test-uuid-123',
        ]);

        $found = $this->repository->getById($created->id);

        $this->assertInstanceOf(Field::class, $found);
        $this->assertEquals('test-uuid-123', $found->uuid);
    }

    public function testGetByIdReturnsNullForNonexistent(): void
    {
        $result = $this->repository->getById(999999);

        $this->assertNull($result);
    }

    public function testGetByUuidReturnsField(): void
    {
        Field::factory()->create([
            'uuid' => 'my-field-uuid',
        ]);

        $found = $this->repository->getByUuid('my-field-uuid');

        $this->assertInstanceOf(Field::class, $found);
        $this->assertEquals('my-field-uuid', $found->uuid);
    }

    public function testGetBySlugReturnsField(): void
    {
        Field::factory()->create([
            'slug' => 'my-field-slug',
        ]);

        $found = $this->repository->getBySlug('my-field-slug');

        $this->assertInstanceOf(Field::class, $found);
        $this->assertEquals('my-field-slug', $found->slug);
    }

    public function testGetAllReturnsArray(): void
    {
        Field::factory()->count(3)->create();

        $all = $this->repository->getAll();

        $this->assertIsArray($all);
        $this->assertCount(3, $all);
    }

    public function testGetAllWithFilters(): void
    {
        Field::factory()->create(['is_active' => true]);
        Field::factory()->create(['is_active' => false]);

        $active = $this->repository->getAll(['is_active' => true]);

        $this->assertIsArray($active);
        $this->assertCount(1, $active);
    }

    public function testPaginateReturnsLengthAwarePaginator(): void
    {
        Field::factory()->count(20)->create();

        $paginator = $this->repository->paginate(10);

        $this->assertInstanceOf(\Illuminate\Contracts\Pagination\LengthAwarePaginator::class, $paginator);
        $this->assertEquals(20, $paginator->total());
        $this->assertCount(10, $paginator->items());
    }

    public function testWhereReturnsFilteredArray(): void
    {
        Field::factory()->create(['type' => 'text']);
        Field::factory()->create(['type' => 'number']);

        $textFields = $this->repository->where(['type' => 'text']);

        $this->assertIsArray($textFields);
        $this->assertCount(1, $textFields);
    }

    public function testWithReturnsRelations(): void
    {
        $field = Field::factory()->create();

        $result = $this->repository->with(['group', 'createdBy']);

        $this->assertIsArray($result);
    }

    public function testGetGroupReturnsFieldGroup(): void
    {
        $field = Field::factory()->create([
            'group_id' => $this->fieldGroup->id,
        ]);

        $group = $this->repository->getGroup($field);

        $this->assertInstanceOf(FieldGroup::class, $group);
        $this->assertEquals($this->fieldGroup->id, $group->id);
    }

    public function testSetGroupReturnsTrue(): void
    {
        $field = Field::factory()->create();
        $newGroup = FieldGroup::factory()->create();

        $result = $this->repository->setGroup($field, $newGroup->id);

        $this->assertTrue($result);
        $this->assertEquals($newGroup->id, $field->fresh()->group_id);
    }

    public function testGetSettingsReturnsArray(): void
    {
        $field = Field::factory()->create([
            'settings' => json_encode(['max_length' => 100]),
        ]);

        $settings = $this->repository->getSettings($field);

        $this->assertIsArray($settings);
        $this->assertEquals(100, $settings['max_length']);
    }

    public function testUpdateSettingsReturnsTrue(): void
    {
        $field = Field::factory()->create([
            'settings' => json_encode(['max_length' => 50]),
        ]);

        $result = $this->repository->updateSettings($field, ['max_length' => 200]);

        $this->assertTrue($result);
        $this->assertEquals(200, $field->fresh()->settings['max_length']);
    }

    public function testGetValidationRulesReturnsArray(): void
    {
        $field = Field::factory()->create([
            'validation_rules' => json_encode(['required', 'max:255']),
        ]);

        $rules = $this->repository->getValidationRules($field);

        $this->assertIsArray($rules);
    }

    public function testUpdateValidationRulesReturnsTrue(): void
    {
        $field = Field::factory()->create([
            'validation_rules' => json_encode(['required']),
        ]);

        $result = $this->repository->updateValidationRules($field, ['required', 'min:3']);

        $this->assertTrue($result);
    }

    public function testGetTypeReturnsString(): void
    {
        $field = Field::factory()->create([
            'type' => 'text',
        ]);

        $type = $this->repository->getType($field);

        $this->assertEquals('text', $type);
    }

    public function testIsRequiredReturnsCorrectValue(): void
    {
        $required = Field::factory()->create(['required' => true]);
        $optional = Field::factory()->create(['required' => false]);

        $this->assertTrue($this->repository->isRequired($required));
        $this->assertFalse($this->repository->isRequired($optional));
    }

    public function testIsTranslatableReturnsCorrectValue(): void
    {
        $translatable = Field::factory()->create(['translatable' => true]);
        $notTranslatable = Field::factory()->create(['translatable' => false]);

        $this->assertTrue($this->repository->isTranslatable($translatable));
        $this->assertFalse($this->repository->isTranslatable($notTranslatable));
    }

    public function testIsSearchableReturnsCorrectValue(): void
    {
        $searchable = Field::factory()->create(['searchable' => true]);
        $notSearchable = Field::factory()->create(['searchable' => false]);

        $this->assertTrue($this->repository->isSearchable($searchable));
        $this->assertFalse($this->repository->isSearchable($notSearchable));
    }

    public function testGetListVisibilityReturnsValue(): void
    {
        $field = Field::factory()->create([
            'list_visibility' => true,
        ]);

        $visibility = $this->repository->getListVisibility($field);

        $this->assertTrue($visibility);
    }

    public function testIsActiveReturnsCorrectValue(): void
    {
        $active = Field::factory()->create(['is_active' => true]);
        $inactive = Field::factory()->create(['is_active' => false]);

        $this->assertTrue($this->repository->isActive($active));
        $this->assertFalse($this->repository->isActive($inactive));
    }

    public function testGetDatabaseValueType(): void
    {
        $field = Field::factory()->create([
            'type' => 'text',
        ]);

        $type = $this->repository->getDatabaseValueType($field);

        $this->assertEquals('string', $type);
    }

    public function testGetAdminUIConfig(): void
    {
        $field = Field::factory()->create([
            'type' => 'text',
        ]);

        $config = $this->repository->getAdminUIConfig($field);

        $this->assertIsArray($config);
    }

    public function testGetPublicUIConfig(): void
    {
        $field = Field::factory()->create([
            'type' => 'text',
        ]);

        $config = $this->repository->getPublicUIConfig($field);

        $this->assertIsArray($config);
    }
}