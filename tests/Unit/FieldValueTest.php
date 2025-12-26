<?php

namespace Tests\Unit;

use App\Models\Field;
use App\Models\FieldValue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FieldValueTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_field_value()
    {
        $field = Field::factory()->create();
        
        $fieldValue = FieldValue::factory()->create([
            'field_id' => $field->id,
            'entity_type' => 'entry',
            'entity_id' => 1,
            'value_type' => 'string',
            'value_string' => 'test value',
            'locale' => 'en',
            'is_active' => true,
        ]);

        $this->assertInstanceOf(FieldValue::class, $fieldValue);
        $this->assertEquals($field->id, $fieldValue->field_id);
        $this->assertEquals('entry', $fieldValue->entity_type);
        $this->assertEquals(1, $fieldValue->entity_id);
        $this->assertEquals('string', $fieldValue->value_type);
        $this->assertEquals('test value', $fieldValue->value_string);
        $this->assertEquals('en', $fieldValue->locale);
        $this->assertTrue($fieldValue->is_active);
    }

    /** @test */
    public function it_belongs_to_a_field()
    {
        $field = Field::factory()->create();
        $fieldValue = FieldValue::factory()->create([
            'field_id' => $field->id,
        ]);

        $this->assertInstanceOf(Field::class, $fieldValue->field);
        $this->assertEquals($field->id, $fieldValue->field->id);
    }

    /** @test */
    public function get_value_returns_correct_value_for_string_type()
    {
        $fieldValue = FieldValue::factory()->create([
            'value_type' => 'string',
            'value_string' => 'test string value',
        ]);

        $this->assertEquals('test string value', $fieldValue->getValue());
    }

    /** @test */
    public function get_value_returns_correct_value_for_text_type()
    {
        $fieldValue = FieldValue::factory()->create([
            'value_type' => 'text',
            'value_text' => 'test text value',
        ]);

        $this->assertEquals('test text value', $fieldValue->getValue());
    }

    /** @test */
    public function get_value_returns_correct_value_for_integer_type()
    {
        $fieldValue = FieldValue::factory()->create([
            'value_type' => 'integer',
            'value_int' => 42,
        ]);

        $this->assertEquals(42, $fieldValue->getValue());
    }

    /** @test */
    public function get_value_returns_correct_value_for_float_type()
    {
        $fieldValue = FieldValue::factory()->create([
            'value_type' => 'float',
            'value_float' => 3.14,
        ]);

        $this->assertEquals(3.14, $fieldValue->getValue());
    }

    /** @test */
    public function get_value_returns_correct_value_for_boolean_type()
    {
        $fieldValue = FieldValue::factory()->create([
            'value_type' => 'boolean',
            'value_bool' => true,
        ]);

        $this->assertTrue($fieldValue->getValue());
    }

    /** @test */
    public function get_value_returns_correct_value_for_json_type()
    {
        $jsonData = ['key' => 'value', 'number' => 42];
        $fieldValue = FieldValue::factory()->create([
            'value_type' => 'json',
            'value_json' => $jsonData,
        ]);

        $this->assertEquals($jsonData, $fieldValue->getValue());
    }

    /** @test */
    public function get_value_returns_correct_value_for_date_type()
    {
        $date = '2023-12-25';
        $fieldValue = FieldValue::factory()->create([
            'value_type' => 'date',
            'value_date' => $date,
        ]);

        $this->assertEquals($date, $fieldValue->getValue());
    }

    /** @test */
    public function get_value_returns_correct_value_for_datetime_type()
    {
        $datetime = '2023-12-25 15:30:00';
        $fieldValue = FieldValue::factory()->create([
            'value_type' => 'datetime',
            'value_datetime' => $datetime,
        ]);

        $this->assertEquals($datetime, $fieldValue->getValue());
    }

    /** @test */
    public function get_value_returns_null_for_unknown_type()
    {
        $fieldValue = FieldValue::factory()->create([
            'value_type' => 'unknown_type',
        ]);

        $this->assertNull($fieldValue->getValue());
    }

    /** @test */
    public function set_value_for_string_type()
    {
        $fieldValue = FieldValue::factory()->create();
        $fieldValue->setValue('test string', 'string');

        $this->assertEquals('string', $fieldValue->value_type);
        $this->assertEquals('test string', $fieldValue->value_string);
    }

    /** @test */
    public function set_value_for_integer_type()
    {
        $fieldValue = FieldValue::factory()->create();
        $fieldValue->setValue(42, 'integer');

        $this->assertEquals('integer', $fieldValue->value_type);
        $this->assertEquals(42, $fieldValue->value_int);
    }

    /** @test */
    public function set_value_for_float_type()
    {
        $fieldValue = FieldValue::factory()->create();
        $fieldValue->setValue(3.14, 'float');

        $this->assertEquals('float', $fieldValue->value_type);
        $this->assertEquals(3.14, $fieldValue->value_float);
    }

    /** @test */
    public function set_value_for_boolean_type()
    {
        $fieldValue = FieldValue::factory()->create();
        $fieldValue->setValue(true, 'boolean');

        $this->assertEquals('boolean', $fieldValue->value_type);
        $this->assertTrue($fieldValue->value_bool);
    }

    /** @test */
    public function set_value_for_json_type()
    {
        $fieldValue = FieldValue::factory()->create();
        $data = ['key' => 'value', 'number' => 42];
        $fieldValue->setValue($data, 'json');

        $this->assertEquals('json', $fieldValue->value_type);
        $this->assertEquals($data, $fieldValue->value_json);
    }

    /** @test */
    public function set_value_infers_type_from_value()
    {
        $fieldValue = FieldValue::factory()->create();
        
        // Test boolean inference
        $fieldValue->setValue(true);
        $this->assertEquals('boolean', $fieldValue->value_type);
        
        // Test integer inference
        $fieldValue->setValue(42);
        $this->assertEquals('integer', $fieldValue->value_type);
        
        // Test float inference
        $fieldValue->setValue(3.14);
        $this->assertEquals('float', $fieldValue->value_type);
        
        // Test array inference
        $fieldValue->setValue(['key' => 'value']);
        $this->assertEquals('json', $fieldValue->value_type);
        
        // Test string inference (default)
        $fieldValue->setValue('test string');
        $this->assertEquals('string', $fieldValue->value_type);
    }

    /** @test */
    public function is_date_detects_date_format()
    {
        $fieldValue = new FieldValue();
        
        $this->assertTrue($fieldValue->isDate('2023-12-25'));
        $this->assertTrue($fieldValue->isDate('01/01/2023'));
        $this->assertFalse($fieldValue->isDate('2023-12-25 15:30:00'));
        $this->assertFalse($fieldValue->isDate('invalid-date'));
        $this->assertFalse($fieldValue->isDate(123));
    }

    /** @test */
    public function is_date_time_detects_datetime_format()
    {
        $fieldValue = new FieldValue();
        
        $this->assertTrue($fieldValue->isDateTime('2023-12-25 15:30:00'));
        $this->assertTrue($fieldValue->isDateTime('2023-12-25T15:30:00'));
        $this->assertFalse($fieldValue->isDateTime('2023-12-25'));
        $this->assertFalse($fieldValue->isDateTime('invalid-datetime'));
        $this->assertFalse($fieldValue->isDateTime(123));
    }

    /** @test */
    public function it_handles_soft_deletes()
    {
        $fieldValue = FieldValue::factory()->create();
        $fieldValueId = $fieldValue->id;

        $fieldValue->delete();

        $this->assertSoftDeleted($fieldValue);
        $this->assertNotNull(FieldValue::withTrashed()->find($fieldValueId));
    }

    /** @test */
    public function it_casts_value_bool_to_boolean()
    {
        $fieldValue = FieldValue::factory()->create([
            'value_bool' => true,
        ]);
        $this->assertIsBool($fieldValue->value_bool);
        $this->assertTrue($fieldValue->value_bool);
    }

    /** @test */
    public function it_casts_value_json_to_array()
    {
        $jsonData = ['key' => 'value', 'number' => 42];
        $fieldValue = FieldValue::factory()->create([
            'value_json' => $jsonData,
        ]);

        $this->assertIsArray($fieldValue->value_json);
        $this->assertEquals('value', $fieldValue->value_json['key']);
        $this->assertEquals(42, $fieldValue->value_json['number']);
    }

    /** @test */
    public function it_casts_value_date_to_date()
    {
        $date = '2023-12-25';
        $fieldValue = FieldValue::factory()->create([
            'value_date' => $date,
        ]);

        $this->assertInstanceOf(\Carbon\Carbon::class, $fieldValue->value_date);
        $this->assertEquals($date, $fieldValue->value_date->format('Y-m-d'));
    }

    /** @test */
    public function it_casts_value_datetime_to_datetime()
    {
        $datetime = '2023-12-25 15:30:00';
        $fieldValue = FieldValue::factory()->create([
            'value_datetime' => $datetime,
        ]);

        $this->assertInstanceOf(\Carbon\Carbon::class, $fieldValue->value_datetime);
        $this->assertEquals($datetime, $fieldValue->value_datetime->format('Y-m-d H:i:s'));
    }

    /** @test */
    public function it_casts_is_active_to_boolean()
    {
        $fieldValue = FieldValue::factory()->create(['is_active' => true]);
        $this->assertIsBool($fieldValue->is_active);
        $this->assertTrue($fieldValue->is_active);
    }

    /** @test */
    public function set_value_handles_long_text_as_text_type()
    {
        $fieldValue = FieldValue::factory()->create();
        $longText = str_repeat('a', 300); // Longer than 255 characters
        
        $fieldValue->setValue($longText);
        
        $this->assertEquals('text', $fieldValue->value_type);
        $this->assertEquals($longText, $fieldValue->value_text);
    }

    /** @test */
    public function set_value_handles_short_text_as_string_type()
    {
        $fieldValue = FieldValue::factory()->create();
        $shortText = 'short text';
        
        $fieldValue->setValue($shortText);
        
        $this->assertEquals('string', $fieldValue->value_type);
        $this->assertEquals($shortText, $fieldValue->value_string);
    }

    /** @test */
    public function it_handles_null_values()
    {
        $fieldValue = FieldValue::factory()->create([
            'value_string' => null,
        ]);

        $this->assertNull($fieldValue->value_string);
    }

    /** @test */
    public function it_handles_different_entity_types()
    {
        $entityTypes = ['entry', 'section', 'media'];
        
        foreach ($entityTypes as $entityType) {
            $fieldValue = FieldValue::factory()->create([
                'entity_type' => $entityType,
            ]);
            $this->assertEquals($entityType, $fieldValue->entity_type);
        }
    }

    /** @test */
    public function it_handles_different_locales()
    {
        $locales = ['en', 'ru', 'fr', 'de'];
        
        foreach ($locales as $locale) {
            $fieldValue = FieldValue::factory()->create([
                'locale' => $locale,
            ]);
            $this->assertEquals($locale, $fieldValue->locale);
        }
    }
}