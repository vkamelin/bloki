<?php

namespace App\Repositories;

use App\Models\Collection;
use App\Repositories\Interfaces\CollectionRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


// TODO: Добавить методы для работы с поведением записей коллекции
// TODO: Добавить методы для работы с шаблонами коллекции
// TODO: Добавить методы для работы с полями коллекции
// TODO: Добавить методы для работы с разделами коллекции
// TODO: Добавить методы для работы с записями коллекции
class CollectionRepository implements CollectionRepositoryInterface
{

    public function create(array $data): ?Collection
    {
        // TODO: Реализовать метод create()
    }

    public function update(int $id, array $data): ?Collection
    {
        // TODO: Реализовать метод update()
    }

    public function delete(int $id): bool
    {
        // TODO: Реализовать метод delete()
    }

    public function restore(int $id): ?Collection
    {
        // TODO: Реализовать метод restore()
    }

    public function getAll(array $filters = []): array
    {
        // TODO: Реализовать метод getAll()
    }

    public function getById(int $id): ?Collection
    {
        // TODO: Реализовать метод getById()
    }

    public function getBySlug(string $slug): ?Collection
    {
        // TODO: Реализовать метод getBySlug()
    }

    public function paginate(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        // TODO: Реализовать метод paginate()
    }

    public function where(array $conditions): array
    {
        // TODO: Реализовать метод where()
    }

    public function with(array $relations): array
    {
        // TODO: Реализовать метод with()
    }

    public function duplicate(int $id): ?Collection
    {
        // TODO: Реализовать метод duplicate()
    }

    public function getSingleton(string $handle): ?Collection
    {
        // TODO: Реализовать метод getSingleton()
    }

    public function isSingleton(Collection|int $collection): bool
    {
        // TODO: Реализовать метод isSingleton()
    }

    public function hasSections(Collection|int $collection): bool
    {
        // TODO: Реализовать метод hasSections()
    }

    public function getSectionStructure(Collection|int $collection): array
    {
        // TODO: Реализовать метод getSectionStructure()
    }

    public function getDefaultTemplateSection(Collection|int $collection): ?string
    {
        // TODO: Реализовать метод getDefaultTemplateSection()
    }

    public function getDefaultTemplateEntry(Collection|int $collection): ?string
    {
        // TODO: Реализовать метод getDefaultTemplateEntry()
    }
}
