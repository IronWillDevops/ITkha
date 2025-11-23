<header>
    <nav class="bg-card text-card-foreground shadow border-b border-border">
        <div class="flex items-center justify-between flex-wrap p-4 mx-auto gap-2">
            {{-- Левая часть --}}
            <div class="flex items-center space-x-2">
                {{-- Логотип --}}
                <a href="{{ route('admin.index') }}"
                    class="block py-2 px-3 rounded-md hover:bg-accent hover:text-accent-foreground focus:ring focus:outline-none focus-visible:ring-ring md:p-1.5">
                    <span class="text-2xl font-semibold whitespace-nowrap leading-none">
                        Admin Panel | {{ setting('site_name', config('app.name')) }}
                    </span>

                    <span class="text-sm font-semibold whitespace-nowrap leading-none">
                        {{ config('app.version') }}
                    </span>
                </a>
            </div>

            {{-- Правая часть --}}
            <div class="flex items-center space-x-2 md:space-x-2">
                {{-- Кнопка смены темы --}}
                <button id="theme-toggle" type="button"
                    class="bg-background border-input hover:bg-accent hover:text-accent-foreground rounded-lg focus:ring focus:outline-none focus-visible:ring-ring text-sm p-2"
                    aria-label="Change theme">
                    <div id="theme-toggle-dark-icon"><i class="fas fa-moon hidden fa-lg"></i></div>
                    <div id="theme-toggle-light-icon"><i class="fas fa-sun hidden fa-lg"></i></div>
                </button>

                {{-- Основное меню (только на больших экранах) --}}
                <ul class="hidden md:flex font-medium items-center space-x-2">

                    @auth
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block py-2 px-3 bg-background border-input hover:bg-accent hover:text-accent-foreground rounded-sm focus:ring focus:outline-none focus-visible:ring-ring md:p-1.5  cursor-pointer">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                    <span>{{ __('admin/header.logout') }}</span>
                                </button>
                            </form>
                        </li>
                    @endauth

                </ul>

                {{-- Иконка пользователя вместо аватара --}}



                {{-- Кнопка бургер-меню (только мобильные) --}}
                <button data-collapse-toggle="navbar-default" type="button"
                    class="bg-background border-input hover:bg-accent hover:text-accent-foreground inline-flex items-center p-2 w-10 h-10 justify-center text-sm rounded-lg focus:ring focus:outline-none focus-visible:ring-ring md:hidden"
                    aria-controls="navbar-default" aria-expanded="false">
                    <i class="fas fa-bars fa-lg"></i>
                </button>
            </div>

            {{-- Мобильное меню --}}
            <div class="hidden w-full md:hidden mt-3" id="navbar-default">
                <ul class="font-medium flex flex-col border-t border-input pt-3 space-y-2">

                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left block py-2 px-3 rounded-md hover:bg-accent hover:text-accent-foreground focus:ring focus:outline-none focus-visible:ring-ring cursor-pointer">
                                <span>{{ __('admin/header.logout') }}</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleButton = document.querySelector('[data-collapse-toggle="navbar-default"]');
            const navMenu = document.getElementById('navbar-default');

            // Бургер-меню
            toggleButton?.addEventListener('click', () => navMenu.classList.toggle('hidden'));


        });
    </script>
@endpush
