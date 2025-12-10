<?php

namespace App\View\Components\Public;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SeoMeta extends Component
{

    public string $type;
    public string $title;
    public string $description;
    public string $image;
    public string $url;
    public array $extra = [];

    public function __construct(
        string $type,
        string $title,
        string $description,
        string $image,
        string $url,
        array $extra = []
    ) {
        $this->type = $type;
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->url = $url;
        $this->extra = $extra;
    }

    public function toArray(): array
    {
        return [
            'type'        => $this->type,
            'title'       => $this->title,
            'description' => $this->description,
            'image'       => $this->image,
            'url'         => $this->url,
            'extra'       => $this->extra,
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.public.seo-meta');
    }
}
