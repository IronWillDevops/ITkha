<?php

namespace App\View\Components\Admin\Form;

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
    public $readonly;
    public $min;
    public $max;

    public function __construct(
        $name,
        $label,
        $type = 'text',
        $value = '',
        $icon = null,
        $placeholder = null,
        $required = true,
        $readonly = false,
        $min = null,
        $max = null
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->value = $value;
        $this->icon = $icon;
        $this->placeholder = $placeholder;
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
        return view('components.admin.form.input');
    }
}
