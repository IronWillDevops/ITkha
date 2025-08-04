<?php

namespace App\View\Components\Public\Form\Input;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Password extends Component
{
    /**
     * Create a new component instance.
     */

    public $name;
    public $text;
    public $placeholder;
    public $icon;
    public function __construct( $name, $text, $placeholder, $icon="fas fa-solid fa-lock")
    {
        $this->name = $name;
        $this->text = $text;
        $this->placeholder = $placeholder;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.public.form.input.password');
    }
}
