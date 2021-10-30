@extends('sistema.layouts.default')
@section('content')

        <div class="container-fluid topo-internas">
            <div class="container">
                <div class="row padding-top-15 breadcrumbs">
                    <div class="col-lg-12">
                        <ul>
                            <li><a href="{{route('sistema.index')}}">home</a></li>
                            <li>/</li>
                            <li>trabalho temporário</li>
                        </ul>
                    </div>
                </div>

                <div class="row padding-top-15">
                    <div class="col-lg-5 titulo-pagina">
                        <h1>{!!$item->titulo!!}</h1>
                    </div>
                </div>
                <div class="row margin-top-30 padding-bottom-70">
                    <p class="text-16-pt line-24">{{$item->subtitulo}}</p>
                </div>
            </div>
        </div>

        <div class="container-fluid padding-top-65 padding-bottom-60 bg-internas">
            <div class="container">

                <div class="row margin-top-negative-120 banner-trabalho">
                    <div class="col-lg-12">
                        <img src="{{$item->imagem_interna}}" />
                    </div>
                </div>

                <div class="row margin-top-35 interna-trabalho">
                    <div class="col-lg-12">
                        {!!$item->conteudo!!}
                    </div>
                </div>

            </div>
        </div>

        <div class="container-fluid padding-top-50 padding-bottom-140 como-funciona-temporario">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        {!!$item->titulo_funciona!!}                    
                    </div>
                </div>
                <div class="row margin-top-20">
                    <div class="col-lg-10 padding-top-55 padding-bottom-55 padding-left-60 padding-right-60 como-funciona-temp center-block">
                        {!!$item->texto_funciona!!}
                    </div>
                </div>                
            </div>
        </div>
      

@endsection
@section('scripts')
    <link rel="stylesheet" href="{{assets('node_modules/sweetalert2/dist/sweetalert2.css')}}">
    <script src="{{assets('node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
@endsection