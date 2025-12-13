@if(!request()->cookie('cookie_consent') && !Auth::check())
<div id="cookieNotification" 
     class="border fixed bottom-10 left-1/2 transform -translate-x-1/2 bg-card text-card-foreground px-6 py-4 rounded-sm shadow-lg flex items-center space-x-4 z-50 opacity-0 translate-y-6 transition-all duration-500">
    
    <!-- Иконка -->
    <div class="flex items-center space-x-2">
        <i class="fas fa-cookie-bite text-primary"></i>
        <div class="text-sm">
            {{ __('public/cookie.message') }} 
            <a href="/privacy-policy" class="underline text-primary hover:text-primary/80">{{ __('public/cookie.more') }}</a>
        </div>
    </div>

    <!-- Кнопка -->
    <button id="acceptCookiesBtn" 
            class="bg-primary border-input text-foreground hover:bg-primary/80 hover:text-accent-foreground focus:ring focus:outline-none focus-visible:ring-ring rounded-sm font-medium text-sm px-5 py-2.5 text-center">
        {{ __('public/cookie.accept') }}
    </button>
</div>
@endif

<script>
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
        return null;
    }

    function setCookie(name, value, days) {
        const d = new Date();
        d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
        const expires = "expires=" + d.toUTCString();
        document.cookie = name + "=" + value + ";" + expires + ";path=/";
    }

    document.addEventListener('DOMContentLoaded', () => {
        const banner = document.getElementById('cookieNotification');
        if (!banner) return;

        // Скрыть баннер если куки уже есть
        if (getCookie('cookie_consent')) {
            banner.remove();
            return;
        }

        // Показываем баннер с анимацией
        setTimeout(() => {
            banner.classList.remove('opacity-0', 'translate-y-6');
            banner.classList.add('opacity-100', 'translate-y-0');
        }, 100);

        // Кнопка "Принять"
        const btn = document.getElementById('acceptCookiesBtn');
        btn.addEventListener('click', () => {
            setCookie('cookie_consent', 'true', 365); // сохраняем на 1 год
            banner.classList.add('opacity-0', 'translate-y-6');
            banner.classList.remove('opacity-100', 'translate-y-0');
            setTimeout(() => banner.remove(), 500);
        });
    });
</script>
