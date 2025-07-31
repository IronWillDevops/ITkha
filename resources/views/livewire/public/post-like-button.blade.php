<button type="button" 
        wire:click="toggleLike" 
        wire:loading.attr="disabled"
        class="flex items-center {{$isLiked ? 'post-like' : 'post-like-hover' }} like-button" 
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
