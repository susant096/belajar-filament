<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;

class Comments extends Component
{
    public $post, $content;

    public function mount($post)
    {
        $this->post = $post;
    }

    public function addComment()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        Comment::create([
            'post_id' => $this->post->id,
            'user_id' => auth()->user()->id,
            'content' => $this->content
        ]);

        $this->reset('content');
        $this->dispatch('comment-added');
    }

    public function render()
    {
        // dd($this->post->comments->load('user')->reverse());
        return view('livewire.comments', [
            'comments' => $this->post->comments->load('user')->reverse()
        ]);
    }
}
