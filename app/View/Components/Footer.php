<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Footer extends Component
{
    public $legalInformations;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($legalInformations)
    {
        $this->legalInformations = $legalInformations;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.footer');
    }
}
