<?php

namespace App\Http\Livewire;

use App\Models\Request;
use App\Models\User;
use Livewire\Component;

class Leaders extends Component
{
    public $leaders;
    public $leaderId;
    public $requests;

    public function sendRequest($leaderId){
        Request::create([
            'helpseeker_id' => auth()->id(),
            'leader_id' => $leaderId,
            'status' => 'pending',
        ]);
    }

    public function cancelRequest($leaderId){
        Request::where('leader_id', $leaderId)->where('helpseeker_id', auth()->id())->delete();
    }

    public function render()
    {   
        $province = auth()->user()->province;
        $this->leaders = User::where('type', 'leader')->where('province', $province)->get();
        $this->requests = Request::where('helpseeker_id', auth()->id())->get();
        return view('livewire.leaders');
    }
}
