<?php

namespace App\Repositories;

use App\Models\Collection;
use App\Models\Section;
use App\Repositories\Interfaces\SectionRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SectionRepository implements SectionRepositoryInterface
{

    /**
     * @param array $data
     * @return Section|null
     */
    public function create(array $data): ?Section
    {
        // TODO: Реализовать метод create()
    }

    /**
     * @param Section|int $section
     * @param array $data
     * @return Section|null
     */
    public function update(Section|int $section, array $data): ?Section
    {
        // TODO: Реализовать метод update()
    }

    /**
     * @param Section|int $section
     * @return bool
     */
    public function delete(Section|int $section): bool
    {
        // TODO: Реализовать метод delete()
    }

    /**
     * @param Section|int $section
     * @return Section|null
     */
    public function restore(Section|int $section): ?Section
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
     * @param Section|int $section
     * @return Section|null
     */
    public function getById(Section|int $section): ?Section
    {
        // TODO: Реализовать метод getById()
    }

    /**
     * @param string $slug
     * @return Section|null
     */
    public function getBySlug(string $slug): ?Section
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
     * @return array
     */
    public function getTree(): array
    {
        // TODO: Реализовать метод getTree()
    }

    /**
     * @param Collection|int $collection
     * @return array
     */
    public function getTreeByCollectionId(Collection|int $collection): array
    {
        // TODO: Реализовать метод getTreeByCollectionId()
    }

    /**
     * @param Section|int $section
     * @return array
     */
    public function getTreeBySection(Section|int $section): array
    {
        // TODO: Реализовать метод getTreeBySection()
    }

    /**
     * @param Section|int $section
     * @return Section|null
     */
    public function getParent(Section|int $section): ?Section
    {
        // TODO: Реализовать метод getParent()
    }

    /**
     * @param Section|int $section
     * @return array
     */
    public function getAncestors(Section|int $section): array
    {
        // TODO: Реализовать метод getAncestors()
    }

    /**
     * @param Section|int $section
     * @return bool
     */
    public function hasParent(Section|int $section): bool
    {
        // TODO: Реализовать метод hasParent()
    }

    /**
     * @param Section|int $section
     * @return array
     */
    public function getChildren(Section|int $section): array
    {
        // TODO: Реализовать метод getChildren()
    }

    /**
     * @param Section|int $section
     * @return array
     */
    public function getDescendants(Section|int $section): array
    {
        // TODO: Реализовать метод getDescendants()
    }

    /**
     * @param Section|int $section
     * @return bool
     */
    public function hasChildren(Section|int $section): bool
    {
        // TODO: Реализовать метод hasChildren()
    }

    /**
     * @param Section|int $section
     * @return Collection|null
     */
    public function getCollection(Section|int $section): ?Collection
    {
        // TODO: Реализовать метод getCollection()
    }

    /**
     * @param int $collectionId
     * @return array
     */
    public function getSectionsByCollection(int $collectionId): array
    {
        // TODO: Реализовать метод getSectionsByCollection()
    }
}
