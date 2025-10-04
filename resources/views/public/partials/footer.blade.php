<footer class="bg-card text-card-foreground shadow border-solid border-t-1 border-border">
    <div class="px-4 py-6 md:flex md:items-center md:justify-between">
        <!-- Левый блок -->
        <div class="text-center md:text-left">
            &copy; 2024 - {{ date('Y') }} <span class="font-semibold">{{ config('app.name') }}</span>. All rights reserved.
        </div>

        <!-- Центр (языки) -->
        <div class="text-center my-6 md:text-left md:my-0">
            <a href="{{ route('locale.switch', ['locale' => 'en', 'redirect_to' => url()->current()]) }}"
                class="bg-link hover:bg-accent/80 hover:text-accent-foreground border border-input p-2 transition rounded-sm focus:ring focus:outline-none focus-visible:ring-ring">EN</a>
            <a href="{{ route('locale.switch', ['locale' => 'uk', 'redirect_to' => url()->current()]) }}"
                class="bg-link hover:bg-accent/80 hover:text-accent-foreground border border-input p-2 transition rounded-sm focus:ring focus:outline-none focus-visible:ring-ring">UK</a>
        </div>

        <!-- Правый блок (соцсети или ссылки) -->
       

        @if (\App\Models\FooterLink::all()->isNotEmpty())
            <div class="text-center md:text-left">
                @foreach (\App\Models\FooterLink::all() as $link)
                    <a href="{{ $link->url }}" class="transition" title="{{ $link->title }}">
                        <i class="fab {{ $link->icon }} text-lg"></i>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</footer>
