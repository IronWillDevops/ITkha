@if ($paginator->hasPages())
    <nav class="flex justify-center">
        <ul class="inline-flex items-center -space-x-px gap-1.5 text-sm">
            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <li
                    class="w-8 h-8 justify-center bg-card border border-input focus-visible:ring-ring font-semibold rounded-sm flex items-center">
                    «</li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                        class="w-8 h-8 justify-center bg-card border border-input hover:bg-accent hover:text-accent-foreground focus:ring focus:outline-none focus-visible:ring-ring font-semibold rounded-sm flex items-center">«</a>
                </li>
            @endif

            {{-- Numbers --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="w-8 h-8 justify-center  font-semibold rounded-sm flex items-center">{{ $element }}
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li
                                class="w-8 h-8 justify-center bg-primary text-primary-foreground border border-input focus-visible:ring-ring font-semibold rounded-sm flex items-center">
                                {{ $page }}
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                    class="w-8 h-8 justify-center bg-card border border-input hover:bg-accent hover:text-accent-foreground  focus:ring focus:outline-none focus-visible:ring-ring font-semibold rounded-sm flex items-center">
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
                        class="w-8 h-8 justify-center bg-card border border-input hover:bg-accent hover:text-accent-foreground focus:ring focus:outline-none focus-visible:ring-ring font-semibold rounded-sm flex items-center">»</a>
                </li>
            @else
                <li
                    class="w-8 h-8 justify-center bg-card border border-input focus-visible:ring-ring font-semibold rounded-sm flex items-center">
                    »</li>
            @endif
        </ul>
    </nav>
@endif
