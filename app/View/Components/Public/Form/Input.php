<?php

namespace App\View\Components\Public\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     */
    public $name;
    public $label;
    public $type;
    public $value;
    public $icon;
    public $placeholder;
    public $required;

    public function __construct($name, $label=null, $type = 'text', $value = '', $icon = null, $placeholder = null, $required = true)
    {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->value = $value;
        $this->icon = $icon;
        $this->placeholder = $placeholder;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.public.form.input');
    }
}
