<?php

namespace App\Repositories\Interfaces;

use App\Models\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CollectionRepositoryInterface
{
    public function create(array $data): ?Collection;

    public function update(int $id, array $data): ?Collection;

    public function delete(int $id): bool;

    public function restore(int $id): ?Collection;

    public function getAll(array $filters = []): array;

    public function getById(int $id): ?Collection;

    public function getBySlug(string $slug): ?Collection;

    public function paginate(int $perPage = 15, array $filters = []): LengthAwarePaginator;

    public function where(array $conditions): array;

    public function with(array $relations): array;

    public function duplicate(int $id): ?Collection;

    public function getSingleton(string $handle): ?Collection;

    public function isSingleton(int|Collection $collection): bool;

    public function hasSections(int|Collection $collection): bool;

    public function getSectionStructure(int|Collection $collection): array;

    public function getDefaultTemplateSection(int|Collection $collection): ?string;

    public function getDefaultTemplateEntry(int|Collection $collection): ?string;
}
