<?php

namespace App\Http\Controllers\Public\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\UserProfile\UpdateRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request, User $user)
    {
        try {
            $data = $request->validated();

            // Оновлення основної інформації користувача
            $user->fill([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
            ]);

            // Обробка аватара (необов’язкове поле)
            if ($request->hasFile('avatar')) {
                // Видалення попереднього, якщо є
                if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }

                // Збереження нового
                $avatarPath = $request->file('avatar')->store("avatars/{$user->id}", 'public');

                $user->avatar = $avatarPath;
            }

            $user->save();

            // Оновлення або створення профілю користувача
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

            return redirect()->back()->with('success', __('public/user.messages.update_profile_success'));
        } catch (Exception $ex) {
            return redirect()->back()->with('error', __('public/user.messages.unexpected_error'));
        }
    }
}
