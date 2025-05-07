<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Session;

class Modifiers extends Component
{
    /**
     * Create a new component instance.
     */
    public $modifiers;

    public function __construct()
    {
        $this->modifiers = Session::get("modifiers", []);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modifiers');
    }
}
