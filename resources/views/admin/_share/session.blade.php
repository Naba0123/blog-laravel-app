@if($success = session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            $(document).Toasts('create', {
                class: 'bg-success',
                title: 'Success',
                body: '{{ $success }}'
            })
        });
    </script>
@endif

@if ($errors = session('custom_errors'))
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            @foreach ($errors as $error)
                $(document).Toasts('create', {
                    class: 'bg-danger',
                    title: 'Error',
                    body: '{{ $error }}'
                })
            @endforeach
        });
    </script>
@endif
