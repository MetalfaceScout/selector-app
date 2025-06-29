<?php

namespace App\View\Components;

use App\Models\LfstatsCenter;
use Illuminate\Support\Facades\Cache;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

use Session;

class CenterChooser extends Component
{
    /**
     * Create a new component instance.
     */

    public $centers;
    public $center_select;

    public function __construct()
    {
        // Cache all centers for a week
        $this->centers = Cache::remember('users', $seconds = 604800, function () {
            $c = LfstatsCenter::all();
            $c = $c->sortByDesc('ipl_id');
            return $c;
        });

        $this->center_select = Session::get("center_select_last", "");
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.center-chooser');
    }
}
