<?php

namespace App\Http\Livewire;

use App\Http\Resources\SpecificHelpseekerResource;
use App\Models\Request;
use Livewire\Component;

class Helpseekers extends Component
{
    public $helpseekers;

    public function sendRequest($helpseekerId, $status){
        $request = Request::where('helpseeker_id', $helpseekerId)->where('leader_id', auth()->id());
        
        if($status === 'cancel'){
            $request->delete();
        }
        else{
            $request->update(['status'=>'block']);
        }
    }

    public function render()
    {
        $helpseekers = auth()->user()->helpseekers->where('status', 'accept');
        $this->helpseekers = SpecificHelpseekerResource::collection($helpseekers)->toArray('');

        return view('livewire.helpseekers');
    }
}
