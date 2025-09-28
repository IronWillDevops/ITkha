<button type="button" 
        wire:click="toggleLike" 
        wire:loading.attr="disabled"
        class="flex items-center {{$isLiked ? 'text-primary' : '' }} hover:text-primary/80 focus:ring focus:outline-none focus-visible:ring-ring" 
        x-data="{ animate: false }"
        x-on:click="
            animate = true; 
            setTimeout(() => animate = false, 300);
        "
>
    <i class="fas fa-heart mr-1" 
       :class="animate ? 'animate-like' : ''" 
       ></i>
    <span class="like-count">{{ Number::abbreviate($likesCount) }}</span>
</button>
