<footer class="bg-card text-card-foreground shadow border-solid border-t border-border">
    <div class="px-4 py-6 md:flex md:items-center md:justify-between md:gap-6">

        <!-- Левый блок -->
        <div class="text-center md:text-left">
            &copy; 2024 - {{ date('Y') }}
            <span class="font-semibold">{{ config('app.name') }}</span>.
            All rights reserved.
            <a href="{{ route('policy.show') }}" class="link">
                {{ __('admin/settings/policy.title') }}
            </a>
        </div>

        <!-- Центр (языки) -->
        <div class="text-center my-6 md:my-0">
            <a href="{{ route('locale.switch', ['locale' => 'en', 'redirect_to' => url()->current()]) }}"
                class="btn btn-shimmer">EN</a>
            <a href="{{ route('locale.switch', ['locale' => 'uk', 'redirect_to' => url()->current()]) }}"
                class="btn btn-shimmer">UK</a>
        </div>

        <!-- Контакты -->
        @if (filled(setting('site_address')) || filled(setting('site_phone')) || filled(setting('site_email')))
            <div class="text-center md:text-left text-sm  my-6 md:my-0">
                @if (filled(setting('site_address')))
                    <div>
                        <i class="fa-solid fa-location-dot"></i> {{ setting('site_address') }}
                    </div>
                @endif
                @if (filled(setting('site_phone')))
                    <div>
                        <i class="fa-solid fa-phone"></i>
                        <a href="tel:{{ setting('site_phone') }}" class="link">
                            {{ setting('site_phone') }}
                        </a>
                    </div>
                @endif
                @if (filled(setting('site_email')))
                    <div>
                        <i class="fa-regular fa-envelope"></i>
                        <a href="mailto:{{ setting('site_email') }}" class="link">
                            {{ setting('site_email') }}
                        </a>
                    </div>
                @endif
            </div>
        @endif

        <!-- Соцсети -->
        @if (\App\Models\FooterLink::all()->isNotEmpty())
            <div class="text-center md:text-left space-x-2">
                @foreach (\App\Models\FooterLink::all() as $link)
                    <a href="{{ $link->url }}" title="{{ $link->title }}" class="btn btn-shimmer">
                        <i class="{{ $link->icon }} text-lg"></i>
                    </a>
                @endforeach
            </div>
        @endif

    </div>
</footer>
