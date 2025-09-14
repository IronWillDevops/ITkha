<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FileInput extends Component
{
    /**
     * Create a new component instance.
     */
    public $name;
    public $label;
    public $class;

    public function __construct($name, $label , $class = '')
    {
        $this->name = $name;  // Назва поля (наприклад, 'main_image')
        $this->label = $label;  // Текст для лейблу
        $this->class = $class;  // Додаткові класи для стилізації
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.form.file-input');
    }
}
