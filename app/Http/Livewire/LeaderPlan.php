<?php

namespace App\Http\Livewire;

use App\Http\Resources\SpecificLeaderResource as SpecificUserResource;
use App\Models\User;
use Livewire\Component;

class LeaderPlan extends Component
{
    public $userId;

    public $user;
    
    protected $queryString = [
        'userId' => ['as' => 'id', 'expect' => 1]
    ];

    public function newPlan($id){
        return redirect()->route('newPlan',['id'=>$id]);
    }

    public function render()
    {   
        $user = User::where('id', $this->userId)->first();
        $this->user = (new SpecificUserResource($user))->toArray('');
        // dd($this->user);
        return view('livewire.leader-plan');
    }
}
