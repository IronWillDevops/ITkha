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

<div class="w-full">

    {{-- Поиск --}}
    @if ($searchEnabled)
        <form method="GET" class="mb-6 flex flex-wrap gap-2">
            <div class="relative flex-1 min-w-[220px]">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <i class="fa fa-search text-muted-foreground"></i>
                </div>

                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="{{ __('admin/common.fields.search') }}"
                    class="w-full text-sm border border-input rounded-lg px-3 py-2 ps-10 focus:ring focus:outline-none">
            </div>

            <input type="hidden" name="sort_field" value="{{ $sortField }}">
            <input type="hidden" name="sort_direction" value="{{ $sortDirection }}">

            <button class="px-4 py-2 bg-primary text-primary-foreground rounded-lg shadow hover:bg-primary/90">
                {{ __('admin/common.buttons.search') }}
            </button>

            @if (request('search') || request('sort_field'))
                <a href="{{ url()->current() }}"
                    class="px-4 py-2 bg-destructive text-destructive-foreground rounded-lg flex items-center">
                    <i class="fa fa-times"></i>
                </a>
            @endif
        </form>
    @endif

    {{-- TABLE (DESKTOP) --}}
    <div class="hidden md:block overflow-x-auto rounded-lg border border-input">
        <table class="w-full table-fixed border-collapse">
            <thead class="bg-muted">
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

                        <th class="px-4 py-3 text-left text-sm font-semibold truncate">
                            @if ($sortable)
                                <a href="{{ url()->current() . '?' . http_build_query($query) }}"
                                    class="flex items-center gap-1 truncate hover:underline">
                                    <span class="truncate">{{ $label }}</span>
                                    <span class="shrink-0 opacity-70">{!! sortIcon($isActive, $sortDirection) !!}</span>
                                </a>
                            @else
                                {{ $label }}
                            @endif
                        </th>
                    @endforeach

                    @if ($showView || $showEdit || $showDelete)
                        <th class="px-4 py-3 text-right text-sm font-semibold w-36">
                            {{ __('admin/common.fields.actions') }}
                        </th>
                    @endif
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($items as $item)
                    <tr class="hover:bg-muted cursor-pointer"
                        @if (Route::has($viewRoute)) onclick="window.location='{{ route($viewRoute, $item) }}'" @endif>
                        @foreach ($columns as $col)
                            @php
                                $value = data_get($item, $col['key']);
                            @endphp

                            <td class="px-4 py-2 text-sm truncate max-w-[240px]">
                                @if (is_iterable($value) && !is_string($value))
                                    <div class="flex flex-wrap gap-1">
                                        @foreach ($value as $tag)
                                            <span class="px-2 py-0.5 bg-muted rounded text-xs truncate max-w-[120px]">
                                                {{ data_get($tag, 'title') }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    {{ $value }}
                                @endif
                            </td>
                        @endforeach

                        @if ($showView || $showEdit || $showDelete)
                            <td class="px-4 py-2">
                                <div class="flex justify-end gap-2">
                                    @if ($showView)
                                        <a href="{{ route('public.' . $modelRoute . '.show', $item) }}"
                                            onclick="event.stopPropagation()"
                                            class="p-2 bg-background border rounded-lg hover:bg-muted">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    @endif

                                    @if ($showEdit)
                                        <a href="{{ route('admin.' . $modelRoute . '.edit', $item) }}"
                                            onclick="event.stopPropagation()"
                                            class="p-2 bg-background border rounded-lg hover:bg-muted">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endif

                                    @if ($showDelete)
                                        <form action="{{ route('admin.' . $modelRoute . '.delete', $item) }}"
                                            method="POST" class="contents" onclick="event.stopPropagation()"
                                            onsubmit="return confirm('{{ __('admin/common.messages.confirm_delete') }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 bg-destructive text-destructive-foreground rounded-lg hover:bg-destructive/80">
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
                        <td colspan="{{ count($columns) + 1 }}"
                            class="px-4 py-6 text-center text-sm text-muted-foreground">
                            {{ __('admin/common.messages.no_records') }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- MOBILE --}}
    <div class="md:hidden space-y-4">
        @forelse($items as $item)
            <div class="border rounded-lg overflow-hidden cursor-pointer hover:bg-muted">
                <div class="p-4 space-y-2 "
                    @if (Route::has($viewRoute)) onclick="window.location='{{ route($viewRoute, $item) }}'" @endif>
                    @foreach ($columns as $col)
                        <div>
                            <div class="text-xs text-muted-foreground">{{ $col['label'] }}</div>
                            <div class="text-sm font-medium truncate">
                                {{ data_get($item, $col['key']) ?? '-' }}
                            </div>
                        </div>
                    @endforeach
                </div>
                @if ($showView || $showEdit || $showDelete)
                    <div class="flex justify-end gap-2 p-3 border-t">
                        @if ($showView)
                            <a href="{{ route('public.' . $modelRoute . '.show', $item) }}"
                                class="p-2 bg-background border rounded-lg hover:bg-muted">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        @endif
                        @if ($showEdit)
                            <a href="{{ route('admin.' . $modelRoute . '.edit', $item) }}"
                                class="p-2 bg-background border rounded-lg hover:bg-muted">
                                <i class="fas fa-edit"></i>
                            </a>
                        @endif
                        @if ($showDelete)
                            <form action="{{ route('admin.' . $modelRoute . '.delete', $item) }}" method="POST"
                                onsubmit="return confirm('{{ __('admin/common.messages.confirm_delete') }}')">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="p-2 bg-destructive text-destructive-foreground rounded-lg hover:bg-destructive/80">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                @endif
            </div>
        @empty
            <div class="text-center text-sm text-muted-foreground">
                {{ __('admin/common.messages.no_records') }}
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if (method_exists($items, 'appends'))
        <div class="mt-4">
            {{ $items->appends(request()->except('page'))->links('vendor.pagination.pagination') }}
        </div>
    @endif
</div>
