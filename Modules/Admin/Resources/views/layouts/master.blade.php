<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Module Admin</title>

       <link rel="stylesheet" href="{{ asset('/build-admin/css/app.css') }}">

       <link rel="stylesheet" href="{{ asset('/build-admin/css/jquery.datetimepicker.min.css') }}">

       <script src="{{ asset('/build-admin/js/jquery.min.js') }}"></script>
        
        <script src="{{ asset('/build-admin/js/moment.js') }}"></script>
        <script src="{{ asset('/build-admin/js/jquery.datetimepicker.full.min.js') }}"></script>
@vite('Resources/assets/css/app.css')
    </head>
    <body>
        @yield('content')
       
       
        @stack('scripts')
        
    </body>
</html>
