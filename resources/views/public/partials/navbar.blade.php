<header>
    <nav class="bg-surface text-text-primary shadow border-solid border-b-1 border-border">
        <div class="flex flex-wrap items-center justify-between mx-auto p-4">

            <a href="{{ route('public.post.index') }}" class="text flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center text-2xl font-semibold whitespace-nowrap">{{ config('app.name') }}</span>
            </a>
            <button data-collapse-toggle="navbar-default" type="button"
                class="nav-btn  nav-btn-hover inline-flex items-center p-2 w-10 h-10 justify-center text-sm  rounded-lg md:hidden"
                aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only"></span>
                <i class="fas fa-bars fa-2x"></i>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul
                    class="font-medium md:items-center md:justify-between flex flex-col p-4 md:p-0 mt-4 border md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">
                    <li>
                        <button id="theme-toggle" type="button" class="nav-btn nav-btn-hover rounded-lg text-sm p-1.5"
                            aria-label="Change theme">
                            <div id="theme-toggle-dark-icon"><i class="fas fa-moon hidden fa-lg"></i></div>
                            <div id="theme-toggle-light-icon"><i class="fas fa-sun hidden fa-lg"></i></div>
                        </button>
                    </li>
                    <li>
                        <a href="{{ route('public.post.index') }}"
                            class="block py-2 px-3 nav-btn nav-btn-hover  rounded-sm md:bg-transparent md:p-0 "
                            aria-current="page">{{ __('header.main') }}</a>
                    </li>

                    <li>
                        <a href="{{ route('public.pages.contact.index') }}"
                            class="block py-2 px-3 nav-btn nav-btn-hover  rounded-sm md:bg-transparent md:p-0">{{ __('header.contact_us') }}</a>
                    </li>

                    @auth
                        <li class="relative max-w-28">
                            @if (Auth::user()->avatar)
                                <img id="userMenuButton" type="button" data-dropdown-toggle="userDropdown"
                                    data-dropdown-placement="bottom-start" class="relative inline-flex items-center justify-center w-10 h-10 object-cover rounded-full border border-border"
                                   src="{{ asset('storage/' . Auth::user()->avatar) }}" data-filename="image.png"
                                    alt="{{ Auth::user()->name }}">
                            @else
                                <div id="userMenuButton"
                                    class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden rounded-full border border-border">
                                    <span class="font-medium">
                                       {{Auth::user()->getInitial()}}
                                    </span>
                                </div>
                            @endif
                            <!-- Dropdown menu -->
                            <div id="userDropdown"
                                class="absolute right-0 z-50 hidden bg-surface divide-y  rounded-lg shadow-sm w-44 border border-border">
                                <div class="px-4 py-3 text-sm ">
                                    <div class="font-medium truncate">{{ Auth::user()->login }}</div>
                                </div>

                                <hr class="border border-border">
                                <ul class="py-2 text-sm " aria-labelledby="avatarButton">
                                    <li>
                                        <a href="{{ route('public.user.show', Auth::user()->id) }}"
                                            class="block px-4 py-2 nav-btn nav-btn-hover">{{ __('header.auth.profile') }}</a>
                                    </li>

                                </ul>
                                <hr class="border border-border">
                                <div class="py-1">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="w-full text-left block px-4 py-3 text-sm nav-btn nav-btn-hover cursor-pointer">{{ __('header.auth.logout') }}</button>
                                    </form>
                                </div>
                            </div>


                        </li>
                    @endauth
                    @guest
                        <li>
                            <a href="{{ route('login') }}"
                                class="block py-2 px-3 nav-btn nav-btn-hover rounded-sm md:bg-transparent md:p-0">{{ __('header.auth.login') }}</a>
                        </li>
                    @endguest

                </ul>
            </div>
        </div>
    </nav>
</header>


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.querySelector('[data-collapse-toggle="navbar-default"]');
            const navMenu = document.getElementById('navbar-default');

            if (toggleButton && navMenu) {
                toggleButton.addEventListener('click', function() {
                    navMenu.classList.toggle('hidden');
                });
            }
        });


        // Встановлюємо тему ДО завантаження DOM (за замовчуванням - 'light')
        if (localStorage.getItem('color-theme') === 'dark' ||
            (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            document.documentElement.classList.remove('light');
        } else {
            document.documentElement.classList.add('light');
            document.documentElement.classList.remove('dark');
        }

        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        // Зміна іконок відповідно до збереженої теми
        if (localStorage.getItem('color-theme') === 'dark' ||
            (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
            themeToggleDarkIcon.classList.add('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
            themeToggleLightIcon.classList.add('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function() {
            // Перемикаємо іконки
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            // Перемикаємо теми
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                document.documentElement.classList.add('light');
                localStorage.setItem('color-theme', 'light');
            } else {
                document.documentElement.classList.remove('light');
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userMenuButton = document.getElementById('userMenuButton');
            const userDropdown = document.getElementById('userDropdown');
            if (userMenuButton && userDropdown) {
                // Клік на кнопку: відкриття/закриття меню
                userMenuButton.addEventListener('click', function(event) {
                    event.stopPropagation();
                    userDropdown.classList.toggle('hidden');
                });


                // Клік поза меню: закриття
                document.addEventListener('click', function(event) {
                    if (!userDropdown.contains(event.target) && !userMenuButton.contains(event.target)) {
                        userDropdown.classList.add('hidden');
                    }
                });
            }
        });
    </script>
@endpush
