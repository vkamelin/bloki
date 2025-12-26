<?php

namespace App\Repositories\Interfaces;

use App\Models\Entry;
use App\Models\Field;
use App\Models\FieldValue;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface FieldValueRepositoryInterface
{
    public function create(array $data): ?FieldValue;

    public function update(FieldValue|int $fieldValue, array $data): ?FieldValue;

    public function delete(FieldValue|int $fieldValue): bool;

    public function restore(FieldValue|int $fieldValue): ?FieldValue;

    public function getAll(array $filters = []): array;

    public function getById(FieldValue|int $fieldValue): ?FieldValue;

    public function getByFieldAndEntry(Field|int $field, Entry|int $entry): ?FieldValue;

    public function paginate(int $perPage = 15, array $filters = []): LengthAwarePaginator;

    public function where(array $conditions): array;

    public function with(array $relations): array;
}
