<?php

namespace App\Services\Public\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class UserService
{
    public function update(User $user, array $data): void
    {
        $user->fill([
            'name' => $data['name'],
            'surname' => $data['surname'],
        ]);

        if (isset($data['avatar']) && $data['avatar'] instanceof UploadedFile) {
            $this->handleAvatar($user, $data['avatar']);
        }

        $user->save();

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'job_title' => $data['job_title'] ?? null,
                'address' => $data['address'] ?? null,
                'about_myself' => $data['about_myself'] ?? null,
                'github' => $data['github'] ?? null,
                'linkedin' => $data['linkedin'] ?? null,
                'website' => $data['website'] ?? null,
            ]
        );
    }

    protected function handleAvatar(User $user, UploadedFile $file): void
    {
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $avatarPath = $file->store("avatars/{$user->id}", 'public');
        $user->avatar = $avatarPath;
    }
    public function updatePassword(User $user, string $newPassword)
    {
        $user->update([
            'password' => Hash::make($newPassword),
        ]);
    }
    public function ensureProfileExists(User $user): void
    {
        $user->loadMissing('profile');

        if (!$user->profile) {
            $user->profile()->create();
        }
    }
}
