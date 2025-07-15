<div class="w-full bg-surface  border border-border text-text-primary p-6 mb-6 shadow rounded-lg">
    <form method="GET" action="{{ route('public.post.index') }}" id="filter-form"
        class=" flex flex-wrap gap-4 items-center">
        <div class="relative flex-grow min-w-52 ">
            <div class="">
                <input type="search" name="search" value="{{ request('search') }}"
                    placeholder="{{ __('filter.search') }}"
                    class="filter filter-hover w-full rounded px-3 py-2 pl-10 " autocomplete="off" id="search-input" />
                <i class="fa fa-search absolute left-3 top-1/2 -translate-y-1/2 "></i>
            </div>
        </div>

        <!-- Категорія (вибір одного елемента через dropdown із чекбоксами) -->
        <div class="relative">
            <button type="button" class="filter filter-hover  rounded px-3 py-2 flex items-center space-x-2 h-10"
                onclick="document.getElementById('category-dropdown').classList.toggle('hidden')" aria-haspopup="true"
                aria-expanded="false">
                <span>{{ __('filter.category') }}</span>
                <i class="fa fa-angle-down "></i>
            </button>

            <div id="category-dropdown"
                class="bg-surface border hidden absolute z-10 mt-1 w-48  p-3 rounded shadow max-h-60 overflow-auto">
                <label class="flex items-center px-3 py-1 filter-item cursor-pointer select-none">
                    <input type="radio" name="category" value=""
                        onchange="document.getElementById('filter-form').submit()" class="mr-2"
                        {{ request('category') === null || request('category') === '' ? 'checked' : '' }} />
                    <span>{{ __('filter.all_category') }}</span>
                </label>
                @foreach ($categories as $category)
                    <label class="flex items-center px-3 py-1 filter-item cursor-pointer select-none">
                        <input type="radio" name="category" value="{{ $category->title }}"
                            onchange="document.getElementById('filter-form').submit()" class=" mr-2"
                            {{ request('category') == $category->title ? 'checked' : '' }} />
                        <span>{{ $category->title }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Теги у вигляді dropdown з чекбоксами -->
        <div class="relative" style="position: relative;">
            <button type="button" class="filter filter-hover  rounded px-3 py-2 flex items-center space-x-2 h-10"
                onclick="document.getElementById('tags-dropdown').classList.toggle('hidden')" aria-haspopup="true"
                aria-expanded="false">
                <span>{{ __('filter.tag') }}</span>
                <i class="fa fa-angle-down"></i>
            </button>
            <div id="tags-dropdown"
                class="hidden absolute z-10 mt-1 w-48 bg-surface border p-3 rounded shadow max-h-60 overflow-auto">
                @foreach ($tags as $tag)
                    <label class="flex items-center px-3 py-1 filter-item cursor-pointer select-none">
                        <input type="checkbox" name="tags[]" value="{{ $tag->title }}"
                            onchange="document.getElementById('filter-form').submit()" class="mr-2 "
                            {{ collect(request('tags'))->contains($tag->title) ? 'checked' : '' }} />
                        <span>{{ $tag->title }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Сортування: поле з кнопкою іконкою -->
        <div class="relative ">
            <button type="button" onclick="document.getElementById('sort-by-dropdown').classList.toggle('hidden')"
                class="filter filter-hover rounded px-3 py-2 flex  items-center justify-center h-10"
                aria-haspopup="true" aria-expanded="false" title="{{ __('filter.sort.label') }}">
                <i class="fa fa-list"></i>
            </button>
            <select name="sort_by" id="sort-by-dropdown"
                class="hidden absolute z-20 mt-1 w-48 rounded shadow bg-surface border p-3"
                onchange="document.getElementById('filter-form').submit()" size="4" style="cursor:pointer;">
                <option class="filter-item" value="id" {{ request('sort_by') == 'id' ? 'selected' : '' }}>
                    {{ __('filter.sort.options.id') }}</option>
                <option class="filter-item" value="title" {{ request('sort_by') == 'title' ? 'selected' : '' }}>{{ __('filter.sort.options.title') }}
                </option>
                <option class="filter-item" value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>
                    {{ __('filter.sort.options.create_at') }}
                </option>
            </select>
        </div>

        <!-- Кнопка напрямку сортування (asc/desc) -->
        <button type="button" class="filter filter-hover  rounded px-3 py-2 flex items-center justify-center h-10"
            title="{{ __('filter.sort.direction') }}" onclick="toggleSortDir()">
            @if (request('sort_dir') === 'desc')
                <i class="fas fa-sort-alpha-down-alt"></i>
            @else
                <i class="fas fa-sort-alpha-down"></i>
            @endif
        </button>

        <!-- Кнопка скидання фільтрів з іконкою -->
        <a href="{{ route('public.post.index') }}"
            class="filter filter-hover  px-3 py-2 rounded  flex items-center justify-center h-10"
            title="{{ __('filter.reset') }}">
            <i class="fa fa-times icon-danger"></i>
        </a>

    </form>

    <div>
        @error('search')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>



    @php
        $query = request()->query();
    @endphp

    @if (count($query))
        <div class="mt-4 flex flex-wrap gap-4">

            @php
                // Загальний стиль для всіх елементів фільтра
                $filterItemClasses = 'text border rounded-2xl px-3 py-1 flex items-center space-x-2';
                $filterItemHover = 'hover:text-text-danger font-semibold';
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

            {{-- category --}}
            @if (request('category'))
                @php
                    $newQuery = $query;
                    unset($newQuery['category']);
                    $url = url()->current() . (count($newQuery) ? '?' . http_build_query($newQuery) : '');
                @endphp
                <div class="{{ $filterItemClasses }}">
                    <span>{{ request('category') }}</span>
                    <a href="{{ $url }}" class="cursor-pointer {{ $filterItemHover }}">✕</a>
                </div>
            @endif

            {{-- tags --}}
            @if (request('tags'))
                @foreach ((array) request('tags') as $tag)
                    @php
                        $newQuery = $query;
                        if (isset($newQuery['tags']) && is_array($newQuery['tags'])) {
                            $newQuery['tags'] = array_filter($newQuery['tags'], fn($v) => $v !== $tag);
                            if (empty($newQuery['tags'])) {
                                unset($newQuery['tags']);
                            }
                        }
                        $url = url()->current() . (count($newQuery) ? '?' . http_build_query($newQuery) : '');
                    @endphp
                    <div class="{{ $filterItemClasses }}">
                        <span>{{ $tag }}</span>
                        <a href="{{ $url }}" class="cursor-pointer {{ $filterItemHover }}">✕</a>
                    </div>
                @endforeach
            @endif

            {{-- sort_by --}}
            @if (request('sort_by'))
                @php
                    $newQuery = $query;
                    unset($newQuery['sort_by']);
                    $url = url()->current() . (count($newQuery) ? '?' . http_build_query($newQuery) : '');
                @endphp
                <div class="{{ $filterItemClasses }}">
                    <span>{{ request('sort_by') }}</span>
                    <a href="{{ $url }}" class="cursor-pointer {{ $filterItemHover }}">✕</a>
                </div>
            @endif

        </div>
    @endif
</div>
<script>
    // Закриваємо dropdown, якщо клік поза ним
    document.addEventListener('click', function(event) {
        const categoryDropdown = document.getElementById('category-dropdown');
        const categoryButton = categoryDropdown.previousElementSibling;
        if (!categoryDropdown.contains(event.target) && !categoryButton.contains(event.target)) {
            categoryDropdown.classList.add('hidden');
        }
        const tagsDropdown = document.getElementById('tags-dropdown');
        const tagsButton = tagsDropdown.previousElementSibling;
        if (!tagsDropdown.contains(event.target) && !tagsButton.contains(event.target)) {
            tagsDropdown.classList.add('hidden');
        }

        const sortByDropdown = document.getElementById('sort-by-dropdown');
        const sortByButton = sortByDropdown.previousElementSibling;
        if (!sortByDropdown.contains(event.target) && !sortByButton.contains(event.target)) {
            sortByDropdown.classList.add('hidden');
        }
    });

    // Затримка для сабміта форми при вводі пошуку
    let debounceTimeout;

    function submitFormDebounced() {
        clearTimeout(debounceTimeout);
        debounceTimeout = setTimeout(() => {
            document.getElementById('filter-form').submit();
        }, 500);
    }

    const searchInput = document.getElementById('search-input');

    searchInput.addEventListener('blur', () => {
        document.getElementById('filter-form').submit();
    });

    searchInput.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') {
            event.preventDefault();
            document.getElementById('filter-form').submit();
        }
    });

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
