<?php

namespace App\Http\Controllers\Admin\Setting\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\Site\UpdateRequest;
use App\Models\Setting;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request)
    {
        $data = $request->validated();


        Setting::set('site_name', $data['site_name']);
        Setting::set('site_description', $data['site_description']);
        Setting::set('site_keywords', $data['site_keywords']);
        // Обработка favicon
        if ($request->hasFile('site_favicon')) {
            $favicon = $request->file('site_favicon');

            // Путь к favicon в public/
            $path = public_path('favicon.ico');

            // Удаляем старую иконку, если есть
            if (file_exists($path)) {
                unlink($path);
            }

            // Сохраняем новую favicon
            $favicon->move(public_path(), 'favicon.ico');

            // Можно сохранить путь в настройку, если используется динамическая подгрузка
            Setting::set('site_favicon', '/favicon.ico');
        }
        return redirect()
            ->route('admin.setting.site.edit')
            ->with('success', __('admin/settings.updated'));
    }
}
