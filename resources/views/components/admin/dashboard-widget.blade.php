<div class="group bg-surface rounded-xl border  border-border p-6 shadow flex gap-4 hover:shadow-md transition-shadow duration-300">
    <!-- Иконка (на всю высоту, с эффектом) -->
    <div class="flex items-center justify-center rounded-lg px-4 transition-transform duration-300 group-hover:scale-150">
        <i class="{{ $icon }} text-3xl text-text-primary"></i>
    </div>

    <!-- Контент карточки -->
    <div class="flex-1 flex flex-col justify-between">
        <!-- Заголовок -->
        <h3 class="text-lg font-semibold text-text-primary mb-2">
            {{ $title }}
        </h3>

        <!-- Описание (если есть) -->
        @isset($description)
            <p class="text-sm text-text-secondary mb-4">
                {{ $description }}
            </p>
        @endisset

        <!-- Ссылка -->
        <a href="{{ $link }}" class="inline-block text-sm font-medium link link-hover mt-auto">
            {{ $linkText }}
        </a>
    </div>
</div>
