<?php

namespace App\Repositories\Interfaces;

use App\Models\Section;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface SectionRepositoryInterface
{
    public function create(array $data): ?Section;

    public function update(Section|int $section, array $data): ?Section;

    public function delete(Section|int $section): bool;

    public function restore(Section|int $section): ?Section;

    public function getAll(array $filters = []): array;

    public function getById(Section|int $section): ?Section;

    public function getBySlug(string $slug): ?Section;

    public function paginate(int $perPage = 15, array $filters = []): LengthAwarePaginator;

    public function where(array $conditions): array;

    public function with(array $relations): array;
}
