<?php

namespace Tests\Unit\Repositories;

use App\Models\Admin;
use App\Models\Collection;
use App\Models\Entry;
use App\Models\Field;
use App\Models\FieldGroup;
use App\Models\FieldValue;
use App\Models\Media;
use App\Models\Revision;
use App\Models\Section;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Базовый класс для тестов репозиториев
 * Содержит общие методы и фабрики
 */
abstract class BaseRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected function createAdmin(array $attributes = []): Admin
    {
        return Admin::factory()->create($attributes);
    }

    protected function createCollection(array $attributes = []): Collection
    {
        return Collection::factory()->create($attributes);
    }

    protected function createSection(array $attributes = []): Section
    {
        return Section::factory()->create($attributes);
    }

    protected function createEntry(array $attributes = []): Entry
    {
        return Entry::factory()->create($attributes);
    }

    protected function createField(array $attributes = []): Field
    {
        return Field::factory()->create($attributes);
    }

    protected function createFieldGroup(array $attributes = []): FieldGroup
    {
        return FieldGroup::factory()->create($attributes);
    }

    protected function createFieldValue(array $attributes = []): FieldValue
    {
        return FieldValue::factory()->create($attributes);
    }

    protected function createMedia(array $attributes = []): Media
    {
        return Media::factory()->create($attributes);
    }

    protected function createRevision(array $attributes = []): Revision
    {
        return Revision::factory()->create($attributes);
    }

    protected function createSectionTree(int $depth = 3, int $childrenPerLevel = 2): Section
    {
        $collection = $this->createCollection();

        return $this->buildSectionTree($collection, $depth, $childrenPerLevel);
    }

    private function buildSectionTree(Collection $collection, int $depth, int $children, ?Section $parent = null): Section
    {
        $section = Section::factory()->create([
            'collection_id' => $collection->id,
            'parent_id' => $parent?->id,
        ]);

        if ($depth > 1) {
            for ($i = 0; $i < $children; $i++) {
                $this->buildSectionTree($collection, $depth - 1, $children, $section);
            }
        }

        return $section;
    }

    protected function createEntryWithValues(array $fieldValues = []): Entry
    {
        $entry = $this->createEntry();

        foreach ($fieldValues as $fieldHandle => $value) {
            $field = $this->createField([
                'slug' => $fieldHandle,
            ]);

            FieldValue::factory()->create([
                'field_id' => $field->id,
                'entity_type' => 'entry',
                'entity_id' => $entry->id,
                'value_string' => is_string($value) ? $value : null,
                'value_int' => is_int($value) ? $value : null,
            ]);
        }

        return $entry;
    }

    protected function assertModelEquals(array $expected, object $actual, array $keys = []): void
    {
        foreach ($expected as $key => $value) {
            if (empty($keys) || in_array($key, $keys)) {
                $this->assertEquals($value, $actual->{$key});
            }
        }
    }
}