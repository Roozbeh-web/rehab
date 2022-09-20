<?php

namespace App\Http\Livewire;

use App\Http\Resources\HelpseekerResource;
use App\Http\Resources\SpecificLeaderResource;
use App\Models\Message;
use Livewire\Component;

class Messages extends Component
{
    public $input;
    public $chatUsers;

    public $messages;

    public $userId;
 
    protected $queryString = [
        'userId' => ['as' => 'id', 'expect' => 1]
    ];

    public function chooseChat($id){
        Message::where('messaged_user_id', auth()->id())->where('user_id', $id)->update(['is_read'=>true]);
        $this->userId = $id;
    }

    public function sendMessage(){
        Message::create([
            'body' => $this->input,
            'user_id' => auth()->id(),
            'messaged_user_id' => $this->userId,
            'is_read' => false,
        ]);
        $this->input = null;
    }

    public function render()
    {  
        if(auth()->user()->type === 'helpseeker'){
            $leader = auth()->user()->leaders->where('status', 'accept')->first();
            if($leader){
                $leader = auth()->user()->leaders->where('status', 'accept')->first()->leader;
                $this->chatUsers = (new SpecificLeaderResource($leader))->toArray('');
            }
        }
        elseif(auth()->user()->type === 'leader'){
            $requests = auth()->user()->helpseekers->where('status', 'accept');
            $this->chatUsers = HelpseekerResource::collection($requests)->toArray('');
        }

        if($this->userId){
            $sentMessages = auth()->user()->sentMessages($this->userId);
            $reciveMessages = auth()->user()->reciveMessages($this->userId);
            $this->messages = $sentMessages->union($reciveMessages)->get()->toArray();
        }

        return view('livewire.messages');
    }
}
