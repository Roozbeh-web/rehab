<?php

namespace App\Http\Livewire;

use App\Models\Request;
use App\Models\User;
use Livewire\Component;

class Leaders extends Component
{
    public $leaders;
    public $leaderId;

    public function sendRequest($leaderId){
        Request::create([
            'helpseeker_id' => auth()->id(),
            'leader_id' => $leaderId,
            'status' => 'pending',
        ]);

        dd('done');
    }

    public function render()
    {   
        $province = auth()->user()->province;
        $this->leaders = User::where('type', 'leader')->where('province', $province)->get();
        return view('livewire.leaders');
    }
}
