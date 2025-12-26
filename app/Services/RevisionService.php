<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\Entry;
use App\Models\Revision;

class RevisionService
{
    public function __construct()
    {
    }

    public function create(string $entryType, Entry|int $entry, array $data, Admin|int $admin, $note = null): Revision|null
    {
        // TODO: Реализовать создание ревизии
    }

    public function delete(Revision|int $revision): bool
    {
        // TODO: Реализовать удаление ревизии
    }

    public function restore(Revision|int $revision): Revision|null
    {
        // TODO: Реализовать восстановление ревизии
    }

    public function compare(Revision|int $revision1, Revision|int $revision2)
    {
        // TODO: Реализовать сравнение двух ревизий
    }

    public function getAll(array $filters = []): array
    {
        // TODO: Реализовать получение списка ревизий
    }

    public function getById(int $id): Revision|null
    {
        // TODO: Реализовать получение ревизии по ID
    }

    public function getByEntry(string $entryType, Entry|int $entry): array
    {
        // TODO: Реализовать получение ревизий сущности
    }

    public function getLatest(string $entryType, Entry|int $entry): Revision|null
    {
        // TODO: Реализовать получение последней ревизии сущности
    }
}
