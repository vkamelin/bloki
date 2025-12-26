<?php

namespace App\Repositories;

use App\Models\Collection;
use App\Models\Entry;
use App\Repositories\Interfaces\EntryRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EntryRepository implements EntryRepositoryInterface
{

    /**
     * @param array $data
     * @return Entry|null
     */
    public function create(array $data): ?Entry
    {
        // TODO: Реализовать метод create()
    }

    /**
     * @param int|Entry $entry
     * @param array $data
     * @return Entry|null
     */
    public function update(Entry|int $entry, array $data): ?Entry
    {
        // TODO: Реализовать метод update()
    }

    /**
     * @param int|Entry $entry
     * @return bool
     */
    public function delete(Entry|int $entry): bool
    {
        // TODO: Реализовать метод delete()
    }

    /**
     * @param int|Entry $entry
     * @return Entry|null
     */
    public function restore(Entry|int $entry): ?Entry
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
     * @param int|Entry $entry
     * @return Entry|null
     */
    public function getById(Entry|int $entry): ?Entry
    {
        // TODO: Реализовать метод getById()
    }

    /**
     * @param string $slug
     * @return Entry|null
     */
    public function getBySlug(string $slug): ?Entry
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
     * Получение значения поля записи
     *
     * @param Entry $entry
     * @param string $fieldHandle
     * @return mixed
     */
    public function getField(Entry|int $entry, string $fieldHandle)
    {
        // TODO: Реализовать метод getField()
    }

    /**
     * Установка значения поля записи
     *
     * @param Entry $entry
     * @param string $fieldHandle
     * @param mixed $value
     * @return bool
     */
    public function setField(Entry|int $entry, string $fieldHandle, mixed $value): bool
    {
        // TODO: Реализовать метод setField()
    }

    /**
     * Получение коллекции записи
     *
     * @param Entry $entry
     * @return Collection|null
     */
    public function getCollection(Entry|int $entry): ?Collection
    {
        // TODO: Реализовать метод getCollection()
    }

    /**
     * Установка коллекции записи
     *
     * @param Entry $entry
     * @param int $collectionId
     * @return bool
     */
    public function setCollection(Entry|int $entry, int $collectionId): bool
    {
        // TODO: Реализовать метод setCollection()
    }

    /**
     * Проверка статуса "черновик"
     *
     * @param Entry $entry
     * @return bool
     */
    public function isDraft(Entry|int $entry): bool
    {
        // TODO: Реализовать метод isDraft()
    }

    /**
     * Проверка статуса "опубликовано"
     *
     * @param Entry $entry
     * @return bool
     */
    public function isPublished(Entry|int $entry): bool
    {
        // TODO: Реализовать метод isPublished()
    }

    /**
     * Проверка статуса "на проверке"
     *
     * @param Entry $entry
     * @return bool
     */
    public function isReview(Entry|int $entry): bool
    {
        // TODO: Реализовать метод isReview()
    }

    /**
     * Проверка статуса "в архиве"
     *
     * @param Entry $entry
     * @return bool
     */
    public function isArchived(Entry|int $entry): bool
    {
        // TODO: Реализовать метод isArchived()
    }

    /**
     * Публикация записи
     *
     * @param Entry $entry
     * @return bool
     */
    public function publish(Entry|int $entry): bool
    {
        // TODO: Реализовать метод publish()
    }
}
