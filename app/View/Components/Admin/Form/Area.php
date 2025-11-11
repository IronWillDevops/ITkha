<?php

namespace App\View\Components\Admin\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Area extends Component
{
    /**
     * Create a new component instance.
     */
    public $name;
    public $label;
    public $placeholder;
    public $value;
    public $required;
    public $readonly;
    public $maxCharactersLenght;
    public $minCharactersLenght;

    public function __construct($name, $label, $placeholder, $value = "", $required = true, $readonly = false, $minCharactersLenght = 20, $maxCharactersLenght = 1000)
    {

        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->value = $value;

        $this->required = filter_var($required, FILTER_VALIDATE_BOOLEAN);
        $this->readonly = $readonly;

        $this->minCharactersLenght = $minCharactersLenght;
        $this->maxCharactersLenght = $maxCharactersLenght;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.form.area');
    }
}
