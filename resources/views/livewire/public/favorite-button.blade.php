<button wire:click="toggleFavorite" wire:loading.attr="disabled" class="favorite-btn {{ $isFavorite ? 'favorited' : '' }}"
    style="transition: transform 0.3s ease;" x-data
    x-on:click="$el.style.transform = 'scale(1.4)'; setTimeout(() => $el.style.transform = 'scale(1)', 800);">
    <i class="{{ $isFavorite ? 'fas' : 'far' }} fa-bookmark"></i>
</button>
