<?php

namespace App\Services;

use App\Models\Media;

class MediaService
{
    public function __construct()
    {
    }

    public function create(array $data): Media|null
    {
        // TODO: Реализовать создание медиафайла
    }

    public function update(Media|int $media, array $data): Media|null
    {
        // TODO: Реализовать обновление медиафайла
    }

    public function delete(Media|int $media): bool
    {
        // TODO: Реализовать удаление медиафайла
    }

    public function restore(Media|int $media): Media|null
    {
        // TODO: Реализовать восстановление медиафайла
    }

    public function upload($file, ?string $path = null): Media|null
    {
        // TODO: Реализовать загрузка медиафайла
    }

    public function transform(Media|int $media, array $preset): Media|null
    {
        // TODO: Реализовать создание трансформации медиафайла
    }

    public function getAll(array $filters = []): array
    {
        // TODO: Реализовать получение списка медиафайлов
    }

    public function getById(int $id): Media|null
    {
        // TODO: Реализовать получение медиафайла по ID
    }

    public function getByUuid(string $uuid): Media|null
    {
        // TODO: Реализовать получение медиафайла по UUID
    }

    public function getFullPath(Media|int $media): string
    {
        // TODO: Реализовать получение полного пути к медиафайлу
    }

    public function getTransformedPath(Media|int $media, array $preset): string
    {
        // TODO: Реализовать получение пути к трансформированному медиафайлу
    }

    public function isActive(Media|int $media): bool
    {
        // TODO: Реализовать проверка активности медиафайла
    }
}
