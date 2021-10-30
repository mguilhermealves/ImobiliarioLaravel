<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="_token" content="{{ csrf_token() }}">
        <title>{{$title}} - {{ config('app.name', 'Asserttem') }}</title>
        <link rel="icon" href="favicon.ico" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
          
          <link href="{{assets('site/css/commom.css')}}" rel="stylesheet"/>
        
      <link href="{{assets('site/css/fancybox.css')}}" rel="stylesheet"/>
      <link href="{{assets('site/css/animate.css')}}" rel="stylesheet"/>
      <link rel="stylesheet" type="text/css" href="{{assets('site/js/slick/slick.css')}}"/>
          <link rel="stylesheet" type="text/css" href="{{assets('site/js/slick/slick-theme.css')}}"/>
          <link href="{{assets('site/css/style.css')}}" rel="stylesheet"/>
          <link href="{{assets('site/css/responsive.css')}}" rel="stylesheet"/>
  
      <script src="https://kit.fontawesome.com/bc1635eac6.js" crossorigin="anonymous"></script>
      <script type="text/javascript" src="{{assets('site/js/slick/slick.min.js')}}"></script>
      <script src="{{assets('site/js/jquery.mask.js')}}"></script>        
      <script src="{{assets('site/js/wow.js')}}"></script>
          <script src="{{assets('site/js/site.js')}}"></script>


        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
      
    </head>
    <body class="">
      @include('sistema.parts.topo')

      <main>
          @yield('content')
      </main>

      @include('sistema.parts.footer')
          
    </body>
</html>

<script src="{{assets('site/js/app.js')}}"></script>
<link href="{{assets('fontawesome/css/all.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{assets('node_modules/sweetalert2/dist/sweetalert2.css')}}">
  <script src="{{assets('node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
<script src="{{assets('sistema/js/app.js')}}"></script>

@yield('scripts')