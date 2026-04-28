@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation">
        <div class="custom-pagination">
            @if ($paginator->onFirstPage())
                <span class="page-btn page-disabled">Previous</span>
            @else
                <a class="page-btn page-nav" href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="page-ellipsis">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="page-btn page-active">{{ $page }}</span>
                        @else
                            <a class="page-btn page-number" href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a class="page-btn page-nav" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a>
            @else
                <span class="page-btn page-disabled">Next</span>
            @endif
        </div>
    </nav>
@endif
