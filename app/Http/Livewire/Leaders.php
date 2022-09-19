<?php

namespace App\Http\Livewire;

use App\Http\Resources\LeaderResource;
use App\Http\Resources\SpecificLeaderResource;
use App\Models\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Leaders extends Component
{
    public $leaders;
    public $leaderId;
    public $requests;

    public $leader;

    public $search;

    public function sendRequest($leaderId){
        Request::create([
            'helpseeker_id' => auth()->id(),
            'leader_id' => $leaderId,
            'status' => 'pending',
        ]);
    }

    public function cancelRequest($leaderId){
        Request::where('leader_id', $leaderId)->where('helpseeker_id', auth()->id())->delete();
        if($this->leader){
            $this->leader = null;
        }
    }

    public function render()
    {   
        if(Request::where('helpseeker_id', auth()->id())->where('status', 'accept')->first()){
            $leader = Request::where('helpseeker_id', auth()->id())->where('status', 'accept')->first()->leader;
            $this->leader = (new SpecificLeaderResource($leader))->toArray('');
        }

        if($this->search){
            $search = explode(' ',$this->search);
            
            if(count($search) === 1){
                $this->leaders = User::where('type', 'leader')->where( function($query) use($search){
                    $query->where('first_name', 'LIKE', '%' . $search[0] . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $search[0] . '%')
                    ->orWhere('username', 'LIKE', '%' . $search[0] . '%')
                    ->orWhere('province', 'LIKE', '%' . $search[0] . '%')
                    ->orWhere('city', 'LIKE', '%' . $search[0] . '%')
                    ;
                })->get();

            }
            elseif(count($search) >= 2){
                // dd($search[1]);
                $this->leaders = User::where('type', 'leader')->where( function($query) use($search){
                    $query->where(function($q) use($search){
                        $q->where('first_name', 'LIKE', '%' . $search[0] . '%')
                        ->where('last_name', 'LIKE', '%' . $search[1] . '%');
                        
                    })
                    ->orWhere(function($q) use($search){
                        $q->where('province', 'LIKE', '%' . $search[0] . '%')
                        ->where('city', 'LIKE', '%' . $search[1] . '%');
                    });
                    
                })->get();
            }
            
        }
        
        else{
            $province = auth()->user()->province;
            $leaders = User::where('type', 'leader')->where('province', $province)->get();
            $this->leaders = LeaderResource::collection($leaders)->toArray('');
            $this->requests = Request::where('helpseeker_id', auth()->id())->get();
        }
        return view('livewire.leaders');
    }
}
