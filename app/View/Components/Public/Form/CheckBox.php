<?php

namespace App\View\Components\Public\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CheckBox extends Component
{
    /**
     * Create a new component instance.
     */
    public $name;
    public $label;
    public $required;
    public $value;
    public $checked;

    public function __construct($name, $label, $required = false, $value = 1, $checked = false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->required = filter_var($required, FILTER_VALIDATE_BOOL);
        $this->value = $value;
        $this->checked = filter_var($checked, FILTER_VALIDATE_BOOL);
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.public.form.check-box');
    }
}
