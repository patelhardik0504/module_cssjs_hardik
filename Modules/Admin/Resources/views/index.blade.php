@extends('admin::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('admin.name') !!}
    </p>
    <input type="text" class="datetimepicker" />

@endsection

@push('scripts')   
    <script>
        $(".datetimepicker").each(function () {
            $(this).datetimepicker();
        });
    </script>
@endpush
