<?php

namespace App\Repositories\Interfaces;

use App\Models\Entry;
use App\Models\Revision;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface RevisionRepositoryInterface
{
    public function create(array $data): ?Revision;

    public function update(int $id, array $data): ?Revision;

    public function getAll(array $filters = []): array;

    public function getById(int $id): ?Revision;

    public function getByEntry(Entry|int $entry): Revision;

    public function paginate(int $perPage = 15, array $filters = []): LengthAwarePaginator;

    public function where(array $conditions): array;

    public function with(array $relations): array;
}
