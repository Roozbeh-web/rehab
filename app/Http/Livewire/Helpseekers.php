<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Helpseekers extends Component
{
    public $helpseekers;

    public function render()
    {
        $helpseekers = auth()->user()->helpseekers->where('status', 'accept');

        return view('livewire.helpseekers');
    }
}
