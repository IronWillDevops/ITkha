<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Submit extends Component
{
    /**
     * Create a new component instance.
     */
    public $label;
    public $class;

    public function __construct($label = '', $class = '')
    {
        $this->label = $label;  // Текст кнопки
        $this->class = $class;  // Дополнительні класи для стилізації
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.form.submit');
    }
}
