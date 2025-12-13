<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     */
    public $type;
    public $name;
    public $label;
    public $placeholder;
    public $value;
    public $icon;
    public $required;
    public $readonly;

    public $min;
    public $max;

    public function __construct($name, $label, $placeholder = null, $type = "text",  $value = null, $icon = null, $required = true, $readonly = false, $min = 0, $max = 255)
    {
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->type = $type;
        $this->value = $value;
        $this->icon = $icon;
        $this->required = $required;
        $this->readonly = $readonly;
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.input');
    }
}
