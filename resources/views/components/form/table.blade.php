@php
    function sortIcon($active, $direction)
    {
        if (!$active) {
            return '<i class="fa-solid fa-sort text-xs"></i>';
        }
        return $direction === 'asc'
            ? '<i class="fa-solid fa-sort-up text-xs"></i>'
            : '<i class="fa-solid fa-sort-down text-xs"></i>';
    }
    $viewRoute = 'admin.' . $modelRoute . '.show';

@endphp



<div class="rounded-lg">

    {{-- Поиск --}}
    @if ($searchEnabled)
        <form method="GET" class="mb-6 flex flex-wrap gap-2">

            <div class="relative w-full sm:w-auto flex-1 min-w-52 mb-2">

                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                    <i class="fa fa-search"></i>
                </div>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="{{ __('admin/common.fields.search') }}"
                    class="w-full text-sm caret-primary border border-input rounded-lg px-3 py-2 ps-10 p-2.5 focus:ring focus:outline-none focus-visible:ring-ring">
            </div>

            <input type="hidden" name="sort_field" value="{{ $sortField }}">
            <input type="hidden" name="sort_direction" value="{{ $sortDirection }}">

            <button
                class="px-4 py-2 bg-primary text-primary-foreground hover:bg-primary/90 transition rounded-lg shadow">
                {{ __('admin/common.buttons.search') }}
            </button>

            @if (request('search') || request('sort_field'))
                <a href="{{ url()->current() }}"
                    class="px-4 py-2 bg-destructive text-destructive-foreground hover:bg-destructive/80 rounded-lg flex items-center">
                    <i class="fa fa-times"></i>
                </a>
            @endif

        </form>
    @endif


    {{-- Таблица (desktop) --}}
    <div class="hidden md:block overflow-x-auto rounded-lg shadow">
        <table class="min-w-full divide-y overflow-x-auto">
            <thead>
                <tr>
                    @foreach ($columns as $col)
                        @php
                            $key = $col['key'];
                            $label = $col['label'];
                            $sortable = $col['sortable'] ?? true;

                            $isActive = $sortField === $key;
                            $nextDir = $isActive && $sortDirection === 'asc' ? 'desc' : 'asc';

                            $query = array_merge(request()->query(), [
                                'sort_field' => $key,
                                'sort_direction' => $nextDir,
                            ]);
                        @endphp

                        <th class="px-4 py-2 text-left text-sm font-semibold whitespace-nowrap">
                            @if ($sortable)
                                <a href="{{ url()->current() . '?' . http_build_query($query) }}"
                                    class="flex items-center gap-1 hover:underline">
                                    {{ $label }}
                                    <span class="text-xs opacity-70">{!! sortIcon($isActive, $sortDirection) !!}</span>
                                </a>
                            @else
                                {{ $label }}
                            @endif
                        </th>
                    @endforeach
                    @if ($showView || $showEdit || $showDelete)
                        <th class="px-4 py-2 text-center text-sm font-semibold whitespace-nowrap">
                            {{ __('admin/common.fields.actions') }}
                        </th>
                    @endif

                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($items as $item)
                    <tr class="hover:bg-muted cursor-pointer"
                        @if (Route::has($viewRoute)) onclick="window.location='{{ route('admin.' . $modelRoute . '.show', $item) }}'" @endif>

                        @foreach ($columns as $col)
                            @php
                                $value = data_get($item, $col['key']);
                            @endphp

                            <td class="px-4 py-2 text-sm whitespace-nowrap ">
                                @if (is_iterable($value) && !is_string($value))
                                    @forelse($value as $tag)
                                        <span class="inline-block px-2 py-0.5 rounded-lg text-xs">
                                            {{ data_get($tag, 'title') }}
                                        </span>
                                    @empty
                                        <span class="text-xs">-</span>
                                    @endforelse
                                @else
                                    {{ $value }}
                                @endif
                            </td>
                        @endforeach
                        @if ($showView || $showEdit || $showDelete)
                            <td class="px-4 py-2 text-sm text-right">
                                <div class="flex justify-end gap-2">

                                    @if ($showView)
                                        <a href="{{ route('public.' . $modelRoute . '.show', $item) }}"
                                            onclick="event.stopPropagation()"
                                            class="bg-background inline-flex border items-center p-2 rounded-lg hover:bg-muted">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    @endif

                                    @if ($showEdit)
                                        <a href="{{ route('admin.' . $modelRoute . '.edit', $item) }}"
                                            onclick="event.stopPropagation()"
                                            class="bg-background inline-flex border items-center p-2 rounded-lg hover:bg-muted">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endif

                                    @if ($showDelete)
                                        <form action="{{ route('admin.' . $modelRoute . '.delete', $item) }}"
                                            method="POST" class="contents" onclick="event.stopPropagation()"
                                            onsubmit="return confirm('{{ __('admin/common.messages.confirm_delete') }}')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex border items-center p-2 bg-destructive text-destructive-foreground rounded-lg hover:bg-destructive/80">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    @endif

                                </div>
                            </td>
                        @endif

                    </tr>

                    @empty
                        <tr>
                            <td colspan="{{ count($columns) + 1 }}" class="px-4 py-6 text-center text-sm">
                                {{ __('admin/common.messages.no_records') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        {{-- Мобильный вид — карточки --}}
        <div class="md:hidden space-y-4">
            @forelse($items as $item)

                {{-- Верхняя часть карточки — кликабельная --}}
                <div class="border border-input rounded-lg shadow-sm overflow-hidden">

                    <div @if (Route::has($viewRoute)) onclick="window.location='{{ route('admin.' . $modelRoute . '.show', $item) }}'" @endif
                        class="p-4 cursor-pointer hover:bg-muted transition">

                        @foreach ($columns as $col)
                            @php
                                $value = data_get($item, $col['key']);
                            @endphp

                            <div class="mb-2">
                                <div class="text-xs text-muted-foreground">{{ $col['label'] }}</div>

                                <div class="text-sm font-medium">
                                    @if (is_iterable($value) && !is_string($value))
                                        @forelse($value as $tag)
                                            <span class="inline-block px-2 py-0.5 bg-muted rounded text-xs">
                                                {{ data_get($tag, 'title') }}
                                            </span>
                                        @empty
                                            <span class="text-xs">-</span>
                                        @endforelse
                                    @else
                                        {{ $value }}
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Кнопки действий — НЕ внутри кликабельной зоны --}}

                    <div class="flex justify-end gap-3 p-3 border-t border-input">
                        @if ($showView)
                            <a href="{{ route('public.' . $modelRoute . '.show', $item) }}"
                                class="px-4 py-2 bg-background border-input hover:bg-accent hover:text-accent-foreground rounded-sm shadow transition">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        @endif
                        @if ($showEdit)
                            <a href="{{ route('admin.' . $modelRoute . '.edit', $item) }}"
                                class="px-4 py-2 bg-background border-input hover:bg-accent hover:text-accent-foreground rounded-sm shadow transition">
                                <i class="fas fa-edit"></i>
                            </a>
                        @endif
                        @if ($showDelete)
                            <form action="{{ route('admin.' . $modelRoute . '.delete', $item) }}" method="POST"
                                onsubmit="return confirm('{{ __('admin/common.messages.confirm_delete') }}')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="px-4 py-2 bg-destructive text-destructive-foreground hover:bg-destructive/80 rounded-sm shadow transition">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        @endif
                    </div>


                </div>

                @empty
                    <div class="text-center text-sm text-muted-foreground">
                        {{ __('admin/common.messages.no_records') }}
                    </div>
                @endforelse
            </div>



            {{-- Пагинация --}}
            @if (method_exists($items, 'appends'))
                <div class="mt-4">
                    {{ $items->appends(request()->except('page'))->links('vendor.pagination.pagination') }}
                </div>
            @endif
        </div>
