@if(!$consent)
<div id="cookieNotification"
     class="border border-border max-w-lg fixed bottom-10 left-1/2 transform -translate-x-1/2 bg-card text-card-foreground px-6 py-4 rounded-lg shadow-lg flex flex-wrap items-center gap-4 z-50 opacity-0 translate-y-6 transition-all duration-500">

    <!-- Иконка и текст -->
    <div class="flex items-center space-x-2 flex-1 ">
        <i class="fas fa-cookie-bite text-primary"></i>
        <div class="text-sm">
            {{ __('public/cookie.message') }}
            <a href="#" class="underline text-primary hover:text-primary/80">
                {{ __('public/cookie.more') }}
            </a>
        </div>
    </div>

    <!-- Кнопки -->
    <div class="flex gap-2 flex-shrink-0">
        <button id="acceptCookiesBtn"
                class="bg-primary border-input text-foreground hover:bg-primary/80 hover:text-accent-foreground focus:ring focus:outline-none focus-visible:ring-ring rounded-sm font-medium text-sm px-5 py-2.5 text-center">
            {{ __('public/cookie.buttons.accept') }}
        </button>
        <button id="declineCookiesBtn"
                class="bg-destructive border-input text-destructive-foreground hover:bg-destructive/80 hover:text-destructive-foreground focus:ring focus:outline-none focus-visible:ring-ring rounded-sm font-medium text-sm px-5 py-2.5 text-center">
            {{ __('public/cookie.buttons.decline') }}
        </button>
    </div>
</div>
@endif

<script>
document.addEventListener('DOMContentLoaded', () => {
    const banner = document.getElementById('cookieNotification');
    if (!banner) return;

    // Анимация появления
    setTimeout(() => {
        banner.classList.remove('opacity-0', 'translate-y-6');
        banner.classList.add('opacity-100', 'translate-y-0');
    }, 100);

    const acceptBtn = document.getElementById('acceptCookiesBtn');
    const declineBtn = document.getElementById('declineCookiesBtn');

    acceptBtn.addEventListener('click', () => {
        fetch('{{ route('public.cookie.accept') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(() => {
            banner.classList.add('opacity-0', 'translate-y-6');
            banner.classList.remove('opacity-100', 'translate-y-0');
            setTimeout(() => banner.remove(), 500);
        });
    });

    declineBtn.addEventListener('click', () => {
        fetch('{{ route('public.cookie.revoke') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(() => {
            banner.classList.add('opacity-0', 'translate-y-6');
            banner.classList.remove('opacity-100', 'translate-y-0');
            setTimeout(() => banner.remove(), 500);
        
        });
    });
});
</script>
