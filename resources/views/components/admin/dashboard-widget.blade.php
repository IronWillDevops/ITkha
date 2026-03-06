<div
    class="group bg-card text-card-foreground border-input hover:bg-accent hover:text-accent-foreground
           rounded-lg focus:ring focus:outline-none focus-visible:ring-ring
           text-sm border shadow
           flex flex-col sm:flex-row gap-4
           p-4 sm:p-6
           hover:shadow-md transition-all duration-300
           hover:-translate-y-0.5">
    {{-- Иконка --}}
    <div
        class="flex items-center justify-center rounded-lg
               w-full sm:w-auto sm:px-4 py-2 sm:py-0
               shrink-0
               transition-transform duration-300 ease-out
               group-hover:scale-125 sm:group-hover:scale-150
               group-hover:rotate-3">
        <i class="{{ $icon }} text-3xl"></i>
    </div>

    {{-- Контент --}}
    <div class="flex-1 flex flex-col justify-between min-w-0">

        {{-- Заголовок --}}
        <h3 class="text-base sm:text-lg font-semibold mb-2 leading-snug">
            {{ $title }}
        </h3>

        {{-- Описание --}}
        @isset($description)
            <p class="text-sm text-muted-foreground mb-4 leading-relaxed">
                {{ $description }}
            </p>
        @endisset

        {{-- Ссылка --}}
        <a href="{{ $link }}"
            class="link">
            <i class="fas fa-link "></i>
            <span>{{ $linkText }}</span>
            
        </a>

    </div>
</div>
