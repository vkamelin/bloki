<?php

namespace App\Repositories;

use App\Models\Collection;
use App\Repositories\Interfaces\CollectionRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CollectionRepository implements CollectionRepositoryInterface
{

    /**
     * @param array $data
     * @return Collection|null
     */
    public function create(array $data): ?Collection
    {
        // TODO: Реализовать метод create()
    }

    /**
     * @param int|Collection $collection
     * @param array $data
     * @return Collection|null
     */
    public function update(int|Collection $collection, array $data): ?Collection
    {
        // TODO: Реализовать метод update()
    }

    /**
     * @param int|Collection $collection
     * @return bool
     */
    public function delete(int|Collection $collection): bool
    {
        // TODO: Реализовать метод delete()
    }

    /**
     * @param int|Collection $collection
     * @return Collection|null
     */
    public function restore(int|Collection $collection): ?Collection
    {
        // TODO: Реализовать метод restore()
    }

    /**
     * @param array $filters
     * @return array
     */
    public function getAll(array $filters = []): array
    {
        // TODO: Реализовать метод getAll()
    }

    /**
     * @param int|Collection $collection
     * @return Collection|null
     */
    public function getById(int|Collection $collection): ?Collection
    {
        // TODO: Реализовать метод getById()
    }

    /**
     * @param string $slug
     * @return Collection|null
     */
    public function getBySlug(string $slug): ?Collection
    {
        // TODO: Реализовать метод getBySlug()
    }

    /**
     * @param int $perPage
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        // TODO: Реализовать метод paginate()
    }

    /**
     * @param array $conditions
     * @return array
     */
    public function where(array $conditions): array
    {
        // TODO: Реализовать метод where()
    }

    /**
     * @param array $relations
     * @return array
     */
    public function with(array $relations): array
    {
        // TODO: Реализовать метод with()
    }

    /**
     * @param int|Collection $collection
     * @return Collection|null
     */
    public function duplicate(int|Collection $collection): ?Collection
    {
        // TODO: Реализовать метод duplicate()
    }

    /**
     * @param string $handle
     * @return Collection|null
     */
    public function getSingleton(string $handle): ?Collection
    {
        // TODO: Реализовать метод getSingleton()
    }

    /**
     * @param Collection|int $collection
     * @return bool
     */
    public function isSingleton(Collection|int $collection): bool
    {
        // TODO: Реализовать метод isSingleton()
    }

    /**
     * @param Collection|int $collection
     * @return bool
     */
    public function hasSections(Collection|int $collection): bool
    {
        // TODO: Реализовать метод hasSections()
    }

    /**
     * @param Collection|int $collection
     * @return array
     */
    public function getSectionStructure(Collection|int $collection): array
    {
        // TODO: Реализовать метод getSectionStructure()
    }

    /**
     * @param Collection|int $collection
     * @return string|null
     */
    public function getDefaultTemplateSection(Collection|int $collection): ?string
    {
        // TODO: Реализовать метод getDefaultTemplateSection()
    }

    /**
     * @param Collection|int $collection
     * @return string|null
     */
    public function getDefaultTemplateEntry(Collection|int $collection): ?string
    {
        // TODO: Реализовать метод getDefaultTemplateEntry()
    }

    /**
     * @param Collection|int $collection
     * @return array
     */
    public function getEntryBehavior(Collection|int $collection): array
    {
        // TODO: Реализовать метод getEntryBehavior()
    }

    /**
     * @param Collection|int $collection
     * @param array $behavior
     * @return bool
     */
    public function updateEntryBehavior(Collection|int $collection, array $behavior): bool
    {
        // TODO: Реализовать метод updateEntryBehavior()
    }

    /**
     * @param Collection|int $collection
     * @param string $template
     * @return bool
     */
    public function setDefaultTemplateSection(Collection|int $collection, string $template): bool
    {
        // TODO: Реализовать метод setDefaultTemplateSection()
    }

    /**
     * @param Collection|int $collection
     * @param string $template
     * @return bool
     */
    public function setDefaultTemplateEntry(Collection|int $collection, string $template): bool
    {
        // TODO: Реализовать метод setDefaultTemplateEntry()
    }

    /**
     * @param Collection|int $collection
     * @return array
     */
    public function getFields(Collection|int $collection): array
    {
        // TODO: Реализовать метод getFields()
    }

    /**
     * @param Collection|int $collection
     * @param array $fieldData
     * @return object|null
     */
    public function addField(Collection|int $collection, array $fieldData): ?object
    {
        // TODO: Реализовать метод addField()
    }

    /**
     * @param Collection|int $collection
     * @param int $fieldId
     * @param array $fieldData
     * @return bool
     */
    public function updateField(Collection|int $collection, int $fieldId, array $fieldData): bool
    {
        // TODO: Реализовать метод updateField()
    }

    /**
     * @param Collection|int $collection
     * @param int $fieldId
     * @return bool
     */
    public function deleteField(Collection|int $collection, int $fieldId): bool
    {
        // TODO: Реализовать метод deleteField()
    }

    /**
     * @param Collection|int $collection
     * @return array
     */
    public function getSections(Collection|int $collection): array
    {
        // TODO: Реализовать метод getSections()
    }

    /**
     * @param Collection|int $collection
     * @param array $sectionData
     * @return object|null
     */
    public function addSection(Collection|int $collection, array $sectionData): ?object
    {
        // TODO: Реализовать метод addSection()
    }

    /**
     * @param Collection|int $collection
     * @param int $sectionId
     * @param array $sectionData
     * @return bool
     */
    public function updateSection(Collection|int $collection, int $sectionId, array $sectionData): bool
    {
        // TODO: Реализовать метод updateSection()
    }

    /**
     * @param Collection|int $collection
     * @param int $sectionId
     * @return bool
     */
    public function deleteSection(Collection|int $collection, int $sectionId): bool
    {
        // TODO: Реализовать метод deleteSection()
    }

    /**
     * @param Collection|int $collection
     * @param array $filters
     * @return array
     */
    public function getEntries(Collection|int $collection, array $filters = []): array
    {
        // TODO: Реализовать метод getEntries()
    }

    /**
     * @param Collection|int $collection
     * @param array $entryData
     * @return object|null
     */
    public function createEntry(Collection|int $collection, array $entryData): ?object
    {
        // TODO: Реализовать метод createEntry()
    }

    /**
     * @param Collection|int $collection
     * @param int $entryId
     * @param array $entryData
     * @return bool
     */
    public function updateEntry(Collection|int $collection, int $entryId, array $entryData): bool
    {
        // TODO: Реализовать метод updateEntry()
    }

    /**
     * @param Collection|int $collection
     * @param int $entryId
     * @return bool
     */
    public function deleteEntry(Collection|int $collection, int $entryId): bool
    {
        // TODO: Реализовать метод deleteEntry()
    }
}
