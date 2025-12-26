<?php

namespace App\Repositories;

use App\Models\Entry;
use App\Models\Field;
use App\Models\FieldValue;
use App\Repositories\Interfaces\FieldValueRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FieldValueRepository implements FieldValueRepositoryInterface
{

    /**
     * @param array $data
     * @return FieldValue|null
     */
    public function create(array $data): ?FieldValue
    {
        // TODO: Реализовать метод create()
    }

    /**
     * @param FieldValue|int $fieldValue
     * @param array $data
     * @return FieldValue|null
     */
    public function update(FieldValue|int $fieldValue, array $data): ?FieldValue
    {
        // TODO: Реализовать метод update()
    }

    /**
     * @param FieldValue|int $fieldValue
     * @return bool
     */
    public function delete(FieldValue|int $fieldValue): bool
    {
        // TODO: Реализовать метод delete()
    }

    /**
     * @param FieldValue|int $fieldValue
     * @return FieldValue|null
     */
    public function restore(FieldValue|int $fieldValue): ?FieldValue
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
     * @param FieldValue|int $fieldValue
     * @return FieldValue|null
     */
    public function getById(FieldValue|int $fieldValue): ?FieldValue
    {
        // TODO: Реализовать метод getById()
    }

    /**
     * @param Field|int $field
     * @param Entry|int $entry
     * @return FieldValue|null
     */
    public function getByFieldAndEntry(int|Field $field, int|Entry $entry): ?FieldValue
    {
        // TODO: Реализовать метод getByFieldAndEntry()
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
     * @param Field|int $field
     * @param array $filters
     * @return array
     */
    public function getByField(int|Field $field, array $filters = []): array
    {
        // TODO: Реализовать метод getByField()
    }

    /**
     * @param string $entityType
     * @param int $entityId
     * @param array $filters
     * @return array
     */
    public function getByEntity(string $entityType, int $entityId, array $filters = []): array
    {
        // TODO: Реализовать метод getByEntity()
    }

    /**
     * @param string $entityType
     * @param array $filters
     * @return array
     */
    public function getByEntityType(string $entityType, array $filters = []): array
    {
        // TODO: Реализовать метод getByEntityType()
    }

    // Методы для работы с типом значения

    /**
     * @param string $valueType
     * @param array $filters
     * @return array
     */
    public function getByValueType(string $valueType, array $filters = []): array
    {
        // TODO: Реализовать метод getByValueType()
    }

    /**
     * @param string $locale
     * @param array $filters
     * @return array
     */
    public function getByLocale(string $locale, array $filters = []): array
    {
        // TODO: Реализовать метод getByLocale()
    }

    /**
     * @param bool $isActive
     * @return array
     */
    public function getByActiveStatus(bool $isActive): array
    {
        // TODO: Реализовать метод getByActiveStatus()
    Ъ
