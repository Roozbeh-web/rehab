<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Leaders extends Component
{
    public $leaders;

    public function render()
    {   
        $province = auth()->user()->province;
        $this->leaders = User::where('type', 'leader')->where('province', $province)->get();
        return view('livewire.leaders');
    }
}
