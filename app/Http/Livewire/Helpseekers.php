<?php

namespace App\Http\Livewire;

use App\Http\Resources\SpecificHelpseekerResource;
use Livewire\Component;

class Helpseekers extends Component
{
    public $helpseekers;

    public function render()
    {
        $helpseekers = auth()->user()->helpseekers->where('status', 'accept');
        $this->helpseekers = SpecificHelpseekerResource::collection($helpseekers)->toArray('');

        return view('livewire.helpseekers');
    }
}
