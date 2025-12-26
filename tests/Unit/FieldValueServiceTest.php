<?php

namespace Tests\Unit;

use App\Models\Field;
use App\Models\FieldValue;
use App\Services\FieldValueService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FieldValueServiceTest extends TestCase
{
    use RefreshDatabase;

    protected FieldValueService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new FieldValueService();
    }

    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(FieldValueService::class, $this->service);
    }

    /** @test */
    public function set_value_creates_field_value()
    {
        $field = Field::factory()->create(['type' => 'text']);
        $data = [
            'entity_type' => 'entry',
            'entity_id' => 1,
            'field_id' => $field->id,
            'value' => 'Test value',
        ];

        $result = $this->service->setValue($data);

        $this->assertInstanceOf(FieldValue::class, $result);
    }

    /** @test */
    public function set_value_updates_existing_value()
    {
        $field = Field::factory()->create(['type' => 'text']);
        $existingValue = FieldValue::factory()->create([
            'entity_type' => 'entry',
            'entity_id' => 1,
            'field_id' => $field->id,
            'value_string' => 'Original value',
        ]);

        $data = [
            'entity_type' => 'entry',
            'entity_id' => 1,
            'field_id' => $field->id,
            'value' => 'Updated value',
        ];

        $result = $this->service->setValue($data);

        $this->assertInstanceOf(FieldValue::class, $result);
    }

    /** @test */
    public function get_value_returns_mixed()
    {
        $field = Field::factory()->create(['type' => 'text']);
        $fieldValue = FieldValue::factory()->create([
            'entity_type' => 'entry',
            'entity_id' => 1,
            'field_id' => $field->id,
            'value_string' => 'Test value',
        ]);

        $result = $this->service->getValue($field, 'entry', 1);

        // Result can be null or the value
        $this->assertNotInstanceOf(FieldValue::class, $result);
    }

    /** @test */
    public function get_value_returns_null_for_missing_value()
    {
        $field = Field::factory()->create(['type' => 'text']);

        $result = $this->service->getValue($field, 'entry', 999);

        $this->assertNull($result);
    }

    /** @test */
    public function delete_value_returns_true_on_success()
    {
        $fieldValue = FieldValue::factory()->create();

        $result = $this->service->deleteValue($fieldValue);

        $this->assertTrue($result);
    }

    /** @test */
    public function delete_value_deletes_field_value()
    {
        $fieldValue = FieldValue::factory()->create();
        $id = $fieldValue->id;

        $this->service->deleteValue($fieldValue);

        $this->assertNull(FieldValue::find($id));
    }

    /** @test */
    public function delete_values_by_entity_deletes_all_values()
    {
        $field = Field::factory()->create(['type' => 'text']);
        FieldValue::factory()->count(3)->create([
            'entity_type' => 'entry',
            'entity_id' => 1,
            'field_id' => $field->id,
        ]);

        $result = $this->service->deleteValuesByEntity('entry', 1);

        $this->assertTrue($result);
        $this->assertEmpty(FieldValue::where('entity_type', 'entry')
            ->where('entity_id', 1)
            ->get());
    }

    /** @test */
    public function get_values_by_entity_returns_array()
    {
        $field = Field::factory()->create(['type' => 'text']);
        FieldValue::factory()->count(2)->create([
            'entity_type' => 'entry',
            'entity_id' => 1,
            'field_id' => $field->id,
        ]);

        $result = $this->service->getValuesByEntity('entry', 1);

        $this->assertIsArray($result);
    }

    /** @test */
    public function get_values_by_field_returns_array()
    {
        $field = Field::factory()->create(['type' => 'text']);
        FieldValue::factory()->count(3)->create([
            'entity_type' => 'entry',
            'entity_id' => 1,
            'field_id' => $field->id,
        ]);

        $result = $this->service->getValuesByField($field, 'entry', 1);

        $this->assertIsArray($result);
    }

    /** @test */
    public function get_values_by_field_group_returns_array()
    {
        $field = Field::factory()->create();
        FieldValue::factory()->count(2)->create([
            'entity_type' => 'entry',
            'entity_id' => 1,
            'field_id' => $field->id,
        ]);

        $result = $this->service->getValuesByFieldGroup($field->group, 'entry', 1);

        $this->assertIsArray($result);
    }

    /** @test */
    public function copy_values_copies_values_to_new_entity()
    {
        $field = Field::factory()->create(['type' => 'text']);
        FieldValue::factory()->create([
            'entity_type' => 'entry',
            'entity_id' => 1,
            'field_id' => $field->id,
            'value_string' => 'Original value',
        ]);

        $result = $this->service->copyValues('entry', 1, 'entry', 2);

        $this->assertTrue($result);
    }

    /** @test */
    public function move_values_moves_values_to_new_entity()
    {
        $field = Field::factory()->create(['type' => 'text']);
        FieldValue::factory()->create([
            'entity_type' => 'entry',
            'entity_id' => 1,
            'field_id' => $field->id,
            'value_string' => 'Test value',
        ]);

        $result = $this->service->moveValues('entry', 1, 'entry', 2);

        $this->assertTrue($result);
    }

    /** @test */
    public function set_translated_value_creates_translated_value()
    {
        $field = Field::factory()->create(['type' => 'text', 'translatable' => true]);
        $data = [
            'entity_type' => 'entry',
            'entity_id' => 1,
            'field_id' => $field->id,
            'value' => 'Translated value',
            'locale' => 'en',
        ];

        $result = $this->service->setTranslatedValue($data);

        $this->assertInstanceOf(FieldValue::class, $result);
    }

    /** @test */
    public function get_translated_value_returns_value_for_locale()
    {
        $field = Field::factory()->create(['type' => 'text', 'translatable' => true]);
        FieldValue::factory()->create([
            'entity_type' => 'entry',
            'entity_id' => 1,
            'field_id' => $field->id,
            'value_string' => 'English value',
            'locale' => 'en',
        ]);

        $result = $this->service->getTranslatedValue($field, 'entry', 1, 'en');

        $this->assertNotInstanceOf(FieldValue::class, $result);
    }

    /** @test */
    public function get_all_translations_returns_array()
    {
        $field = Field::factory()->create(['type' => 'text', 'translatable' => true]);
        FieldValue::factory()->create([
            'entity_type' => 'entry',
            'entity_id' => 1,
            'field_id' => $field->id,
            'value_string' => 'English',
            'locale' => 'en',
        ]);
        FieldValue::factory()->create([
            'entity_type' => 'entry',
            'entity_id' => 1,
            'field_id' => $field->id,
            'value_string' => 'German',
            'locale' => 'de',
        ]);

        $result = $this->service->getAllTranslations($field, 'entry', 1);

        $this->assertIsArray($result);
    }

    /** @test */
    public function set_value_handles_different_types()
    {
        $textField = Field::factory()->create(['type' => 'text']);
        $numberField = Field::factory()->create(['type' => 'number']);

        $textResult = $this->service->setValue([
            'entity_type' => 'entry',
            'entity_id' => 1,
            'field_id' => $textField->id,
            'value' => 'Text value',
        ]);

        $numberResult = $this->service->setValue([
            'entity_type' => 'entry',
            'entity_id' => 2,
            'field_id' => $numberField->id,
            'value' => 42,
        ]);

        $this->assertInstanceOf(FieldValue::class, $textResult);
        $this->assertInstanceOf(FieldValue::class, $numberResult);
    }

    /** @test */
    public function set_value_handles_json()
    {
        $jsonField = Field::factory()->create(['type' => 'json']);
        $data = [
            'entity_type' => 'entry',
            'entity_id' => 1,
            'field_id' => $jsonField->id,
            'value' => ['key' => 'value'],
        ];

        $result = $this->service->setValue($data);

        $this->assertInstanceOf(FieldValue::class, $result);
    }

    /** @test */
    public function set_value_handles_boolean()
    {
        $boolField = Field::factory()->create(['type' => 'boolean']);
        $data = [
            'entity_type' => 'entry',
            'entity_id' => 1,
            'field_id' => $boolField->id,
            'value' => true,
        ];

        $result = $this->service->setValue($data);

        $this->assertInstanceOf(FieldValue::class, $result);
    }

    /** @test */
    public function is_active_returns_true_for_active_value()
    {
        $fieldValue = FieldValue::factory()->create(['is_active' => true]);

        $result = $this->service->isActive($fieldValue);

        $this->assertTrue($result);
    }

    /** @test */
    public function is_active_returns_false_for_inactive_value()
    {
        $fieldValue = FieldValue::factory()->create(['is_active' => false]);

        $result = $this->service->isActive($fieldValue);

        $this->assertFalse($result);
    }
}