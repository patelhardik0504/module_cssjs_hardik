@extends('layout')
  
@section('content')
<component-b />  
<script>
    window.csrfToken = "{{ csrf_token() }}";
    window.posturl = "{{route('login.post')}}";
    window.redirectUrl = "{{route('dashboard')}}";
</script>
@endsection