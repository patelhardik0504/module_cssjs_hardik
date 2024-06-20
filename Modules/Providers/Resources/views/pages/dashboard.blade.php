@extends('providers::layouts.master')

@section('content')
  <h1>Dashboard</h1>
  
  <dashboard-component :user="{{ json_encode($user) }}"></dashboard-component>

    <script>
        window.csrfToken = "{{ csrf_token() }}";
    </script>
@endsection
