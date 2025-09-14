<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Editor extends Component
{
    /**
     * Create a new component instance.
     */
    public $name;
    public $label;
    public $value;
    public $placeholder;

    public function __construct($name, $label,$placeholder, $value = '')
    {
        $this->name = $name;  
        $this->label = $label; 
        $this->placeholder=$placeholder;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.form.editor');
    }
}
