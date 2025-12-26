<?php

namespace App\Repositories\Interfaces;

interface CollectionRepositoryInterface
{
    public function create(array $data);

    public function update(int $id, array $data);

    public function delete(int $id);

    public function restore(int $id);

    public function getAll(array $filters = []);

    public function getById(int $id);

    public function getBySlug(string $slug);

    public function paginate(int $perPage = 15);

    public function where(array $conditions);

    public function with(array $relations);
}
