@if ($paginator->hasPages())
    <nav class="mt-4">
        <ul class="pagination justify-content-center gap-2">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link rounded-pill border-0 px-3 py-2 shadow-sm">
                        ‹
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link rounded-pill border-0 px-3 py-2 shadow-sm text-success"
                       href="{{ $paginator->previousPageUrl() }}"
                       rel="prev">
                        ‹
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)

                {{-- Dots --}}
                @if (is_string($element))
                    <li class="page-item disabled">
                        <span class="page-link rounded-pill border-0">
                            {{ $element }}
                        </span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)

                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <span class="page-link rounded-pill border-0 px-3 py-2 shadow-sm bg-success">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link rounded-pill border-0 px-3 py-2 shadow-sm text-dark"
                                   href="{{ $url }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif

                    @endforeach
                @endif

            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link rounded-pill border-0 px-3 py-2 shadow-sm text-success"
                       href="{{ $paginator->nextPageUrl() }}"
                       rel="next">
                        ›
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link rounded-pill border-0 px-3 py-2 shadow-sm">
                        ›
                    </span>
                </li>
            @endif

        </ul>
    </nav>
@endif