<header>
    <nav class="bg-card text-card-foreground shadow border-b border-border">
        <div class="flex items-center justify-between flex-wrap p-4 mx-auto gap-2">
            {{-- Левая часть --}}
            <div class="flex items-center space-x-2">
                {{-- Логотип --}}
                <a href="{{ route('public.post.index') }}"
                    class="block py-2 px-3 rounded-md hover:bg-accent hover:text-accent-foreground focus:ring focus:outline-none focus-visible:ring-ring md:p-1.5">
                    <span class="text-2xl font-semibold whitespace-nowrap">{{ setting('site_name', config('app.name')) }}</span>
                </a>
            </div>

            {{-- Правая часть --}}
            <div class="flex items-center space-x-2 md:space-x-2">
                {{-- Кнопка смены темы --}}
                <button id="theme-toggle" type="button"
                    class="bg-background border border-input hover:bg-accent hover:text-accent-foreground rounded-lg focus:ring focus:outline-none focus-visible:ring-ring text-sm p-2"
                    aria-label="Change theme">
                    <div id="theme-toggle-dark-icon"><i class="fas fa-moon hidden fa-lg"></i></div>
                    <div id="theme-toggle-light-icon"><i class="fas fa-sun hidden fa-lg"></i></div>
                </button>

                {{-- Основное меню (только на больших экранах) --}}
                <ul class="hidden md:flex font-medium items-center space-x-2">
                    <li class="flex items-center">
                        <a href="{{ route('public.pages.contact.index') }}"
                            class="block px-3 py-2 rounded-md bg-background hover:bg-accent hover:text-accent-foreground focus:ring focus:outline-none focus-visible:ring-ring">
                            {{ __('public/header.fields.contact') }}
                        </a>
                    </li>
                    @guest
                        <li class="flex items-center">
                            <a href="{{ route('login') }}"
                                class="block px-3 py-2 rounded-md bg-background hover:bg-accent hover:text-accent-foreground focus:ring focus:outline-none focus-visible:ring-ring">
                               {{ __('public/header.fields.login') }}
                            </a>
                        </li>
                    @endguest
                </ul>

                {{-- Иконка пользователя вместо аватара --}}
                @auth
                    <div class="hidden md:block relative">
                        <button id="userMenuButton" type="button"
                            class="bg-background border border-input hover:bg-accent hover:text-accent-foreground inline-flex items-center justify-center w-10 h-10 rounded-full cursor-pointer focus:ring focus:outline-none focus-visible:ring-ring"
                            aria-label="User menu">
                            @if (Auth::user()->avatar)
                                <img class="w-10 h-10 object-cover rounded-full border border-input"
                                    src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->first_name }}">
                            @else
                                <div
                                    class=" hover:bg-accent hover:text-accent-foreground relative inline-flex items-center justify-center w-10 h-10 overflow-hidden rounded-full focus:ring focus:outline-none focus-visible:ring-ring border border-input">
                                    <span class="font-medium">
                                        {{ Auth::user()->getInitial() }}
                                    </span>
                                </div>
                            @endif
                        </button>

                        {{-- Выпадающее меню --}}
                        <div id="userDropdown"
                            class="absolute right-0 mt-2 hidden w-44 bg-card border border-input rounded-lg shadow-md z-50 text-sm">
                            <div class="p-2 font-medium truncate border-b border-input">
                                {{ Auth::user()->login }}
                            </div>
                            <a href="{{ route('public.user.show', Auth::user()) }}"
                                class="block p-2 hover:bg-accent hover:text-accent-foreground focus:ring focus:outline-none focus-visible:ring-ring">
                                {{ __('public/header.fields.profile') }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left block p-2 hover:bg-accent hover:text-accent-foreground cursor-pointer focus:ring focus:outline-none focus-visible:ring-ring">
                                    {{ __('public/header.fields.logout') }}
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth

                {{-- Кнопка бургер-меню (только мобильные) --}}
                <button data-collapse-toggle="navbar-default" type="button"
                    class="bg-background border border-input hover:bg-accent hover:text-accent-foreground inline-flex items-center p-2 w-10 h-10 justify-center text-sm rounded-lg focus:ring focus:outline-none focus-visible:ring-ring md:hidden"
                    aria-controls="navbar-default" aria-expanded="false">
                    <i class="fas fa-bars fa-lg"></i>
                </button>
            </div>

            {{-- Мобильное меню --}}
            <div class="hidden w-full md:hidden mt-3" id="navbar-default">
                <ul class="font-medium flex flex-col border-t border-input pt-3 space-y-2">
                    <li>
                        <a href="{{ route('public.pages.contact.index') }}"
                            class="block py-2 px-3 rounded-md  hover:bg-accent hover:text-accent-foreground focus:ring focus:outline-none focus-visible:ring-ring">
                            {{ __('public/header.fields.contact') }}
                        </a>
                    </li>

                    @auth
                        <li>
                            <a href="{{ route('public.user.show', Auth::user()) }}"
                                class="block py-2 px-3 rounded-md hover:bg-accent hover:text-accent-foreground focus:ring focus:outline-none focus-visible:ring-ring">
                                {{ __('public/header.fields.profile') }}
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left block py-2 px-3 rounded-md hover:bg-accent hover:text-accent-foreground focus:ring focus:outline-none focus-visible:ring-ring cursor-pointer">
                                    {{ __('public/header.fields.logout') }}
                                </button>
                            </form>
                        </li>
                    @endauth

                    @guest
                        <li>
                            <a href="{{ route('login') }}"
                                class="block py-2 px-3 rounded-md hover:bg-accent hover:text-accent-foreground focus:ring focus:outline-none focus-visible:ring-ring">
                                {{ __('public/header.fields.login') }}
                            </a>
                        </li>
                    @endguest
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
            const userMenuButton = document.getElementById('userMenuButton');
            const userDropdown = document.getElementById('userDropdown');

            // Бургер-меню
            toggleButton?.addEventListener('click', () => navMenu.classList.toggle('hidden'));

            // Выпадающее меню пользователя
            userMenuButton?.addEventListener('click', (e) => {
                e.stopPropagation();
                userDropdown.classList.toggle('hidden');
            });

            document.addEventListener('click', (e) => {
                if (!userDropdown.contains(e.target) && !userMenuButton.contains(e.target)) {
                    userDropdown.classList.add('hidden');
                }
            });
        });
    </script>
@endpush
