<?php

namespace App\Repositories\Interfaces;

use App\Models\Field;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface FieldRepositoryInterface
{
    public function create(array $data): ?Field;

    public function update(Field|int $field, array $data): ?Field;

    public function delete(Field|int $field): bool;

    public function restore(Field|int $field): ?Field;

    public function getAll(array $filters = []): array;

    public function getById(Field|int $field): ?Field;

    public function getByUuid(string $uuid): ?Field;

    public function getBySlug(string $slug): ?Field;

    public function paginate(int $perPage = 15, array $filters = []): LengthAwarePaginator;

    public function where(array $conditions): array;

    public function with(array $relations): array;
}
