<footer class="bg-card text-card-foreground shadow border-solid border-t border-border">
    <div class="px-4 py-6 md:flex md:items-center md:justify-between">
        <!-- Левый блок -->
        <div class="text-center md:text-left">
            &copy; 2024 - {{ date('Y') }} <span class="font-semibold">{{ config('app.name') }}</span>. All rights
            reserved. <a href="{{ route('policy.show') }}" class="underline">{{ __('admin/settings/policy.title') }}</a>
        </div>

        <!-- Центр (языки) -->
        <div class="text-center my-6 md:text-left md:my-0">
            <a href="{{ route('locale.switch', ['locale' => 'en', 'redirect_to' => url()->current()]) }}"
                class=" hover:bg-accent/80 hover:text-accent-foreground border border-input p-2 transition rounded-sm focus:ring focus:outline-none focus-visible:ring-ring h-10 inline-flex items-center justify-center">EN</a>
            <a href="{{ route('locale.switch', ['locale' => 'uk', 'redirect_to' => url()->current()]) }}"
                class=" hover:bg-accent/80 hover:text-accent-foreground border border-input p-2 transition rounded-sm focus:ring focus:outline-none focus-visible:ring-ring h-10 inline-flex items-center justify-center">UK</a>
        </div>

        <!-- Правый блок (соцсети или ссылки) -->


        @if (\App\Models\FooterLink::all()->isNotEmpty())
            <div class="text-center md:text-left">
                @foreach (\App\Models\FooterLink::all() as $link)
                    <a href="{{ $link->url }}"
                        class="transition hover:text-primary focus:outline-none focus-visible:ring-ring"
                        title="{{ $link->title }}">
                        <i class="{{ $link->icon }} text-lg"></i>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</footer>
