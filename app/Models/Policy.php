<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Policy extends Model
{

    protected $fillable = [
        'key',
        'version',
        'is_active'
    ];

    // Автоматическое увеличение версии при изменении переводов
    protected static function booted()
    {
        static::updating(function ($policy) {
            if ($policy->isDirty('is_active') === false) {
                // Если меняются поля кроме is_active, увеличиваем версию
                $policy->version++;
            }
        });
    }

    public function translations(): HasMany
    {
        return $this->hasMany(PolicyTranslation::class);
    }

    // Получаем перевод по текущей локали
    public function translation($locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        return $this->translations->firstWhere('locale', $locale);
    }

    public function acceptedUsers()
    {
        return $this->belongsToMany(User::class, 'accepted_policies')
            ->withPivot('accepted_at', 'version')
            ->withTimestamps();
    }
    public function acceptedByUsers()
    {
        return $this->belongsToMany(
            User::class,
            'policy_acceptances'
        )
            ->withPivot(['accepted_at', 'version'])
            ->withTimestamps();
    }
}
