<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Create a new component instance.
     */
    public string $name;
    public string $label;
    public $options;
    public string $valueField;
    public string $labelField;
    public $selected;
    public bool $required;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $name,
        string $label,
        $options,
        string $valueField = 'id',
        string $labelField = 'title',
        $value = null,
        bool $required = true,
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->valueField = $valueField;
        $this->labelField = $labelField;
        $this->selected = $value ?? old($name);
        $this->required = $required;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.select');
    }
}
