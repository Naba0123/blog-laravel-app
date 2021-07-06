@hasSection('exception')
    @php
        /** @var Exception $exception */
        $exception = session('exception')
    @endphp
    <div class="card card-{{ $_sessionExceptionType }}">
        <div class="card-body">
            <ul>
                <li>{{ $exception->getMessage() }}</li>
            </ul>
        </div>
    </div>
@endif

    @hasSection('success')
        @php
            $sessionData = session('success')
        @endphp
    @endif
