<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


trait HasSlug
{
    /**
     * Boot trait
     */
    public static function bootHasSlug(): void
    {
        static::creating(function (Model $model) {
            $model->generateSlugIfNeeded();
        });

        static::updating(function (Model $model) {
            $sourceField = $model->getSlugSourceField();
            $shouldUpdate = property_exists($model, 'slugShouldUpdate') ? $model->slugShouldUpdate : false;

            if ($shouldUpdate && $model->isDirty($sourceField)) {
                $model->generateSlugIfNeeded(true);
            }
        });
    }

    /**
     * Генерация slug, если его нет или форсировано
     */
    public function generateSlugIfNeeded(bool $force = false): void
    {
        $slugColumn = $this->getSlugColumn();
        $sourceField = $this->getSlugSourceField();

        if (!isset($this->{$sourceField})) {
            return;
        }

        if (!empty($this->{$slugColumn}) && !$force) {
            return;
        }

        $base = (string)$this->{$sourceField};
        $slug = $this->makeSlug($base);
        $this->{$slugColumn} = $this->makeUniqueSlug($slug);
    }

    /**
     * Преобразование строки в slug
     */
    protected function makeSlug(string $value): string
    {
        $slug = Str::slug($value);
        return $slug ?: Str::uuid()->toString();
    }

    /**
     * Проверка уникальности и добавление суффикса
     */
    protected function makeUniqueSlug(string $slug): string
    {
        $original = $slug;
        $i = 2;
        $slugColumn = $this->getSlugColumn();
        $table = $this->getTable();
        $excludeId = $this->exists ? $this->getKey() : null;
        $keyName = $this->getKeyName();

        while ($this->slugExistsInDatabase($table, $slugColumn, $slug, $excludeId, $keyName)) {
            $slug = $original . '-' . $i;
            $i++;
        }

        return $slug;
    }

    protected function slugExistsInDatabase(string $table, string $slugColumn, string $slug, $excludeId = null, string $keyName = 'id'): bool
    {
        $query = DB::table($table)->where($slugColumn, $slug);
        if ($excludeId !== null) {
            $query->where($keyName, '<>', $excludeId);
        }

        if (method_exists($this, 'getDeletedAtColumn')) {
            $deletedAt = $this->getDeletedAtColumn();
            if ($deletedAt) {
                $query->whereNull($deletedAt);
            }
        }

        return $query->exists();
    }

    /**
     * Имя поля, из которого генерируем slug
     */
    protected function getSlugSourceField(): string
    {
        return property_exists($this, 'slugSource') ? $this->slugSource : 'title';
    }

    /**
     * Имя колонки для slug
     */
    protected function getSlugColumn(): string
    {
        return property_exists($this, 'slugColumn') ? $this->slugColumn : 'slug';
    }

    /**
     * Route model binding по slug
     */
    public function getRouteKeyName(): string
    {
        return $this->getSlugColumn();
    }
}

