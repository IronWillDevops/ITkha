<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Area extends Component
{
    /**
     * Create a new component instance.
     */
    public $name;
    public $label;
    public $placeholder;
    public $value;
    public $required;
    public $readonly;
    public $min;
    public $max;

    public function __construct($name, $label, $placeholder, $value = "", $required = true, $readonly = false,  $min = 20,$max = 1000,)
    {
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->value = $value;

        $this->required = filter_var($required, FILTER_VALIDATE_BOOLEAN);
        $this->readonly = $readonly;
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.area');
    }
}
