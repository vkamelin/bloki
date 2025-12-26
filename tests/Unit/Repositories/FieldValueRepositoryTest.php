<?php

namespace Tests\Unit\Repositories;

use App\Models\Entry;
use App\Models\Field;
use App\Models\FieldValue;
use App\Repositories\FieldValueRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FieldValueRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected FieldValueRepository $repository;
    protected Field $field;
    protected Entry $entry;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new FieldValueRepository();
        $this->field = Field::factory()->create();
        $this->entry = Entry::factory()->create();
    }

    public function testCreateReturnsFieldValue(): void
    {
        $data = [
            'field_id' => $this->field->id,
            'entity_type' => 'entry',
            'entity_id' => $this->entry->id,
            'value_type' => 'string',
            'value_string' => 'Test value',
            'locale' => 'en',
            'is_active' => true,
        ];

        $value = $this->repository->create($data);

        $this->assertInstanceOf(FieldValue::class, $value);
        $this->assertEquals('Test value', $value->value_string);
    }

    public function testUpdateReturnsUpdatedFieldValue(): void
    {
        $value = FieldValue::factory()->create([
            'value_string' => 'Original value',
        ]);

        $updated = $this->repository->update($value->id, [
            'value_string' => 'Updated value',
        ]);

        $this->assertInstanceOf(FieldValue::class, $updated);
        $this->assertEquals('Updated value', $updated->value_string);
    }

    public function testDeleteReturnsTrue(): void
    {
        $value = FieldValue::factory()->create();

        $result = $this->repository->delete($value->id);

        $this->assertTrue($result);
        $this->assertSoftDeleted($value);
    }

    public function testRestoreReturnsRestoredFieldValue(): void
    {
        $value = FieldValue::factory()->create();
        $value->delete();

        $restored = $this->repository->restore($value->id);

        $this->assertInstanceOf(FieldValue::class, $restored);
        $this->assertNull($restored->deleted_at);
    }

    public function testGetByIdReturnsFieldValue(): void
    {
        $created = FieldValue::factory()->create([
            'value_string' => 'test-value',
        ]);

        $found = $this->repository->getById($created->id);

        $this->assertInstanceOf(FieldValue::class, $found);
        $this->assertEquals('test-value', $found->value_string);
    }

    public function testGetByIdReturnsNullForNonexistent(): void
    {
        $result = $this->repository->getById(999999);

        $this->assertNull($result);
    }

    public function testGetAllReturnsArray(): void
    {
        FieldValue::factory()->count(3)->create();

        $all = $this->repository->getAll();

        $this->assertIsArray($all);
        $this->assertCount(3, $all);
    }

    public function testGetAllWithFilters(): void
    {
        FieldValue::factory()->create(['is_active' => true]);
        FieldValue::factory()->create(['is_active' => false]);

        $active = $this->repository->getAll(['is_active' => true]);

        $this->assertIsArray($active);
        $this->assertCount(1, $active);
    }

    public function testPaginateReturnsLengthAwarePaginator(): void
    {
        FieldValue::factory()->count(20)->create();

        $paginator = $this->repository->paginate(10);

        $this->assertInstanceOf(\Illuminate\Contracts\Pagination\LengthAwarePaginator::class, $paginator);
        $this->assertEquals(20, $paginator->total());
        $this->assertCount(10, $paginator->items());
    }

    public function testWhereReturnsFilteredArray(): void
    {
        FieldValue::factory()->create(['value_type' => 'string']);
        FieldValue::factory()->create(['value_type' => 'integer']);

        $stringValues = $this->repository->where(['value_type' => 'string']);

        $this->assertIsArray($stringValues);
        $this->assertCount(1, $stringValues);
    }

    public function testWithReturnsRelations(): void
    {
        $value = FieldValue::factory()->create();

        $result = $this->repository->with(['field']);

        $this->assertIsArray($result);
    }

    public function testGetByFieldReturnsArray(): void
    {
        FieldValue::factory()->count(3)->create([
            'field_id' => $this->field->id,
        ]);

        $values = $this->repository->getByField($this->field);

        $this->assertIsArray($values);
        $this->assertCount(3, $values);
    }

    public function testGetByEntityReturnsArray(): void
    {
        FieldValue::factory()->count(3)->create([
            'entity_type' => 'entry',
            'entity_id' => $this->entry->id,
        ]);

        $values = $this->repository->getByEntity($this->entry);

        $this->assertIsArray($values);
        $this->assertCount(3, $values);
    }

    public function testGetByFieldAndEntityReturnsFieldValue(): void
    {
        $value = FieldValue::factory()->create([
            'field_id' => $this->field->id,
            'entity_type' => 'entry',
            'entity_id' => $this->entry->id,
        ]);

        $found = $this->repository->getByFieldAndEntity($this->field, $this->entry);

        $this->assertInstanceOf(FieldValue::class, $found);
        $this->assertEquals($this->field->id, $found->field_id);
    }

    public function testGetValueReturnsCorrectType(): void
    {
        $stringValue = FieldValue::factory()->create([
            'value_type' => 'string',
            'value_string' => 'test',
        ]);

        $intValue = FieldValue::factory()->create([
            'value_type' => 'integer',
            'value_int' => 42,
        ]);

        $stringResult = $this->repository->getValue($stringValue);
        $intResult = $this->repository->getValue($intValue);

        $this->assertEquals('test', $stringResult);
        $this->assertEquals(42, $intResult);
    }

    public function testSetValueReturnsTrue(): void
    {
        $value = FieldValue::factory()->create([
            'value_type' => 'string',
            'value_string' => 'original',
        ]);

        $result = $this->repository->setValue($value, 'updated');

        $this->assertTrue($result);
        $this->assertEquals('updated', $value->fresh()->value_string);
    }

    public function testGetFieldReturnsField(): void
    {
        $value = FieldValue::factory()->create([
            'field_id' => $this->field->id,
        ]);

        $field = $this->repository->getField($value);

        $this->assertInstanceOf(Field::class, $field);
        $this->assertEquals($this->field->id, $field->id);
    }

    public function testSetFieldReturnsTrue(): void
    {
        $value = FieldValue::factory()->create();
        $newField = Field::factory()->create();

        $result = $this->repository->setField($value, $newField);

        $this->assertTrue($result);
        $this->assertEquals($newField->id, $value->fresh()->field_id);
    }

    public function testGetEntityReturnsEntity(): void
    {
        $value = FieldValue::factory()->create([
            'entity_type' => 'entry',
            'entity_id' => $this->entry->id,
        ]);

        $entity = $this->repository->getEntity($value);

        $this->assertInstanceOf(Entry::class, $entity);
        $this->assertEquals($this->entry->id, $entity->id);
    }

    public function testSetEntityReturnsTrue(): void
    {
        $value = FieldValue::factory()->create();
        $newEntry = Entry::factory()->create();

        $result = $this->repository->setEntity($value, 'entry', $newEntry);

        $this->assertTrue($result);
        $this->assertEquals($newEntry->id, $value->fresh()->entity_id);
    }

    public function testGetLocaleReturnsString(): void
    {
        $value = FieldValue::factory()->create([
            'locale' => 'en',
        ]);

        $locale = $this->repository->getLocale($value);

        $this->assertEquals('en', $locale);
    }

    public function testSetLocaleReturnsTrue(): void
    {
        $value = FieldValue::factory()->create([
            'locale' => 'en',
        ]);

        $result = $this->repository->setLocale($value, 'ru');

        $this->assertTrue($result);
        $this->assertEquals('ru', $value->fresh()->locale);
    }

    public function testIsActiveReturnsCorrectValue(): void
    {
        $active = FieldValue::factory()->create(['is_active' => true]);
        $inactive = FieldValue::factory()->create(['is_active' => false]);

        $this->assertTrue($this->repository->isActive($active));
        $this->assertFalse($this->repository->isActive($inactive));
    }

    public function testActivateReturnsTrue(): void
    {
        $value = FieldValue::factory()->create(['is_active' => false]);

        $result = $this->repository->activate($value);

        $this->assertTrue($result);
        $this->assertTrue($value->fresh()->is_active);
    }

    public function testDeactivateReturnsTrue(): void
    {
        $value = FieldValue::factory()->create(['is_active' => true]);

        $result = $this->repository->deactivate($value);

        $this->assertTrue($result);
        $this->assertFalse($value->fresh()->is_active);
    }

    public function testDeleteByFieldAndEntity(): void
    {
        $value = FieldValue::factory()->create([
            'field_id' => $this->field->id,
            'entity_type' => 'entry',
            'entity_id' => $this->entry->id,
        ]);

        $result = $this->repository->deleteByFieldAndEntity($this->field, $this->entry);

        $this->assertTrue($result);
        $this->assertSoftDeleted($value);
    }

    public function testDeleteByField(): void
    {
        $value = FieldValue::factory()->create([
            'field_id' => $this->field->id,
        ]);

        $result = $this->repository->deleteByField($this->field);

        $this->assertTrue($result);
    }

    public function testDeleteByEntity(): void
    {
        $value = FieldValue::factory()->create([
            'entity_type' => 'entry',
            'entity_id' => $this->entry->id,
        ]);

        $result = $this->repository->deleteByEntity($this->entry);

        $this->assertTrue($result);
    }

    public function testGetByLocaleReturnsArray(): void
    {
        FieldValue::factory()->count(2)->create([
            'locale' => 'en',
        ]);
        FieldValue::factory()->count(3)->create([
            'locale' => 'ru',
        ]);

        $enValues = $this->repository->getByLocale('en');

        $this->assertIsArray($enValues);
        $this->assertCount(2, $enValues);
    }

    public function testGetTranslatableValuesReturnsArray(): void
    {
        $field = Field::factory()->create(['translatable' => true]);
        FieldValue::factory()->count(3)->create([
            'field_id' => $field->id,
        ]);

        $values = $this->repository->getTranslatableValues($field, $this->entry);

        $this->assertIsArray($values);
    }

    public function testSyncValuesReturnsTrue(): void
    {
        $values = [
            ['field_id' => $this->field->id, 'value_string' => 'value1', 'locale' => 'en'],
            ['field_id' => $this->field->id, 'value_string' => 'value2', 'locale' => 'ru'],
        ];

        $result = $this->repository->syncValues($this->entry, $values);

        $this->assertTrue($result);
    }
}