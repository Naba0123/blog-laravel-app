<div class="lb-navigation">
    @if(isset($backUrl) && $backUrl)
        <a class="btn btn-outline-secondary" href="{{ $backUrl }}">Back</a>
    @else
        <div></div>
    @endif

    @if(isset($nextUrl) && $nextUrl)
        <a class="btn btn-outline-secondary">Next</a>
    @else
        <div></div>
    @endif
</div>
