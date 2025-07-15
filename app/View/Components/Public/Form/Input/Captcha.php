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

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.public.form.input.captcha');
    }
}
