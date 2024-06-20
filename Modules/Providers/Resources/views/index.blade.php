@extends('providers::layouts.master')

@section('content')
    
Welcome to providers

<a href="{{route('providers.login')}}">Login</a>
</br>
<a href="{{route('provider.register')}}">Register</a>

@endsection
