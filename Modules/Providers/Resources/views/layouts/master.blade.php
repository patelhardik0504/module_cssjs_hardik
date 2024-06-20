<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Module Providers</title>

    
       
    </head>
    <body>
        <div id="app" >
            <header-component></header-component>
            @yield('content')    
            <footer-component></footer-component>       
        </div>

        {{-- Laravel Vite - JS File --}}
        


        <script src="{{ asset('/build-providers/assets/app.e8482c9a.js') }}"></script>
    </body>
</html>
