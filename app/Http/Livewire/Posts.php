<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Posts extends Component
{
    public $posts;
    public $collapse = true;
    public $postId;

    public function doCollapse($id){
        $this->postId = $id;
        if($id == $this->postId){
            $this->collapse = !$this->collapse;
        }
    }

    public function edit($id){
        return redirect('/edit-post/'.$id);
    }

    public function remove($id){
        //
    }

    public function render()
    {   $this->posts = User::where('id', auth()->id())->first()->posts;
        return view('livewire.posts');
    }
}
