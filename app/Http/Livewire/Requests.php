<?php

namespace App\Http\Livewire;

use App\Models\Request;
use App\Models\User;
use Livewire\Component;

class Requests extends Component
{   
    public $requests;

    public function sendRequest($id, $status){
        $leaderId = auth()->id();
        $helpseekerId = $id;

        $status = $status === 1 ? 'accept' : 'reject';

        Request::where('leader_id', $leaderId)
            ->where('helpseeker_id', $helpseekerId)
            ->update(['status' => $status ]);
    }

    public function render()
    {   
        $this->requests = auth()->user()->helpseekers->where('status', 'pending');
        return view('livewire.requests');
    }
}
