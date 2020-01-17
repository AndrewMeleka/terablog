@if ($paginator->hasPages())
    <div class="d-flex mt-5">
            {{-- Previous Page Link --}}
            @if (!$paginator->onFirstPage())
                <div class="mr-auto">
                    <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-dark btn-lg px-5" rel="prev">@lang('pagination.previous')</a>
                </div>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <div class="ml-auto">
                    <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-dark btn-lg px-5" data-aos="fade-left" data-aos-delay="1000">@lang('pagination.next')</a>
                <div class="ml-auto">
            @endif
    </div>
@endif


