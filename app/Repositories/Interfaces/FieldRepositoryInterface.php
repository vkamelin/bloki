<?php

namespace App\Repositories\Interfaces;

use App\Models\Field;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface FieldRepositoryInterface
{
    public function create(array $data): ?Field;

    public function update(int $id, array $data): ?Field;

    public function delete(int $id): bool;

    public function restore(int $id): ?Field;

    public function getAll(array $filters = []): array;

    public function getById(int $id): ?Field;

    public function getByUuid(string $uuid): ?Field;

    public function getBySlug(string $slug): ?Field;

    public function paginate(int $perPage = 15, array $filters = []): LengthAwarePaginator;

    public function where(array $conditions): array;

    public function with(array $relations): array;
}
