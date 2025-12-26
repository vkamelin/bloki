<?php

namespace App\Repositories\Interfaces;

use App\Models\Entry;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface EntryRepositoryInterface
{
    public function create(array $data): ?Entry;

    public function update(Entry|int $entry, array $data): ?Entry;

    public function delete(Entry|int $entry): bool;

    public function restore(Entry|int $entry): ?Entry;

    public function getAll(array $filters = []): array;

    public function getById(Entry|int $entry): ?Entry;

    public function getBySlug(string $slug): ?Entry;

    public function paginate(int $perPage = 15, array $filters = []): LengthAwarePaginator;

    public function where(array $conditions): array;

    public function with(array $relations): array;
}
