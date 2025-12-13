<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TableActions extends Component
{
    /**
     * Create a new component instance.
     */
    public $type;
    public $route;
    public $method;
    public $icon;
    public $label;

    public function __construct($route, $icon, $label, $type = 'link', $method = null)
    {
        $this->type = $type;
        $this->route = $route;
        $this->method = $method ?? 'POST';
        $this->icon = $icon;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.table-actions');
    }
}
