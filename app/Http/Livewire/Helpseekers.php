<?php

namespace App\Http\Livewire;

use App\Http\Resources\SpecificHelpseekerResource;
use App\Models\Message;
use App\Models\Request;
use Livewire\Component;

class Helpseekers extends Component
{
    public $helpseekers;

    public function plans($id){
        return redirect()->route('leaderPlans',['id'=>$id]);
    }

    public function sendMessage($id){
        return redirect()->route('messages',['id'=>$id]);
    }

    public function sendRequest($helpseekerId, $status){
        $id = auth()->id();

        $messages = null;
        
        $request = Request::where('helpseeker_id', $helpseekerId)->where('leader_id', $id);
        
        $sentMessages = Message::where('messaged_user_id', $id)->where('user_id', $helpseekerId);
        $recivedMessages = Message::where('user_id', $id)->where('messaged_user_id', $helpseekerId);
        
        if($sentMessages->union($recivedMessages)->exists()){
            $messages = $sentMessages->union($recivedMessages);
        };

        if($status === 'cancel'){
            $request->delete();
        }

        else{
            $request->update(['status'=>'block']);
        }

        $messages->get()->each(function ($product, $key) {
            $product->delete();
        });
    }

    public function render()
    {
        $helpseekers = auth()->user()->helpseekers->where('status', 'accept');
        $this->helpseekers = SpecificHelpseekerResource::collection($helpseekers)->toArray('');

        return view('livewire.helpseekers');
    }
}
