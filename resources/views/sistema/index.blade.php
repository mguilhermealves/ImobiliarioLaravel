@extends('sistema.layouts.default')
@section('content')



  <div class="container-fluid">
     <div class="row slider-home">

      @foreach($banners as $banner)
        <div class="col-lg-12 slide" style="background:url({{$banner->imagem}}) center top no-repeat;background-size: cover;">
        <a href="{{$banner->link}}" target="{{$banner->target}}">
          <div class="container">
              <div class="row padding-top-125 xs-padding-top-100">
                  <div class="col-lg-5 padding-right-50">
                    {!!$banner->conteudo!!}
                  </div>
              </div>
          </div>                   
        </a>
      </div>
      @endforeach
                              
     </div>
  </div>


@endsection
@section('scripts')
  <link rel="stylesheet" href="{{assets('node_modules/sweetalert2/dist/sweetalert2.css')}}">
  <script src="{{assets('node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
@endsection