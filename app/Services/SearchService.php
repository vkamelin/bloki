<?php

namespace App\Services;

use App\Models\Entry;

class SearchService
{
    public function __construct()
    {
    }

    public function index(Entry|int $entry, array $data): Entry|null
    {
        // TODO: Реализовать индексация сущности
    }

    public function delete(Entry|int $entry): bool
    {
        // TODO: Реализовать удаление сущности из индекса
    }

    public function search(array $filters = []): array
    {
        // TODO: Реализовать поиск по индексу
    }

    public function reindex(string $entryType): bool
    {
        // TODO: Реализовать переиндексация всех сущностей типа
    }

    public function getAll(array $filters = []): array
    {
        // TODO: Реализовать получение списка индексированных сущностей
    }

    public function getById(int $id): Entry|null
    {
        // TODO: Реализовать получение индексированной сущности по ID
    }
}
