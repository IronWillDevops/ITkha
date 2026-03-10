<?php

namespace App\Models;

use App\Enums\CommentStatus;
use App\Models\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory,
        SoftDeletes,
        LogsActivity;

    protected $fillable = ['post_id', 'user_id', 'parent_id', 'body',  'status',];


    protected $casts = [
        'status' => CommentStatus::class,

    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id')->with('children');
    }
    // Scope: показываем approved + те что имеют детей (любой статус)
    public function scopeApproved(Builder $query): Builder
    {
        return $query->withTrashed()->where(function ($q) {
            $q->where('status', CommentStatus::APPROVED)
                ->orWhereHas('children');
        });
    }

    // ─── Хелперы ─────────────────────────────────────────────────

    /**
     * Комментарий отображается полностью только если он approved и не удалён
     */
    public function isVisible(): bool
    {
        return !$this->trashed() && $this->status === CommentStatus::APPROVED;
    }

    /**
     * Мягкое удаление с учётом дочерних комментариев
     */
    public function softDeleteWithChildren(): void
    {
        $hasActiveChildren = $this->children()
            ->whereNull('deleted_at')
            ->exists();

        if ($hasActiveChildren) {
            // Есть живые дочерние — очищаем данные, но оставляем запись как заглушку
            $this->update([
                'body'    => null,
                'user_id' => null,
            ]);
            $this->delete(); // ставит deleted_at
        } else {
            // Нет дочерних — просто soft delete
            $this->delete();

            // Проверяем родителя: если он тоже не visible и детей у него больше нет — чистим
            if ($this->parent_id) {
                $parent = Comment::withTrashed()->find($this->parent_id);

                if (
                    $parent &&
                    !$parent->isVisible() &&
                    $parent->children()->withTrashed()->doesntExist()
                ) {
                    $parent->forceDelete();
                }
            }
        }
    }
}
