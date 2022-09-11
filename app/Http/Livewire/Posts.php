<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class Posts extends Component
{
    public $posts;
    public $collapse = true;
    public $postId;
    public $modalStyle = 'display: none';

    public function doCollapse($id){
        $this->postId = $id;
        if($id == $this->postId){
            $this->collapse = !$this->collapse;
        }
    }

    public function edit($id){
        return redirect('/edit-post/'.$id);
    }

    public function removeModal($id=null, $expand=false){
        $this->postId = $id;
        if($expand){
            $this->modalStyle = 'display: block';
        }else{
            $this->modalStyle = 'display: none';
        }
    }

    public function remove(){
        Post::where('id', $this->postId)->delete();
        $this->modalStyle = 'display: none';
    }

    public function render()
    {   $this->posts = User::where('id', auth()->id())->first()->posts;
        return view('livewire.posts');
    }
}
