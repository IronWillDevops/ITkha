<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TableActions extends Component
{
    public string $type;
    public string $route;
    public ?string $method;
    public string $icon;
    public string $label;
    public string $variant;
    public bool $confirm;
    public ?string $confirmMessage;

    public function __construct(
        string $route,
        string $icon,
        string $label,
        string $type = 'link',
        string $variant = 'default',
        bool $confirm = false,
        ?string $method = null,
        ?string $confirmMessage = null
    ) {
        $this->type = $type;
        $this->route = $route;
        $this->method = $method;
        $this->icon = $icon;
        $this->label = $label;
        $this->variant = $variant;
        $this->confirm = $confirm;
        $this->confirmMessage = $confirmMessage ?? __('admin/common.messages.confirm_delete');
    }

    public function render(): View|Closure|string
    {
        return view('components.form.table-actions');
    }
}
