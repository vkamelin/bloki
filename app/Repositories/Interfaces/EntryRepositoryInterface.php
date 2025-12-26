<?php

namespace App\Repositories\Interfaces;

use App\Models\Entry;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface EntryRepositoryInterface
{
    public function create(array $data): ?Entry;

    public function update(int $id, array $data): ?Entry;

    public function delete(int $id): bool;

    public function restore(int $id): ?Entry;

    public function getAll(array $filters = []): array;

    public function getById(int $id): ?Entry;

    public function getBySlug(string $slug): ?Entry;

    public function paginate(int $perPage = 15, array $filters = []): LengthAwarePaginator;

    public function where(array $conditions): array;

    public function with(array $relations): array;
}
