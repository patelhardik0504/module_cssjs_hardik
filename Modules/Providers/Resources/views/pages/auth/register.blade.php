@extends('providers::layouts.master')

@section('content')
    
<register-component></register-component>
<script>
    window.csrfToken = "{{ csrf_token() }}";
</script>
@endsection
