<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Checkbox extends Component
{
    /**
     * Create a new component instance.
     */
    public $name;
    public $label;
    public $value;
    public $checked;

    public function __construct($name, $label, $value = '1', $checked = false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->checked = $checked;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.form.checkbox');
    }
}
