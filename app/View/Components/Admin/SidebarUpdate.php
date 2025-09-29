<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class SidebarUpdate extends Component
{
    /**
     * Create a new component instance.
     */

    public $latestVersion;
    public $currentVersion;
    public $isUpdateAvailable;
    public $releaseUrl;

    public function __construct()
    {
        $this->currentVersion = config('app.version');

        // Кешируем весь релизный ответ, а не только версию
        $releaseData = Cache::remember('latest_release_data', 60000, function () {
            $response = Http::get('https://api.github.com/repos/IronWillDevops/ITkha/releases/latest');
            if ($response->ok()) {
                return $response->json();
            }
            return null;
        });

        // Если данные есть, извлекаем их
        if ($releaseData) {
            $this->latestVersion = $releaseData['tag_name'] ?? null;
            $this->releaseUrl = $releaseData['html_url'] ?? null;
        }

        $this->isUpdateAvailable = $this->latestVersion && version_compare($this->latestVersion, $this->currentVersion, '>');
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.sidebar-update');
    }
}
