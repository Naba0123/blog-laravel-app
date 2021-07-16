<div class="lb-navigation">
    @if(isset($prev['url']))
        <a class="btn btn-outline-secondary" href="{{ $prev['url'] }}">
            <i class="fa fa-angle-left"></i> {{ $prev['name'] ?? 'Prev' }}
        </a>
    @else
        <div></div>
    @endif

    @if(isset($next['url']))
        <a class="btn btn-outline-secondary" href="{{ $next['url'] }}">
            {{ $next['name'] ?? 'Next' }} <i class="fa fa-angle-right"></i>
        </a>
    @else
        <div></div>
    @endif
</div>
