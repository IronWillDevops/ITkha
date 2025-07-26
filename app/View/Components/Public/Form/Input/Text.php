<?php

namespace App\View\Components\Public\Form\Input;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Text extends Component
{
    /**
     * Create a new component instance.
     */
    public $type;
    public $name;
    public $text;
    public $placeholder;
    public $icon;
    public $value;
    public $required;

    public function __construct($type, $name, $text, $placeholder, $icon, $value = "", $required = true)
    {
        $this->type = $type;
        $this->name = $name;
        $this->text = $text;
        $this->placeholder = $placeholder;
        $this->icon = $icon;
        $this->value = $value;
        $this->required = filter_var($required, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.public.form.input.text');
    }
}
