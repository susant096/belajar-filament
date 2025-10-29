<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Component;

class LikePost extends Component
{
    public $likeCheck, $checkBookmark;
    // public $bookmark = false;
    public $post, $commentCount;

    public function mount($post)
    {
        $this->post = $post;
        $this->likeCheck = $post->likes()->where('user_id', auth()->id())->exists();
        $this->checkBookmark = $post->bookmarks()->where('user_id', auth()->id())->exists();
        $this->updateCommentCount();
    }

    public function toggleLike()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        // dd(auth()->id());
        if ($this->likeCheck) {
            $this->post->likes()->where('user_id', auth()->id())->delete();
            $this->likeCheck = false;
        } else {
            $this->post->likes()->create([
                'user_id' => auth()->id(),
                'post_id' => $this->post->id
            ]);
            $this->likeCheck = true;
        }
        // $this->like = !$this->like;
    }
    public function toggleBookmark()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        if ($this->checkBookmark) {
            $this->post->bookmarks()->where('user_id', auth()->id())->delete();
            $this->checkBookmark = false;
        } else {
            $this->post->bookmarks()->create([
                'user_id' => auth()->id(),
                'post_id' => $this->post->id
            ]);
            $this->checkBookmark = true;
        }
        // $this->bookmark = !$this->bookmark;
    }
    public function render()
    {
        return view('livewire.like-post');
    }
    #[On('comment-added')]
    public function updateCommentCount()
    {
        $this->commentCount = $this->post->comments()->count();
    }

}
