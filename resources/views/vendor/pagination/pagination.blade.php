@if ($paginator->hasPages())
    <nav aria-label="Pagination" class="flex justify-center mt-4">
        <ul class="inline-flex items-center gap-1.5 text-sm">

            {{-- Previous --}}
            <li>
                @if ($paginator->onFirstPage())
                    <span class="pagination-item pagination-item-disabled" aria-disabled="true">
                        <i class="fa-solid fa-angles-left"></i>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}"
                       class="pagination-item pagination-item-inactive btn-shimmer"
                       aria-label="Previous page">
                        <i class="fa-solid fa-angles-left"></i>
                    </a>
                @endif
            </li>

            {{-- Pages --}}
            @foreach ($elements as $element)

                @if (is_string($element))
                    <li class="pagination-item pagination-item-disabled select-none">
                        {{ $element }}
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li>
                            @if ($page == $paginator->currentPage())
                                <span class="pagination-item pagination-item-active" aria-current="page">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}"
                                   class="pagination-item pagination-item-inactive btn-shimmer"
                                   aria-label="Go to page {{ $page }}">
                                    {{ $page }}
                                </a>
                            @endif
                        </li>
                    @endforeach
                @endif

            @endforeach

            {{-- Next --}}
            <li>
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}"
                       class="pagination-item pagination-item-inactive btn-shimmer"
                       aria-label="Next page">
                        <i class="fa-solid fa-angles-right"></i>
                    </a>
                @else
                    <span class="pagination-item pagination-item-disabled" aria-disabled="true">
                        <i class="fa-solid fa-angles-right"></i>
                    </span>
                @endif
            </li>

        </ul>
    </nav>
@endif