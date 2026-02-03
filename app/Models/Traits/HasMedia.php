<?php

namespace App\Models\Traits;

use App\Models\Media;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasMedia
{
    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function mediaByCollection(string $collection)
    {
        return $this->media()->where('collection', $collection);
    }

    public function singleMedia(string $collection): ?Media
    {
        return $this->mediaByCollection($collection)->first();
    }

    /**
     * Получить URL первого media из collection
     */
    public function firstMediaUrl(string $collection, ?string $default = null): ?string
    {
        return $this->firstMedia($collection)?->url ?? $default;
    }

    /**
     * Проверить наличие media в collection
     */
    public function hasMedia(string $collection): bool
    {
        return $this->media()
            ->where('collection', $collection)
            ->exists();
    }

    /**
     * Получить общий размер всех media модели
     */
    public function getTotalMediaSize(): int
    {
        return $this->media()->sum('size');
    }

    /**
     * Получить общий размер media в collection
     */
    public function getMediaSizeByCollection(string $collection): int
    {
        return $this->media()
            ->where('collection', $collection)
            ->sum('size');
    }
}
