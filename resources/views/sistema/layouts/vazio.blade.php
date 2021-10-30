<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="_token" content="{{ csrf_token() }}">

        <title>88 Market</title>

        <!-- Fonts -->
        <link href="//fonts.googleapis.com/css?family=Tajawal:300,400,500,700,800,900" rel="stylesheet" />
        <link href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet" />

        <!-- Styles -->
        <link href="{{assets('fontawesome/css/all.min.css')}}" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"  rel="stylesheet" />
        <link href="//cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.css" rel="stylesheet" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" rel="stylesheet" />
        <link href="//unpkg.com/flickity@2/dist/flickity.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="{{assets('node_modules/sweetalert2/dist/sweetalert2.css')}}">
        <link href="{{ assets('sistema/css/commom.css') }}" rel="stylesheet" />
        <link href="{{ assets('sistema/css/app.css') }}" rel="stylesheet" />
        <link href="{{ assets('sistema/css/dash/app.css') }}" rel="stylesheet" />
        
        @yield('styles')
    </head>

    <body>

        <div class="app">
            @yield('content')
        </div>


        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="//stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
        <script src="//cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
        <script src="//unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
        <script src="{{assets('node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
        <script src="{{ assets('sistema/js/app.js') }}"></script>
        @yield('scripts')
    </body>
</html>
