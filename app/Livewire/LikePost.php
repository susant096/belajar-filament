<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $like = false;
    public $bookmark = false;

    public function toggleLike()
    {
        $this->like = !$this->like;
    }
    public function toggleBookmark()
    {
        $this->bookmark = !$this->bookmark;
    }
    public function render()
    {
        return view('livewire.like-post');
    }
}
