<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Posts extends Component
{
    public $posts;

    public function render()
    {   $this->posts = User::where('id', auth()->id())->first()->posts;
        return view('livewire.posts');
    }
}
