<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DateTimeInput extends Component
{
    /**
     * Create a new component instance.
     */
    public $name;
    public $label;
    public $icon;
    public $value;
    public $placeholder;
    public $required;

    public function __construct(
        $name,
        $label,
        $icon = null,
        $value = '',
        $placeholder = null,
        $required = true,
    ) {

        $this->name = $name;
        $this->label = $label;
        $this->icon = $icon;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.form.date-time-input');
    }
}
