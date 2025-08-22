<header class="bg-surface text-text-primary shadow flex items-center justify-between px-4 sm:px-6 h-14">
   

    <!-- Логотип -->
    <div class="flex items-center space-x-3">
        <span class="font-semibold text-lg select-none  block">{{ config('app.name') }} | Admin Panel</span>
    </div>

    <!-- Іконки та профіль -->
    <div class="flex items-center space-x-4">
        <!-- Уведомления -->
        <button aria-label="Notifications"
            class="relative p-2 rounded">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" viewBox="0 0 24 24">
                <path d="M18 8a6 6 0 0 0-12 0c0 7-3 9-3 9h18s-3-2-3-9"></path>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
            </svg>
            <span class="absolute top-0 right-0 inline-block w-2 h-2 bg-red-600 rounded-full"></span>
        </button>

        <!-- Профиль -->
        <div class="relative">
            <button id="userMenuButton" class="flex items-center space-x-2 focus:outline-none" aria-haspopup="true"
                aria-expanded="false">
                @if (Auth::user()->avatar)
                    <img class="inline-flex items-center justify-center w-10 h-10 object-cover rounded-full border border-border"
                        src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->login }}">
                @else
                    <div
                        class="inline-flex items-center justify-center w-10 h-10 rounded-full border border-border bg-gray-300 text-gray-700 font-medium select-none">
                        {{ Auth::user()->getInitial() }}
                    </div>
                @endif

                <span class="hidden sm:block font-medium">Admin</span>
                <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </button>

            <!-- Меню профиля -->
            <div id="userDropdown"
                class="absolute right-0 mt-2 w-48 bg-white rounded shadow-lg border border-border hidden" role="menu"
                aria-orientation="vertical" aria-labelledby="userMenuButton">
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100" role="menuitem">Профиль</a>
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100" role="menuitem">Настройки</a>
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100"
                        role="menuitem">Выйти</button>
                </form>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userMenuButton = document.getElementById('userMenuButton');
        const userDropdown = document.getElementById('userDropdown');
        if (userMenuButton && userDropdown) {
            userMenuButton.addEventListener('click', function(event) {
                event.stopPropagation();
                userDropdown.classList.toggle('hidden');
            });
            document.addEventListener('click', function(event) {
                if (!userDropdown.contains(event.target) && !userMenuButton.contains(event.target)) {
                    userDropdown.classList.add('hidden');
                }
            });
        }
    });

    
</script>
