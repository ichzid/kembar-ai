<div class="flex items-center gap-2">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <span class="text-[13px] font-semibold text-gray-400 opacity-60 shrink-0 select-none">&lt; Previous</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="text-[13px] font-semibold text-gray-400 hover:text-[#8cb400] transition-colors shrink-0">&lt; Previous</a>
    @endif

    {{-- Pagination Elements --}}
    <div class="flex items-center gap-4 mx-3">
        @if(count($elements) > 0)
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="text-[13px] font-semibold text-gray-400">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="text-[13px] font-bold text-[#8cb400] select-none">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="text-[13px] font-semibold text-gray-600 hover:text-[#8cb400]">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        @else
            <span class="text-[13px] font-bold text-[#8cb400] select-none">1</span>
        @endif
    </div>

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="text-[13px] font-semibold text-[#8cb400] hover:text-[#7a9d00] transition-colors shrink-0">Next &gt;</a>
    @else
        <span class="text-[13px] font-semibold text-[#8cb400] opacity-60 shrink-0 select-none">Next &gt;</span>
    @endif
</div>
