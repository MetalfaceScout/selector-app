<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Session;

class SelectorSubmit extends Component
{
    /**
     * Create a new component instance.
     */
    public $position_select;
    public $algorithm_select;

    public function __construct()
    {
        $this->position_select = Session::get("position_select_last", "");
        $this->algorithm_select = Session::get('algorithm_select_last', "");
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.selector-submit');
    }
}
