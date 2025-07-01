<?php

namespace App\Models;

use App\Exceptions\User\CannotDeactivateLastActiveUserException;
use App\Exceptions\User\CannotDeleteAdminUserException;
use App\Exceptions\User\CannotDeleteSelfException;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Notifications\VerifyEmailNotification;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */



    protected $fillable = [
        'name',
        'surname',
        'login',
        'email',
        'password',
        'is_active',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole(string $roleTitle): bool
    {
        return $this->roles()->where('title', $roleTitle)->exists();
    }

    public function hasPermission(string $permissionTitle): bool
    {
        return $this->roles()
            ->whereHas('permissions', function ($query) use ($permissionTitle) {
                $query->where('title', $permissionTitle);
            })->exists();
    }

    public function hasHeaderPermission(string $header): bool
    {
        return $this->roles()->whereHas('permissions', function ($query) use ($header) {
            $query->where('header', $header);
        })->exists();
    }

    public function hasAnyHeaderPermissions(array $headers): bool
    {
        return $this->roles()->whereHas('permissions', function ($query) use ($headers) {
            $query->whereIn('header', $headers);
        })->exists();
    }

    protected static function booted(): void
    {
        static::deleting(function (User $user) {
            if ($user->id === Auth::id()) {

                throw new CannotDeleteSelfException();
            }

            if ($user->id === 1) {
                throw new CannotDeleteAdminUserException();
            }
        });
        static::updating(function (User $user) {
            if ($user->isDirty('is_active') && $user->is_active == false) {
                $activeUsersCount = self::where('is_active', true)->count();

                if ($activeUsersCount <= 1) {
                    throw new CannotDeactivateLastActiveUserException();
                }
            }
        });
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function likedPosts()
    {
        return $this->belongsToMany(Post::class, 'likes')->withTimestamps();
    }

    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new VerifyEmailNotification($this));
    }
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }

}
