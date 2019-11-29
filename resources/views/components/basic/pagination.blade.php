@if ($paginator->hasPages())
    <ul class="pagination align-items-center" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled mr-3 pagination-previous" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="font-24 col-turq SofiaPro-Medium disabled" aria-hidden="true">Previous</span>
            </li>
        @else
            <li class="mr-3 pagination-previous">
                <a class="font-24 col-turq SofiaPro-Medium " href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">Previous</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="ml-3 pagination-previous">
                <a class="font-24 col-turq SofiaPro-Medium" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">Next</a>
            </li>
        @else
            <li class="ml-3 disabled pagination-next" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="font-24 col-turq SofiaPro-Medium disabled" aria-hidden="true">Next</span>
            </li>
        @endif
    </ul>
@endif