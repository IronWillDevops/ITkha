<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Password extends Component
{
    /**
     * Create a new component instance.
     */
    public $name;
    public $label;
    public $placeholder;
    public $icon;
    public $required;

    public $min;
    public $max;

    public function __construct($name, $label, $placeholder, $icon = "fas fa-solid fa-lock", $required = true, $min = 8, $max = 255)
    {
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->icon = $icon;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.password');
    }
}
