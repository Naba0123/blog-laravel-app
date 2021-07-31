@php
if (!isset($page) || $page < 1) $page = 1;
if (!isset($maxPage) || $maxPage < 1) $maxPage = 1;

$links = pagination_buttons($page, $maxPage);

@endphp

<div class="lb-pagination-buttons">
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            @foreach ($links as $pageNum)
                <li class="page-item {{ $pageNum == $page ? 'disabled' : '' }}">
                    <a class="page-link lb-bg-gofun" href="?page={{ $pageNum }}">{{ $pageNum }}</a>
                </li>
            @endforeach
        </ul>
    </nav>
</div>
