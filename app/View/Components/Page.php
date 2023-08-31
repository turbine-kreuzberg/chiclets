<?php

namespace App\View\Components;

use App\Models\Navigation;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Page extends Component
{
    public function __construct(private readonly Navigation $navigation)
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.page', [
            'navigation' => $this->navigation,
        ]);
    }
}
