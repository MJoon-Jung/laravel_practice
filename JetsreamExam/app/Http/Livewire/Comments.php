<?php

namespace App\Http\Livewire;

use Livewire\Component;
use LiveWire\WithPagination;
use App\Models\Comment;

class Comments extends Component
{
    public $newComment;
    // use WithPagination;
    protected $rules=[
        'newComment'=>'required'
    ];
    protected $listeners=[
        'deleteClk'=>'delClk'
    ];
    public function delClk($commentId){
        $comment = Comment::find($commentId);
        $comment->delete();

        session()->flash('message','댓글 삭제');
    }
    public function mount(){
        $this->newComment="";
    }
    public function render()
    {
        return view('livewire.comments',[
            'comments'=>Comment::latest()->paginate(3),
        ]);
    }
    public function addComment(){
        $this->validate();
        Comment::create([
            'user_id'=>auth()->user()->id,
            'content'=>$this->newComment,
            'image'=>''
        ]);
        session()->flash('message','댓글 생성');
    }
}
