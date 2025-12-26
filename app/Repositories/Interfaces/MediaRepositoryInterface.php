<?php

namespace App\Repositories\Interfaces;

use App\Models\Media;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface MediaRepositoryInterface
{
    public function create(array $data): ?Media;

    public function update(Media|int $media, array $data): ?Media;

    public function delete(Media|int $media): bool;

    public function restore(Media|int $media): ?Media;

    public function getAll(array $filters = []): array;

    public function getById(Media|int $media): ?Media;

    public function getByUuid(string $uuid): ?Media;

    public function paginate(int $perPage = 15, array $filters = []): LengthAwarePaginator;

    public function where(array $conditions): array;

    public function with(array $relations): array;
}
