<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Times extends Component
{
    /**
     * Create a new component instance.
     */

    public $created;
    public $updated;

    public function __construct($created, $updated)
    {
        $this->created = $created;
        $this->updated = $updated;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tables.times');
    }
}
