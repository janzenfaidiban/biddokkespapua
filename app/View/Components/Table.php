<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    /**
     * Create a new component instance.
     */
    // public $datas;

    // public function __construct($datas)
    // {
    //     $this->datas = $datas;
    // }

    /**
     * Get the view / contents that represent the component.
     */

     public $halaman;

     public function __construct($halaman = null)
     {
         $this->halaman = $halaman;
     }


    public function render(): View|Closure|string
    {
        return view('components.tables.table');
    }
}
