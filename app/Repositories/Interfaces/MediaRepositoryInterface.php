<?php

namespace App\Repositories\Interfaces;

use App\Models\Media;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface MediaRepositoryInterface
{
    public function create(array $data): ?Media;

    public function update(int $id, array $data): ?Media;

    public function delete(int $id): bool;

    public function restore(int $id): ?Media;

    public function getAll(array $filters = []): array;

    public function getById(int $id): ?Media;

    public function getByUuid(string $uuid): ?Media;

    public function paginate(int $perPage = 15, array $filters = []): LengthAwarePaginator;

    public function where(array $conditions): array;

    public function with(array $relations): array;
}
