@if (session('success') || session('error'))
    <div id="toast-container" class="fixed bottom-4 right-4 z-50 flex flex-col space-y-4">
        @if (session('success'))
            <div
                class="toast fixed bottom-4 right-4 max-w-sm w-full bg-card border border-success rounded-xl shadow-lg flex items-start p-4 gap-3 text-card-foreground z-50 transition-transform duration-300 ease-in-out animate-slide-in-bottom">
                <i class="fa-solid fa-circle-check text-success text-xl mt-1"></i>

                <div class="flex-1">
                    <div class=" text-success font-semibold text-sm mb-1">Success</div>
                    <p class="text-sm text-muted-foreground">{{ session('success') }}</p>
                </div>

                <button class="cursor-pointer transition-colors duration-200 text-lg text-success hover:text-success/80"
                    aria-label="Close" onclick="this.parentElement.remove()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div
                class="toast fixed bottom-4 right-4 max-w-sm w-full bg-card border border-error rounded-xl shadow-lg flex items-start p-4 gap-3 text-card-foreground z-50 transition-transform duration-300 ease-in-out animate-slide-in-bottom">
                <i class="fa-solid fa-circle-xmark text-error text-xl mt-1"></i>

                <div class="flex-1">
                    <div class=" text-error font-semibold text-sm mb-1">Error</div>
                    <p class="text-sm text-muted-foreground">{{ session('error') }}
                    </p>
                </div>

                <button class="cursor-pointer transition-colors duration-200 text-lg text-error hover:text-error/80" aria-label="Close"
                    onclick="this.parentElement.remove()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif
    </div>
@endif


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const duration = 5000; // 5 секунд

            document.querySelectorAll('.toast').forEach(toast => {
                setTimeout(() => {
                    toast.remove();
                }, duration);
            });
        });
    </script>
@endpush
