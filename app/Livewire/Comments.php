<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Attributes\On;
use Livewire\Component;

class Comments extends Component
{
    public $post, $content;
    public $perPage = 20;
    public $hasMore = true;

    public function mount($post)
    {
        $this->post = $post;
    }
    #[On('load-more')]
    public function loadMore()
    {
        $this->perPage += 20;
    }
    public function getCommentsProperty()
    {
        $query = Comment::with('user')
            ->where('post_id', $this->post->id)
            ->orderByDesc('created_at');

        $comments = $query->take($this->perPage)->get();

        $total = Comment::where('post_id', $this->post->id)->count();
        $this->hasMore = $this->perPage < $total;

        return $comments;
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
            // 'comments' => $this->post->comments->load('user')->reverse()
            'comments' => $this->comments
        ]);
    }
}
