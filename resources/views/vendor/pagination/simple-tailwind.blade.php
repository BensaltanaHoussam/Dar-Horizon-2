@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center space-x-2">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-2 bg-gray-200 text-gray-500 rounded-lg cursor-not-allowed">
                &larr;
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" 
               class="px-3 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition">
                &larr;
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-3 py-2 text-gray-500">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-2 bg-teal-500 text-white font-bold rounded-lg">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" 
                           class="px-3 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-teal-400 hover:text-white transition">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" 
               class="px-3 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition">
                &rarr;
            </a>
        @else
            <span class="px-3 py-2 bg-gray-200 text-gray-500 rounded-lg cursor-not-allowed">
                &rarr;
            </span>
        @endif
    </nav>
@endif

