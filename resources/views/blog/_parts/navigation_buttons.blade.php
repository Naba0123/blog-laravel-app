<div class="lb-navigation">
    @if(isset($prev['url']))
        <a class="btn btn-outline-secondary" href="{{ $prev['url'] }}">
            @php $name = isset($prev['name']) ? omit_markdown_str($prev['name'], 30) : 'Prev'; @endphp
            <i class="fa fa-angle-left"></i> {!! $name !!}
        </a>
    @else
        <div></div>
    @endif

    @if(isset($next['url']))
        <a class="btn btn-outline-secondary" href="{{ $next['url'] }}">
            @php $name = isset($next['name']) ? omit_markdown_str($next['name'], 30) : 'Next'; @endphp
            {!! $name !!} <i class="fa fa-angle-right"></i>
        </a>
    @else
        <div></div>
    @endif
</div>
