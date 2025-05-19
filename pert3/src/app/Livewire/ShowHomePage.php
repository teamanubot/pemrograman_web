<?php

namespace App\Livewire;

use App\Models\Footer;
use Livewire\Component;

class ShowHomePage extends Component
{

    public $footer;

    public function mount(){
        $this->footer = Footer::first();
    }

    public function render()
    {
        return view('livewire.show-home-page', ['footer' => $this->footer]);
    }
}