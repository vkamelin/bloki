<?php

namespace App\Services;

use App\Models\FieldGroup;

class FieldGroupService
{
    public function __construct()
    {
    }

    public function create(array $data): FieldGroup|null
    {
        // TODO: Реализовать создание группы полей
    }

    public function update(FieldGroup|int $fieldGroup, array $data): FieldGroup|null
    {
        // TODO: Реализовать обновление группы полей
    }

    public function delete(FieldGroup|int $fieldGroup): FieldGroup|null
    {
        // TODO: Реализовать удаление группы полей
    }

    public function restore(FieldGroup|int $fieldGroup): FieldGroup|null
    {
        // TODO: Реализовать восстановление группы полей
    }

    public function getAll(array $filters = []): array
    {
        // TODO: Реализовать получение списка групп полей
    }

    public function getById(int $id): FieldGroup|null
    {
        // TODO: Реализовать получение группы полей по ID
    }

    public function getFields(FieldGroup|int $fieldGroup): array
    {
        // TODO: Реализовать получение полей группы
    }

    public function isGlobal(FieldGroup|int $fieldGroup): bool
    {
        // TODO: Реализовать проверка флага глобальности группы
    }

    public function isActive(FieldGroup|int $fieldGroup): bool
    {
        // TODO: Реализовать проверка активности группы
    }
}
