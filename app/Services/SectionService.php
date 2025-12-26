<?php

namespace App\Services;

use App\Models\Collection;
use App\Models\Section;

class SectionService
{
    public function __construct()
    {
    }

    public function create(array $data): Section
    {
        // TODO: Реализовать создание раздела
    }

    public function update(Section|int $section, array $data): Section
    {
        // TODO: Реализовать обновление раздела
    }

    public function delete(Section|int $section): bool
    {
        // TODO: Реализовать удаление раздела
    }

    public function restore(Section|int $section): Section
    {
        // TODO: Реализовать восстановление раздела
    }

    public function reorder(array $order): bool
    {
        // TODO: Реализовать изменение порядка разделов
    }

    public function getAll(array $filters = []): array
    {
        // TODO: Реализовать получение списка разделов
    }

    public function getById($id): Section
    {
        // TODO: Реализовать получение раздела по ID
    }

    public function getBySlug(int $collectionId, string $slug): Section
    {
        // TODO: Реализовать получение раздела по slug
    }

    public function getChildren(Section|int $section): array
    {
        // TODO: Реализовать получение дочерних разделов
    }

    public function getParent(Section|int $section): Section
    {
        // TODO: Реализовать получение родительского раздела
    }

    public function getCollection(Section|int $section): Collection
    {
        // TODO: Реализовать получение коллекции раздела
    }

    public function getEntries(Section|int $section, array $filter = []): array
    {
        // TODO: Реализовать получение записей раздела
    }

    public function isActive(Section|int $section): bool
    {
        // TODO: Реализовать проверка статуса раздела
    }

    public function isPublished(Section|int $section): bool
    {
        // TODO: Реализовать проверка статуса раздела
    }

    public function isHidden(Section|int $section): bool
    {
        // TODO: Реализовать проверка статуса раздела
    }

    public function isArchived(Section|int $section): bool
    {
        // TODO: Реализовать проверка статуса раздела
    }
}
