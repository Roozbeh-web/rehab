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

        Request::where('leader_id', $leaderId)
        ->where('helpseeker_id', $helpseekerId)
        ->update(['status' => $status ]);

        if($status === 'accept'){
            Request::where('helpseeker_id', $helpseekerId)
            ->where(function($query){
                $query->where('status', 'pending')
                ->orWhere('status', 'reject');
            })
            ->delete();
        }

        $this->requests = auth()->user()->helpseekers->where('status', 'pending');
    }

    public function render()
    {   
        $this->requests = auth()->user()->helpseekers->where('status', 'pending');
        return view('livewire.requests');
    }
}
