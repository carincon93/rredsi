<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ModelForm extends Component
{
    public $modalFormVisible = false;
    public $slug;
    public $title;
    public $content;

    public function createShowModal()
    {
        $this->modalFormVisible = true;

    }

    public function render()
    {
        return view('livewire.model-form');
    }
}
