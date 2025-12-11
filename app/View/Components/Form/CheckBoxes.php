<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CheckBoxes extends Component
{
    /**
     * Create a new component instance.
     */
    public $name;
    public $label;
    public $options;
    public $valueField;
    public $labelField;

    public $selected;

    public function __construct(
        $name,
        $label,
        $options = [],
        $valueField = 'id',
        $labelField = 'title',
        $selected = []
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->valueField = $valueField;
        $this->labelField = $labelField;
        $this->selected = is_array($selected) ? $selected : collect($selected)->toArray();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.check-boxes');
    }
}
