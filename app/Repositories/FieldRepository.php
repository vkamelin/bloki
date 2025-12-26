<?php

namespace App\Repositories;

use App\Models\Field;
use App\Models\FieldGroup;
use App\Repositories\Interfaces\FieldRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FieldRepository implements FieldRepositoryInterface
{

    /**
     * @param array $data
     * @return Field|null
     */
    public function create(array $data): ?Field
    {
        // TODO: Реализовать метод create()
    }

    /**
     * @param Field|int $field
     * @param array $data
     * @return Field|null
     */
    public function update(Field|int $field, array $data): ?Field
    {
        // TODO: Реализовать метод update()
    }

    /**
     * @param Field|int $field
     * @return bool
     */
    public function delete(Field|int $field): bool
    {
        // TODO: Реализовать метод delete()
    }

    /**
     * @param Field|int $field
     * @return Field|null
     */
    public function restore(Field|int $field): ?Field
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
     * @param Field|int $field
     * @return Field|null
     */
    public function getById(Field|int $field): ?Field
    {
        // TODO: Реализовать метод getById()
    }

    /**
     * @param string $uuid
     * @return Field|null
     */
    public function getByUuid(string $uuid): ?Field
    {
        // TODO: Реализовать метод getByUuid()
    }

    /**
     * @param string $slug
     * @return Field|null
     */
    public function getBySlug(string $slug): ?Field
    {
        // TODO: Реализовать метод getBySlug()
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
     * @param Field|int $field
     * @param FieldGroup|int $group
     * @return bool
     */
    public function updateGroup(Field|int $field, FieldGroup|int $group): bool
    {
        // TODO: Реализовать метод updateGroup()
    }

    /**
     * @param FieldGroup|int $group
     * @return array
     */
    public function getByGroup(FieldGroup|int $group): array
    {
        // TODO: Реализовать метод getByGroup()
    }

    /**
     * @param Field|int $field
     * @param string $type
     * @return bool
     */
    public function updateType(Field|int $field, string $type): bool
    {
        // TODO: Реализовать метод updateType()
    }

    /**
     * @param string $type
     * @return array
     */
    public function getByType(string $type): array
    {
        // TODO: Реализовать метод getByType()
    }

    /**
     * @param Field|int $field
     * @param array $settings
     * @return bool
     */
    public function updateSettings(Field|int $field, array $settings): bool
    {
        // TODO: Реализовать метод updateSettings()
    }

    /**
     * @param Field|int $field
     * @return array|null
     */
    public function getSettings(Field|int $field): ?array
    {
        // TODO: Реализовать метод getSettings()
    }

    /**
     * @param Field|int $field
     * @param array $validationRules
     * @return bool
     */
    public function updateValidationRules(Field|int $field, array $validationRules): bool
    {
        // TODO: Реализовать метод updateValidationRules()
    }

    /**
     * @param Field|int $field
     * @return array|null
     */
    public function getValidationRules(Field|int $field): ?array
    {
        // TODO: Реализовать метод getValidationRules()
    }

    /**
     * @param Field|int $field
     * @param array $flags
     * @return bool
     */
    public function updateFlags(Field|int $field, array $flags): bool
    {
        // TODO: Реализовать метод updateFlags()
    }

    /**
     * @param Field|int $field
     * @param string $flag
     * @param bool $value
     * @return bool
     */
    public function setFlag(Field|int $field, string $flag, bool $value): bool
    {
        // TODO: Реализовать метод setFlag()
    }

    /**
     * @param string $flag
     * @param bool $value
     * @return array
     */
    public function getByFlag(string $flag, bool $value): array
    {
        // TODO: Реализовать метод getByFlag()
    }
}
