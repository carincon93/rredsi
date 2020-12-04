<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GuestHeader extends Component
{
    public $node;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($node)
    {
        $this->node = $node;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.guest-header');
    }
}
