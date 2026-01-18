<?php

namespace App\Http\Controllers\Admin\Setting\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\Site\UpdateRequest;
use App\Models\Setting;
use Exception;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request)
    {
        try {
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
            }
            Setting::set('site_email', $data['site_email']);
            Setting::set('site_phone', $data['site_phone']);
            Setting::set('site_address', $data['site_address']);

            return redirect()
                ->route('admin.setting.site.edit')
                ->with('success', __('admin/common.messages.settings_saved'));
        } catch (Exception $ex) {
            
            logger()->error('Setting update failed', ['exception' => $ex]);
            return redirect()->back()->with('error', __('errors/setting.update.failed'));
        }
    }
}
