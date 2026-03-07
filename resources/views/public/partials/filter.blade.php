<div class="w-full bg-card text-card-foreground border border-border p-6 mb-6 shadow rounded-lg">
    <form method="GET" action="{{ route('public.post.index') }}" id="filter-form"
        class="flex flex-wrap gap-4 items-center">

        <div class="relative flex-grow min-w-52 items-end">
            <x-form.input 
                type="search" 
                name="search" 
                value="{{ request('search') }}"
                label="{{ __('public/filter.fields.search') }}"
                placeholder="{{ __('public/filter.placeholder.search') }}" 
                icon="fa fa-search" 
            />
        </div>

        <div class="mt-2">
            <!-- Кнопка направления сортировки -->
            <button type="button"
                class="btn btn-shimmer"
                title="{{ __('public/filter.buttons.sort') }}"
                onclick="toggleSortDir()">

                @if (request('sort_dir') === 'desc')
                    <i class="fas fa-sort-alpha-down-alt"></i>
                @else
                    <i class="fas fa-sort-alpha-down"></i>
                @endif

            </button>
        </div>

        <div class="mt-2">
            <a href="{{ route('public.post.index') }}"
                class="btn btn-danger btn-shimmer"
                title="{{ __('public/filter.buttons.reset') }}">
                <i class="fa fa-times"></i>
            </a>
        </div>

    </form>

    <div>
        @error('search')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>

</div>

<script>
    // задержка отправки формы при вводе поиска
    let debounceTimeout;

    function submitFormDebounced() {
        clearTimeout(debounceTimeout);
        debounceTimeout = setTimeout(() => {
            document.getElementById('filter-form').submit();
        }, 500);
    }

    // переключение направления сортировки
    function toggleSortDir() {

        const urlParams = new URLSearchParams(window.location.search);
        const currentDir = urlParams.get('sort_dir') || 'asc';
        const newDir = currentDir === 'asc' ? 'desc' : 'asc';

        urlParams.set('sort_dir', newDir);

        const baseUrl = window.location.origin + window.location.pathname;
        const newUrl = baseUrl + '?' + urlParams.toString();

        window.location.href = newUrl;
    }
</script>