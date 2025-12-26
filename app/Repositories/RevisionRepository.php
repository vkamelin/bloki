<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Models\Entry;
use App\Models\Field;
use App\Models\FieldValue;
use App\Models\Revision;
use App\Repositories\Interfaces\RevisionRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class RevisionRepository implements RevisionRepositoryInterface
{

    /**
     * @param array $data
     * @return FieldValue|null
     */
    public function create(array $data): ?Revision
    {
        // TODO: Реализовать метод create()
    }

    /**
     * @param Revision|int $revision
     * @param array $data
     * @return FieldValue|null
     */
    public function update(Revision|int $revision, array $data): ?Revision
    {
        // TODO: Реализовать метод update()
    }

    /**
     * @param Revision|int $revision
     * @return bool
     */
    public function delete(Revision|int $revision): bool
    {
        // TODO: Реализовать метод delete()
    }

    /**
     * @param Revision|int $revision
     * @return FieldValue|null
     */
    public function restore(Revision|int $revision): ?Revision
    {
        // TODO: Реализовать метод restore()
    }

    /**
     * @param array $filters
     * @return array
     */
    public function getAll(array $filters = []): array
    {
        // TODO: Реализовать метод getAll()
    }

    /**
     * @param Revision|int $revision
     * @return FieldValue|null
     */
    public function getById(Revision|int $revision): ?Revision
    {
        // TODO: Реализовать метод getById()
    }

    /**
     * @param int $perPage
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        // TODO: Реализовать метод paginate()
    }

    /**
     * @param array $conditions
     * @return array
     */
    public function where(array $conditions): array
    {
        // TODO: Реализовать метод where()
    }

    /**
     * @param array $relations
     * @return array
     */
    public function with(array $relations): array
    {
        // TODO: Реализовать метод with()
    }

    /**
     * @param Entry|int $entry
     * @return Revision
     */
    public function getByEntry(int|Entry $entry): Revision
    {
        // TODO: Implement getByEntry() method.
    }

    // Методы для работы с данными ревизии
    public function getData(Revision|int $revision)
    {
        // TODO: Получить данные ревизии по ID
    }

    public function saveData(Revision|int $revision, array $data)
    {
        // TODO: Сохранить данные в ревизию
    }

    // Методы для работы с сущностью ревизии
    public function getEntity(Revision|int $revision)
    {
        // TODO: Получить сущность, к которой относится ревизия
    }

    public function setEntry(Revision|int $revision, string $entityType, Entry|int $entity)
    {
        // TODO: Установить сущность для ревизии
    }

    // Методы для работы с пользователем ревизии
    public function getAdmin(Revision|int $revision)
    {
        // TODO: Получить пользователя, создавшего ревизию
    }

    public function setAdmin(Revision|int $revision, Admin|int $admin)
    {
        // TODO: Установить пользователя для ревизии
    }

    // Методы для работы с заметками ревизии
    public function getNote(Revision|int $revision)
    {
        // TODO: Получить заметку ревизии
    }

    public function setNote(Revision|int $revision, string $note)
    {
        // TODO: Установить заметку для ревизии
    }
}
