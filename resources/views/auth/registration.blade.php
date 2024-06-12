@extends('layout')
  
@section('content')

<component-a />  
<script>
    window.csrfToken = "{{ csrf_token() }}";
    window.posturl = "{{route('register.post')}}";
    window.redirectUrl = "{{route('login')}}";
</script>
@endsection