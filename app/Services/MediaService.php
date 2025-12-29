<?php

namespace App\Services;

use App\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class MediaService
{
    public function upload(
        Model $model,
        UploadedFile $file,
        string $collection
    ): Media {
        $this->ensureLimitNotExceeded($model, $file);

        $disk = config('media.disk');

        $path = $file->store(
            $this->directory($model, $collection),
            $disk
        );

        [$width, $height] = @getimagesize($file->getRealPath()) ?: [null, null];

        return $model->media()->create([
            'collection'    => $collection,
            'disk'          => $disk,
            'path'          => $path,
            'original_name' => $file->getClientOriginalName(),
            'mime_type'     => $file->getMimeType(),
            'size'          => $file->getSize(),
            'width'         => $width,
            'height'        => $height,
        ]);
    }

    private function ensureLimitNotExceeded(
        Model $model,
        UploadedFile $file
    ): void {
        $used = Media::where('model_type', get_class($model))
            ->where('model_id', $model->getKey())
            ->sum('size');

        $limit = match (class_basename($model)) {
            'User' => config('media.limits.user'),
            'Post' => config('media.limits.post'),
            default => null,
        };

        if ($limit !== null && ($used + $file->getSize()) > $limit) {
            throw ValidationException::withMessages([
                'file' => 'Превышен лимит хранилища',
            ]);
        }
    }

    public function replaceSingle(
        Model $model,
        UploadedFile $file,
        string $collection
    ): Media {
        $model->mediaByCollection($collection)
            ->each(fn($media) => $this->delete($media));

        return $this->upload($model, $file, $collection);
    }

    public function delete(Media $media): void
    {
        Storage::disk($media->disk)->delete($media->path);
        $media->delete();
    }

    private function directory(Model $model, string $collection): string
    {
        return strtolower(class_basename($model))
            . '/' . $model->getKey()
            . '/' . $collection;
    }
}
