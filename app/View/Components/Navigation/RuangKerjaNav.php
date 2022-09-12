<?php

namespace App\View\Components\Navigation;

use Illuminate\View\Component;

class RuangKerjaNav extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $navId;

    public function __construct($navId)
    {
        $this->navId = $navId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.navigation.ruang-kerja-nav');
    }
}
