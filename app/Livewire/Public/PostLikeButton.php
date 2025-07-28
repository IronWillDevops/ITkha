<?php

namespace App\Livewire\Public;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class PostLikeButton extends Component
{
    public Post $post;
    public bool $isLiked = false;
    public int $likesCount = 0;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->likesCount = $post->likedByUsers->count();

        $this->isLiked = Auth::check()
            ? Auth::user()->likedPosts->contains($post->id)
            : false;
    }

    public function toggleLike()
    {
        $user = Auth::user();

        if (!$user) {
                return redirect()->route('login'); 
            return;
        }

        if ($this->isLiked) {
            $user->likedPosts()->detach($this->post->id);
            $this->likesCount--;
            $this->isLiked = false;
        } else {
            $user->likedPosts()->attach($this->post->id);
            $this->likesCount++;
            $this->isLiked = true;
        }
    }

    public function render()
    {
        return view('livewire.public.post-like-button');
    }
}
