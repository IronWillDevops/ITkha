<header>
    <nav class="bg-surface text-text-primary shadow border-solid border-b-1 border-border">
        <div class="flex flex-wrap items-center justify-between mx-auto p-4">

            <a href="{{ route('admin.index') }}" class="text flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center text-2xl font-semibold whitespace-nowrap">Admin Panel | {{ config('app.name') }} {{ config('app.version') }}</span>
            </a>
            <button data-collapse-toggle="navbar-default" type="button"
                class="nav-btn  nav-btn-hover inline-flex items-center p-2 w-10 h-10 justify-center text-sm  rounded-lg md:hidden"
                aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only"></span>
                <i class="fas fa-bars fa-2x"></i>
            </button>
            <div class="hidden w-full md:block md:w-auto " id="navbar-default">
                <ul
                    class="font-medium md:items-center md:justify-between flex flex-col p-4 md:p-0 mt-4 border md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">
                    <li>
                        <button id="theme-toggle" type="button" class="link-hover rounded-lg text-sm p-1.5"
                            aria-label="Change theme">
                            <div id="theme-toggle-dark-icon"><i class="fas fa-moon hidden fa-lg"></i></div>
                            <div id="theme-toggle-light-icon"><i class="fas fa-sun hidden fa-lg"></i></div>
                        </button>
                    </li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left block px-4 py-3 text-sm link-hover cursor-pointer">{{ __('header.auth.logout') }}</button>
                        </form>
                    </li>
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
