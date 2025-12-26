<?php

namespace App\Services;

use App\Models\Collection;
use App\Models\Entry;

class EntryService
{
    public function __construct()
    {
    }

    public function create(array $data): Entry|null
    {
        // TODO: Реализовать создание записи
    }

    public function update(Entry|int $entry, array $data): Entry|null
    {
        // TODO: Реализовать обновление записи
    }

    public function delete(Entry|int $entry): bool
    {
        // TODO: Реализовать удаление записи
    }

    public function restore(Entry|int $entry): Entry|null
    {
        // TODO: Реализовать восстановление записи
    }

    public function publish(Entry|int $entry): Entry|null
    {
        // TODO: Реализовать публикация записи
    }

    public function unpublish(Entry|int $entry): Entry|null
    {
        // TODO: Реализовать снятие с публикации записи
    }

    public function getAll(array $filters = []): array
    {
        // TODO: Реализовать получение списка записей
    }

    public function getById(int $id): Entry|null
    {
        // TODO: Реализовать получение записи по ID
    }

    public function getBySlug(string $slug): Entry|null
    {
        // TODO: Реализовать получение записи по slug
    }

    public function getCollection(Entry|int $entry): Collection|null
    {
        // TODO: Реализовать получение коллекции записи
    }

    public function getFieldValue(Entry|int $entry, int|string $field): mixed
    {
        // TODO: Реализовать получение значения поля записи
    }

    public function setFieldValue(Entry|int $entry, int|string $field, mixed $value): bool
    {
        // TODO: Реализовать установка значения поля записи
    }

    public function isActive(Entry|int $entry): bool
    {
        // TODO: Реализовать проверка активности записи
    }

    public function isDraft(Entry|int $entry): bool
    {
        // TODO: Реализовать проверка статуса записи
    }

    public function isPublished(Entry|int $entry): bool
    {
        // TODO: Реализовать проверка статуса записи
    }

    public function isReview(Entry|int $entry): bool
    {
        // TODO: Реализовать проверка статуса записи
    }

    public function isArchived(Entry|int $entry): bool
    {
        // TODO: Реализовать проверка статуса записи
    }
}
