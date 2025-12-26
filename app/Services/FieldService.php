<?php

namespace App\Services;

use App\Models\Field;
use App\Models\FieldGroup;

class FieldService
{
    public function __construct()
    {
    }

    public function create(array $data): Field|null
    {
        // TODO: Реализовать создание поля
    }

    public function update(Field|int $field, array $data): Field|null
    {
        // TODO: Реализовать обновление поля
    }

    public function delete(Field|int $field): Field|null
    {
        // TODO: Реализовать удаление поля
    }

    public function restore(Field|int $field): Field|null
    {
        // TODO: Реализовать восстановление поля
    }

    public function getAll(array $filters = []): array
    {
        // TODO: Реализовать получение списка полей
    }

    public function getById(int $id): Field|null
    {
        // TODO: Реализовать получение поля по ID
    }

    public function getGroup(Field|int $field): FieldGroup|null
    {
        // TODO: Реализовать получение группы поля
    }

    public function getType(Field|int $field): string
    {
        // TODO: Реализовать получение типа поля
    }

    public function isRequired(Field|int $field): bool
    {
        // TODO: Реализовать проверка обязательности поля
    }

    public function isTranslatable(Field|int $field): bool
    {
        // TODO: Реализовать проверка флага переводимости поля
    }

    public function isSearchable(Field|int $field): bool
    {
        // TODO: Реализовать проверка флага поиска поля
    }

    public function getListVisibility(Field|int $field): bool
    {
        // TODO: Реализовать проверка видимости поля в списке
    }

    public function isActive(Field|int $field): bool
    {
        // TODO: Реализовать проверка активности поля
    }
}
