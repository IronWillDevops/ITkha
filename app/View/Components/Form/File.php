<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class File extends Component
{
    /**
     * Create a new component instance.
     */
    public $name;
    public $label;
    public $icon;

    public $required;

    public function __construct($name, $label, $icon = "fa-solid fa-circle-user", $required = true)
    {
        $this->name = $name;  // Назва поля (наприклад, 'main_image')
        $this->label = $label;  // Текст для лейблу
        $this->icon = $icon;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.file');
    }
}
