<?php

namespace App\View\Components\TableLive;

use Illuminate\View\Component;

class V1 extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $dashboardId;
    public $header;
    public $content;

    public function __construct($dashboardId, $header, $content)
    {
        $this->dashboardId = $dashboardId;
        $this->header = $header;
        $this->content = $content;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table-live.v1');
    }
}
