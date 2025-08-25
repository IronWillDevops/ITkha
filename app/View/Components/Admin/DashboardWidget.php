<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardWidget extends Component
{


    public string $title;
    public string $icon;
    public ?string $description;
    public string $link;
    public ?string $linkText;
    /**
     * Create a new component instance.
     */
    public function __construct(string $title, string $icon, ?string $description = null, string $link = '#', ?string $linkText = null)
    {
        $this->title = $title;
        $this->icon = $icon;
        $this->description = $description;
        $this->link = $link;
        $this->linkText = $linkText;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.dashboard-widget');
    }
}
