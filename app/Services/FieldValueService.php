<?php

namespace App\Services;

use App\Models\Field;
use App\Models\FieldValue;
use App\Models\Entry;

class FieldValueService
{
    public function __construct()
    {
    }

    public function create(array $data): FieldValue|null
    {
        // TODO: Реализовать создание значения поля
    }

    public function update(FieldValue|int $fieldValue, array $data): FieldValue|null
    {
        // TODO: Реализовать обновление значения поля
    }

    public function delete(FieldValue|int $fieldValue): FieldValue|null
    {
        // TODO: Реализовать удаление значения поля
    }

    public function restore(FieldValue|int $fieldValue): FieldValue|null
    {
        // TODO: Реализовать восстановление значения поля
    }

    public function getAll(array $filters = []): array
    {
        // TODO: Реализовать получение списка значений полей
    }

    public function getById(int $id): FieldValue|null
    {
        // TODO: Реализовать получение значения поля по ID
    }

    public function getByFieldAndEntry(Field|int $field, Entry|int $entity): FieldValue|null
    {
        // TODO: Реализовать получение значения поля по полю и сущности
    }

    public function getValue(FieldValue|int $fieldValue, Entry|int $entity, ?string $locale = null): FieldValue|null
    {
        // TODO: Реализовать получение значения поля
    }

    public function setValue(FieldValue|int $fieldValue, Entry|int $entity, mixed $value, ?string $locale = null): FieldValue|null
    {
        // TODO: Реализовать установка значения поля
    }

    public function isActive(FieldValue|int $fieldValue): bool
    {
        // TODO: Реализовать проверка активности значения поля
    }
}
