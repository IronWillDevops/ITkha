<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    /**
     * Create a new component instance.
     */
    public $href;
    public $label;
    public $class;

    public function __construct($href, $label = '', $class = '')
    {
        $this->href = $href;  // URL для посилання
        $this->label = $label;  // Текст на кнопці
        $this->class = $class;  // Додаткові класи для стилізації
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.button');
    }
}
