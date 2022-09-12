<?php

namespace App\View\Components\TableRuangKerja;

use Illuminate\View\Component;

class V2 extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $collection;
    public $header;
    public $content;
    public $dashboardId;

    public function __construct($collection, $header, $content, $dashboardId)
    {
        $this->collection = $collection;
        $this->header = $header;
        $this->content = $content;
        $this->dashboardId = $dashboardId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table-ruang-kerja.v2');
    }
}
