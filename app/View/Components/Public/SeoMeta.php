<?php

namespace App\View\Components\Public;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SeoMeta extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $description;
    public $image;
    public $url;

    public function __construct(string $title, string $description = '', string $image = '', string $url = '')
    {
        $this->title = $title;
        $this->description = $description ?: setting('site_description');
        $this->image = $image;
        $this->url = $url ?: url()->current();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.public.seo-meta');
    }
}
