<?php

namespace App\Observers;

use App\Models\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

abstract class BaseObserver
{
    protected function log(string $event, Model $model, ?array $changes = null): void
    {
         $ip = request()->header('X-Forwarded-For');
        if ($ip) {
            $ip = explode(',', $ip)[0]; // get first IP in the list
        } else {
            $ip = request()->ip();
        }
        Log::create([
            'model_type'  => get_class($model),
            'model_id'    => $model->getKey(),
            'event'       => $event,
            'changes'     => $changes,
            'description' => $this->generateDescription($event, $model),
            'user_email'  => (Auth::user())->email ?? "System",
            'ip_address'  => $ip,
            'user_agent'  => request()->header('User-Agent'),
            'created_at'  => now(),

        ]);
        $this->trimOldLogs();
    }

    protected function generateDescription(string $event, Model $model): string
    {
        $modelName = class_basename($model); // Наприклад, Post\
        $modelLabel = $this->resolveModelLabel($model); // Назва об'єкта (title, name тощо)


        return "{$modelName} \"{$modelLabel}\" was {$event}";
    }



    protected function trimOldLogs(int $maxLogs = 25)
    {
        $lastIdToKeep = Log::orderByDesc('id')->skip($maxLogs)->value('id');

        if ($lastIdToKeep) {
            Log::where('id', '<', $lastIdToKeep)->delete();
        }
    }


    protected function resolveModelLabel(Model $model): string
    {
        // Визначаємо для кожної моделі поле(я) для відображення
        $modelLabelFields = [
            \App\Models\Post::class     => ['title'],
            \App\Models\User::class     => ['email'],
            \App\Models\Category::class => ['title'],
            \App\Models\Tag::class      => ['title'],
            \App\Models\Role::class     => ['title'],
            \App\Models\Setting::class  => ['key'],
            // Додайте інші моделі за потреби
        ];

        $modelClass = get_class($model);

        if (isset($modelLabelFields[$modelClass])) {
            foreach ($modelLabelFields[$modelClass] as $field) {
                if (!empty($model->{$field})) {
                    return $model->{$field};
                }
            }
        }

        // Якщо поле не знайдено — повертаємо ID
        return 'ID ' . $model->getKey();
    }
    public function created(Model $model)
    {
        $this->log('created', $model);
    }
    public function updated(Model $model)
    {
        $this->log('updated', $model);
    }
    public function deleted(Model $model)
    {
        $this->log('deleted', $model);
    }
}
