<?php

namespace App\Http\Livewire;

use App\Http\Resources\SpecificHelpseekerResource;
use App\Models\Message;
use App\Models\Request;
use Livewire\Component;

class Helpseekers extends Component
{
    public $helpseekers;

    public function sendMessage($id){
        return redirect()->route('messages',['id'=>$id]);
    }

    public function sendRequest($helpseekerId, $status){
        $request = Request::where('helpseeker_id', $helpseekerId)->where('leader_id', auth()->id());
        
        if($status === 'cancel'){
            $id = auth()->id();

            $sentMessages = Message::where('messaged_user_id', $id)->where('user_id', $helpseekerId);
            $recivedMessages = Message::where('user_id', $id)->where('messaged_user_id', $helpseekerId);
            
            $messages = $sentMessages->union($recivedMessages);

            if($messages->exists()){
                $messages->delete();
            }

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
