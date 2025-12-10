<div class="w-full bg-card text-card-foreground border border-border p-6 mb-6 shadow rounded-lg">
    <form method="GET" action="{{ route('public.post.index') }}" id="filter-form"
        class=" flex flex-wrap gap-4 items-center">
        <div class="relative flex-grow min-w-52 ">
            <div class="">
                <x-form.input type="search" name="search" value="{{ request('search') }}"
                    placeholder="{{ __('public/filter.placeholder.search') }}" icon="fa fa-search " />
            </div>
        </div>
        <div class="mb-4">
            <!-- Кнопка напрямку сортування (asc/desc) -->
            <button type="button"
                class="border-border border focus:ring focus:outline-none focus-visible:ring-ring text-foreground rounded px-3 py-2 flex items-center justify-center h-10 hover:bg-accent "
                title="{{ __('public/filter.buttons.sort') }}" onclick="toggleSortDir()">
                @if (request('sort_dir') === 'desc')
                    <i class="fas fa-sort-alpha-down-alt"></i>
                @else
                    <i class="fas fa-sort-alpha-down"></i>
                @endif
            </button>
        </div>

        <!-- Кнопка скидання фільтрів з іконкою -->

        <div class="mb-4">
            <a href="{{ route('public.post.index') }}"
                class="border-border border bg-destructive text-destructive-foreground hover:bg-destructive/80 focus:ring focus:outline-none focus-visible:ring-ring px-3 py-2 rounded  flex items-center justify-center h-10 "
                title="{{ __('public/filter.buttons.reset') }}">
                <i class="fa fa-times "></i>
            </a>
        </div>
    </form>

    <div>
        @error('search')
            <p class="text-error">{{ $message }}</p>
        @enderror
    </div>



    @php
        $query = request()->query();
    @endphp

    @if (count($query))
        <div class="mt-4 flex flex-wrap gap-4">

            @php
                // Загальний стиль для всіх елементів фільтра
                $filterItemClasses = 'border-border border rounded-2xl px-3 py-1 flex items-center space-x-2';
                $filterItemHover =
                    'hover:text-error/80 font-semibold focus:ring focus:outline-none focus-visible:ring-ring';
            @endphp

            {{-- search --}}
            @if (request('search'))
                @php
                    $newQuery = $query;
                    unset($newQuery['search']);
                    $url = url()->current() . (count($newQuery) ? '?' . http_build_query($newQuery) : '');
                @endphp
                <div class="{{ $filterItemClasses }}">
                    <span>{{ request('search') }}</span>

                    <a href="{{ $url }}" class="cursor-pointer {{ $filterItemHover }}">✕</a>
                </div>
            @endif
        </div>
    @endif
</div>
<script>
    // Затримка для сабміта форми при вводі пошуку
    let debounceTimeout;

    function submitFormDebounced() {
        clearTimeout(debounceTimeout);
        debounceTimeout = setTimeout(() => {
            document.getElementById('filter-form').submit();
        }, 500);
    }

    const searchInput = document.getElementById('search-input');

    // Переключення напрямку сортування
    function toggleSortDir() {
        const urlParams = new URLSearchParams(window.location.search);
        const currentDir = urlParams.get('sort_dir') || 'asc';
        const newDir = currentDir === 'asc' ? 'desc' : 'asc';
        urlParams.set('sort_dir', newDir);

        // Зберігаємо інші параметри форми
        // І формуємо нову URL-строку
        const baseUrl = window.location.origin + window.location.pathname;
        const newUrl = baseUrl + '?' + urlParams.toString();

        // Переходимо на оновлений URL
        window.location.href = newUrl;
    }
</script>
