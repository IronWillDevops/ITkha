@if ($paginator->hasPages())
    <nav aria-label="Pagination" class="flex justify-center mt-4">
        <ul class="inline-flex items-center gap-1.5 text-sm">
            @php
                $baseClasses =
                    'w-8 h-8 flex items-center justify-center border font-semibold rounded-sm focus:outline-none focus:ring focus-visible:ring-ring';
                $activeClasses = 'bg-primary text-primary-foreground border-input';
                $inactiveClasses = 'bg-card border-input hover:bg-accent hover:text-accent-foreground';
            @endphp

            {{-- Previous Page Link --}}
            <li>
                @if ($paginator->onFirstPage())
                    <span class="{{ $baseClasses }} bg-card border-input opacity-50" aria-disabled="true">
                        <i class="fa-solid fa-angles-left"></i>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="{{ $baseClasses }} {{ $inactiveClasses }}"
                        aria-label="Previous page">
                        <i class="fa-solid fa-angles-left"></i>
                    </a>
                @endif
            </li>

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="px-2 select-none cursor-default">
                        {{ $element }}
                    </li>
                @endif

                {{-- Page Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="{{ $baseClasses }} {{ $activeClasses }}" aria-current="page">
                                {{ $page }}
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}" class="{{ $baseClasses }} {{ $inactiveClasses }}"
                                    aria-label="Go to page {{ $page }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            <li>
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="{{ $baseClasses }} {{ $inactiveClasses }}"
                        aria-label="Next page">
                        <i class="fa-solid fa-angles-right"></i>
                    </a>
                @else
                    <span class="{{ $baseClasses }} bg-card border-input opacity-50" aria-disabled="true">
                        <i class="fa-solid fa-angles-right"></i>
                    </span>
                @endif
            </li>
        </ul>
    </nav>
@endif
