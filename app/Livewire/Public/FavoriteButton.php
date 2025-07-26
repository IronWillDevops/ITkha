<?php

namespace App\Livewire\Public;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class FavoriteButton extends Component
{
    public Post $post;
    public bool $isFavorite = false;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->isFavorite = Auth::user()
            ? Auth::user()->favoritePosts->contains($post->id)
            : false;
    }

    public function toggleFavorite()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login'); 
        }

        if ($this->isFavorite) {
            $user->favoritePosts()->detach($this->post->id);
            $this->isFavorite = false;
        } else {
            $user->favoritePosts()->attach($this->post->id);
            $this->isFavorite = true;
        }
    }

    public function render()
    {
        return view('livewire.public.favorite-button');
    }
}
