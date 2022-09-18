<?php

namespace App\Http\Livewire;

use App\Models\Request;
use App\Models\User;
use Livewire\Component;

class Requests extends Component
{   
    public $requests;

    public function render()
    {   
        $this->requests = auth()->user()->helpseekers->where('status', 'pending');
        return view('livewire.requests');
    }
}
