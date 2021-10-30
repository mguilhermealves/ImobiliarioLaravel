@extends('sistema.layouts.default')
@section('content')

        <div class="container-fluid topo-internas">
            <div class="container">
                <div class="row padding-top-15 breadcrumbs">
                    <div class="col-lg-12">
                        <ul>
                            <li><a href="{{route('sistema.index')}}">home</a></li>
                            <li>/</li>
                            <li>ASSERTTEM</li>
                        </ul>
                    </div>
                </div>

                <div class="row padding-top-15">
                    <div class="col-lg-5 titulo-pagina">
                        <h1>{!!$item->titulo!!}</h1>
                    </div>
                </div>
                <div class="row margin-top-30 padding-bottom-70 xs-margin-top-10 xs-padding-bottom-30">
                    <p class="text-16-pt line-24">{{$item->subtitulo}}</p>
                </div>

            </div>
        </div>

        <div class="container-fluid padding-top-90 padding-bottom-90 xs-padding-top-25 xs-padding-bottom-25 associe-agencia bg-internas">
            <div class="container">
                <div class="row  content-quem-somos">                   
                    <div class="col-lg-7 padding-right-20">
                        {!!$item->conteudo!!}
                    </div>

                    <div class="col-lg-5">
                        <div class="row">
                            <div class="col-lg-12 text-center imagem-associe">
                                <img src="{{$item->imagem_interna}}" />
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="row padding-top-65 xs-padding-top-25 padding-bottom-65 xs-padding-bottom-25 margin-top-45 box-missao-visao">
                    <div class="col-lg-10 center-block">
                        <div class="row">
                            <div class="col-lg-6 padding-right-15 xs-padding-left-10 xs padding-right-10">
                                {!!$item->missao!!}
                            </div>
                            <div class="col-lg-6 xs-padding-top-10 padding-left-15 xs-padding-left-10 xs padding-right-10">
                                {!!$item->visao!!}
                            </div>
                        </div>
                        <div class="row padding-top-35 xs-padding-top-10 xs-padding-left-10 xs padding-right-10">
                            <div class="col-lg-12">
                                {!!$item->valores!!}
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="row padding-top-65 padding-bottom-65 margin-top-45 box-missao-visao">
                    <div class="col-lg-10 center-block">                        
                        <div class="row padding-top-35">
                            <div class="col-lg-12">
                               <h2>CONHEÇA O NOSSO CORPO DIRETIVO</h2>
                               <div class="row padding-top-40">
                                   <div class="col-lg-12">
                                    <a href="{{route('sistema.corpo-diretivo')}}" class="ver-mais-sobre">Ver mais</a>
                                   </div>
                               </div>                               
                            </div>
                        </div>
                    </div>
                </div>            
            </div>
        </div>


       
        @include('sistema.parts.numeros-asserttem')
    
        @include('sistema.parts.cursos-palestras')


@endsection
@section('scripts')
    <link rel="stylesheet" href="{{assets('node_modules/sweetalert2/dist/sweetalert2.css')}}">
    <script src="{{assets('node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
@endsection

