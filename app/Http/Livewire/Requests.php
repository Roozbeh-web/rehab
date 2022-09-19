<?php

namespace App\Http\Livewire;

use App\Http\Resources\HelpseekerResource;
use App\Models\Request;
use App\Models\User;
use Livewire\Component;

class Requests extends Component
{   
    public $helpseekers;

    public function sendRequest($id, $status){
        $leaderId = auth()->id();
        $helpseekerId = $id;

        $request = Request::where('leader_id', $leaderId)
        ->where('helpseeker_id', $helpseekerId);

        if($status === 'reject'){
            $request->delete();
        }else{
            $request->update(['status' => $status ]);
        }

        if($status === 'accept'){
            Request::where('helpseeker_id', $helpseekerId)
            ->where(function($query){
                $query->where('status', 'pending')
                ->orWhere('status', 'reject');
            })
            ->delete();
        }

        $requests = auth()->user()->helpseekers->where('status', 'pending');
        $this->helpseekers = HelpseekerResource::collection($requests)->toArray('');
    }

    public function render()
    {   
        $requests = auth()->user()->helpseekers->where('status', 'pending');
        $this->helpseekers = HelpseekerResource::collection($requests)->toArray('');
        return view('livewire.requests');
    }
}
