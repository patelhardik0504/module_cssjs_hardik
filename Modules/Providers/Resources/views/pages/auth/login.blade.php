@extends('providers::layouts.master')

@section('content')

   <login-component></login-component>
   <script>
      window.csrfToken = "{{ csrf_token() }}";
  </script>
@endsection
