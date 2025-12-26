<?php

namespace App\Repositories\Interfaces;

use App\Models\FieldGroup;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface FieldGroupRepositoryInterface
{
    public function create(array $data): ?FieldGroup;

    public function update(FieldGroup|int $fieldGroup, array $data): ?FieldGroup;

    public function delete(FieldGroup|int $fieldGroup): bool;

    public function restore(FieldGroup|int $fieldGroup): ?FieldGroup;

    public function getAll(array $filters = []): array;

    public function getById(FieldGroup|int $fieldGroup): ?FieldGroup;

    public function getByUuid(string $uuid): ?FieldGroup;

    public function paginate(int $perPage = 15, array $filters = []): LengthAwarePaginator;

    public function where(array $conditions): array;

    public function with(array $relations): array;
}
