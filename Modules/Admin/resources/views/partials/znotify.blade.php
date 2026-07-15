@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/js/iziToast.min.js') }}"></script>

@if(session()->has('notify'))
    @foreach(session('notify') as $msg)
        <script>
            "use strict";
            iziToast.{{ $msg[0] }}({ message: "{{ __($msg[1]) }}", position: "topRight" });
        </script>
    @endforeach
@endif

@if($errors->any())
    @php $uniqueErrors = collect($errors->all())->unique(); @endphp
    <script>
        "use strict";
        @foreach($uniqueErrors as $error)
        iziToast.error({ message: '{{ addslashes(__($error)) }}', position: "topRight" });
        @endforeach
    </script>
@endif

@endpush
