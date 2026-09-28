@if($paginator->hasPages())
<div class="pagination">
    @if($paginator->onFirstPage())<span class="disabled">‹ Prev</span>@else<a href="{{ $paginator->previousPageUrl() }}">‹ Prev</a>@endif
    @foreach($paginator->getUrlRange(max(1, $paginator->currentPage() - 2), min($paginator->lastPage(), $paginator->currentPage() + 2)) as $page => $url)
        @if($page == $paginator->currentPage())<span class="current">{{ $page }}</span>@else<a href="{{ $url }}">{{ $page }}</a>@endif
    @endforeach
    @if($paginator->hasMorePages())<a href="{{ $paginator->nextPageUrl() }}">Next ›</a>@else<span class="disabled">Next ›</span>@endif
</div>
@endif
