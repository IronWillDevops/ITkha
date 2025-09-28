<button wire:click="toggleFavorite" wire:loading.attr="disabled"
    class="{{ $isFavorite ? 'text-primary' : '' }}  hover:text-primary/80 focus:ring focus:outline-none focus-visible:ring-ring" style="transition: transform 0.3s ease;" x-data
    x-on:click="$el.style.transform = 'scale(1.4)'; setTimeout(() => $el.style.transform = 'scale(1)', 800);">
    <i class="{{ $isFavorite ? 'fas' : 'far' }} fa-bookmark"></i>
</button>
