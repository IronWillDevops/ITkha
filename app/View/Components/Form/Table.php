<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    public function __construct(
        public array $columns = [],
        public $items = null,
        public string $modelRoute = '',
        public string $sortField = 'id',
        public string $sortDirection = 'asc',
        public bool $searchEnabled = false,
        public bool $showView = true,
        public bool $showEdit=true,
        public bool $showDelete=true
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.table');
    }
}
