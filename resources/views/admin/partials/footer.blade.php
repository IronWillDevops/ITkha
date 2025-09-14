<footer class="bg-surface text-text-primary  shadow border-solid border-t-1 border-border">
    <div class="px-4 py-6 md:flex md:items-center md:justify-between">


        <!-- Левый блок -->
        <div class="text-center md:text-left ">
            &copy; 2024 - {{ date('Y') }} <span class="font-semibold ">{{ config('app.name') }}</span>. All
            rights reserved.
        </div>

        <!-- Центр (языки) -->
        <div class="text-center md:text-left ">
            <a href="{{ route('locale.switch', ['locale' => 'en', 'redirect_to' => url()->current()]) }}"
                class="link link-hover transition">EN</a>
            <a href="{{ route('locale.switch', ['locale' => 'uk', 'redirect_to' => url()->current()]) }}"
                class="link link-hover transition">UK</a>
        </div>

        <!-- Правый блок (соцсети или ссылки) -->
        <div class="text-center md:text-left ">
            @foreach (\App\Models\FooterLink::all() as $link)
                <a href="{{ $link->url }}" class="transition"
                    title="{{ $link->title }}">
                    <i class="fab {{ $link->icon }} text-lg"></i>
                </a>
            @endforeach
        </div>
    </div>
</footer>
