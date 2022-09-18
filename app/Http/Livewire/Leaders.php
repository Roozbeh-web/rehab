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

    public $search;
    public $city;

    public $rules = [
        'search' => '',
    ];

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

    public function update(){
    }
    
    public function render()
    {   
        $this->requests = Request::where('helpseeker_id', auth()->id())->get();
        if(!empty($this->search)){
            $searchs = explode(' ', $this->search);
            // $this->leaders = User::where('first_name', 'LIKE', '%'.$this->search.'%')
            //                         ->orWhere('last_name', 'LIKE', '%'.$this->search.'%')                    
            //                         ->orWhere('username', 'LIKE', '%'.$this->search.'%')
            //                         ->orWhere('province', 'LIKE', '%'.$this->search.'%')
            //                         ->orWhere('city', 'LIKE', '%'.$this->search.'%')
            //                         ->where('type', 'leader')->get();
            foreach($searchs as $search){
                $this->leaders = User::where(function ($query) use($search){
                    $query->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'LIKE', '%'.$search.'%')                    
                    ->orWhere('username', 'LIKE', '%'.$search.'%')
                    ->orWhere('province', 'LIKE', '%'.$search.'%')
                    ->orWhere('city', 'LIKE', '%'.$search.'%');
                })->where('type', 'leader')
                ->get();
            }
        }
        else{
            $province = auth()->user()->province;
            $this->leaders = User::where('type', 'leader')->where('province', $province)->get();
        }
        return view('livewire.leaders');
    }
}
