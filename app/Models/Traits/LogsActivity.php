<?php

namespace App\Models\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    /**
     * Какие события логировать
     */
    protected static array $logEvents = ['created', 'updated', 'deleted'];

    /**
     * Какие атрибуты НЕ логировать
     */
    protected array $excludeFromLog = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    /**
     * Boot trait
     */
    protected static function bootLogsActivity(): void
    {
        foreach (static::$logEvents as $event) {
            static::$event(function ($model) use ($event) {
                $model->createActivityLog($event);
            });
        }
    }

    /**
     * Создать запись в логе
     */
    protected function createActivityLog(string $event): void
    {
        // Игнорируем, если пользователь не авторизован (опционально)
        // if (!Auth::check()) return;

        $oldValues = null;
        $newValues = null;

        // Фильтруем атрибуты
        $attributes = $this->filterLogAttributes($this->getAttributes());
        $original = $this->filterLogAttributes($this->getOriginal());

        if ($event === 'created') {
            $newValues = $attributes;
        } elseif ($event === 'updated') {
            $oldValues = $original;
            $newValues = $attributes;
        } elseif ($event === 'deleted') {
            $oldValues = $original;
        }

        ActivityLog::create([
            'model_type' => get_class($this),
            'model_id' => $this->getKey(),
            'user_id' => Auth::id(),
            'action' => $event,
            'description' => $this->getLogDescription($event),
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => $this->getClientIp(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    /**
     * Получить описание действия
     */
    protected function getLogDescription(string $event): string
    {
        $modelName = $this->getLogModelName();
        $userEmail = Auth::check() ? Auth::user()->email : 'System';

        $descriptions = [
            'created' => "{$userEmail} created {$modelName}",
            'updated' => "{$userEmail} updated {$modelName}",
            'deleted' => "{$userEmail} deleted {$modelName}",
        ];

        return $descriptions[$event] ?? "{$userEmail} performed the {$event} action on {$modelName}";
    }

    /**
     * Получить человекочитаемое название модели
     */
    protected function getLogModelName(): string
    {
        $modelNames = [
            'Post' => 'post',
            'User' => 'user',
            'Category' => 'category',
            'Tag' => 'tag',
            'Role' => 'role',
            'Setting' => 'setting',
        ];

        $basename = class_basename($this);
        return $modelNames[$basename] ?? strtolower($basename);
    }

    /**
     * Фильтровать атрибуты (исключить чувствительные данные)
     */
    protected function filterLogAttributes(array $attributes): array
    {
        return collect($attributes)
            ->except($this->excludeFromLog)
            ->toArray();
    }

    /**
     * Получить все логи для этой модели
     */
    public function activityLogs()
    {
        return $this->morphMany(ActivityLog::class, 'model')->latest();
    }

    /**
     * Получить последний лог
     */
    public function lastActivity()
    {
        return $this->morphOne(ActivityLog::class, 'model')->latest();
    }

    protected function getClientIp(): string
    {
        $xff = request()->header('X-Forwarded-For');

        if ($xff) {
            return trim(explode(',', $xff)[0]);
        }

        return request()->ip();
    }
}
