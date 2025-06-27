@if ($paginator->hasPages())
    <nav class="flex justify-center">
        <ul class="inline-flex items-center -space-x-px text-sm">
            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <li class="px-3 py-2 text-text-primary border border-border rounded-l">«</li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                       class="px-3 py-2  border border-border hover:bg-text-hover rounded-l">«</a>
                </li>
            @endif

            {{-- Numbers --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="px-3 py-2 text-text-primary">{{ $element }}</li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="px-3 py-2 bg-text-hover text-text-primary border border-border">
                                {{ $page }}
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                   class="px-3 py-2 text-text-primary border border-border hover:bg-text-hover">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                       class="px-3 py-2 text-text-primary border border-border hover:bg-text-hover rounded-r">»</a>
                </li>
            @else
                <li class="px-3 py-2 text-text-primary border border-border rounded-r">»</li>
            @endif
        </ul>
    </nav>
@endif
