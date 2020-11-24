<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DropDownAcademicProgram extends Component
{
    public $educationalInstitutions;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($educationalInstitutions)
    {
        $this->educationalInstitutions = $educationalInstitutions;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.drop-down-academic-program');
    }
}