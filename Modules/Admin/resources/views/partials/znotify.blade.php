@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}">
@endpush
@push('scripts')
<script src="{{ asset('assets/js/iziToast.min.js') }}"></script>

@if(session()->has('success'))
    @php
        $msg = session('success')
    @endphp
        <script> 
        alert('as')
        iziToast.success({message: {{ $msg }}, position: "topRight"}); 
        </script>

@endif


@if(session()->has('notify'))
    @foreach(session('notify') as $msg)
        <script> 
            "use strict";
            iziToast.{{ $msg[0] }}({message:"{{ __($msg[1]) }}", position: "topRight"}); 
        </script>
    @endforeach
@endif

@if ($errors->any())
    @php
        $collection = collect($errors->all());
        $errors = $collection->unique();
    @endphp

    <script>
        "use strict";
        @foreach ($errors as $error)
        iziToast.error({
            message: '{{ __($error) }}',
            position: "topRight"
        });
        @endforeach
    </script>

@endif
<script>
    "use strict";

    function notify(status, message) {
        if (typeof message == 'string') {
            iziToast[status]({
                message: message,
                position: "topRight"
            });
        } else {
            $.each(message, function(i, val) {
                iziToast[status]({
                    message: val,
                    position: "topRight"
                });
            });
        }
    }
</script>
@endpush