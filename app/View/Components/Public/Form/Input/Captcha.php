<?php

namespace App\View\Components\Public\Form\Input;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Captcha extends Component
{
    /**
     * Create a new component instance.
     */
    public string $name;
    public string $text;
    public string $placeholder;

    public function __construct(string $name, string $text, string $placeholder = '')
    {
        $this->name = $name;
        $this->text = $text;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.public.form.input.captcha');
    }
}
