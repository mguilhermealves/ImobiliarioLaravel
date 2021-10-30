@extends('sistema.layouts.default')
@section('content')

        <div class="container-fluid topo-internas">
            <div class="container">
                <div class="row padding-top-15 breadcrumbs">
                    <div class="col-lg-12">
                        <ul>
                            <li><a href="{{route('sistema.index')}}">home</a></li>
                            <li>/</li>
                            <li><a href="{{route('sistema.asserttem')}}">ASSERTTEM</a></li>
                            <li>/</li>
                            <li>CORPO DIRETIVO</li>
                        </ul>
                    </div>
                </div>

                <div class="row padding-top-15 xs-padding-bottom-20" >
                    <div class="col-lg-7 titulo-pagina">
                        <h1 class="xs-gone">CONHEÇA NOSSO <b>CORPO DIRETIVO</b></h1>
                        <h1 class="xs-only"><b>CORPO DIRETIVO</b></h1>
                    </div>
                </div>
               

            </div>
        </div>

        <div class="container-fluid padding-top-90 padding-bottom-90 equipe">
            <div class="container">
                <div class="row">
                    <h2 class="titulo">DIRETORIA EXECUTIVA</h2>
                </div>
                <div class="row margin-top-50">
                    @foreach($executiva as $item)
                        <div class="col-lg-4">
                            <div class="row padding-left-5 padding-right-5">
                                <div class="col-lg-12 center-block profissional">
                                    <div class="row imagem" style="background-image: url('{{ $item->imagem }}')"></div>
                                    <div class="row margin-top-10">
                                        <h3>{{ $item->nome }}</h3>
                                    </div>
                                    <div class="row margin-top-20 informacoes">
                                        {!! $item->informacoes !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row margin-top-100">
                    <h2 class="titulo">DIRETORIA REGIONAL</h2>
                </div>
                <div class="row margin-top-50">
                    @foreach($regional as $item)
                    <div class="col-lg-4">
                        <div class="row padding-left-5 padding-right-5">
                            <div class="col-lg-12 center-block profissional">
                                <div class="row imagem" style="background-image: url('{{ $item->imagem }}')"></div>
                                <div class="row margin-top-10">
                                    <h3>{{ $item->nome }}</h3>
                                </div>
                                <div class="row margin-top-20 informacoes">
                                    {!! $item->informacoes !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row margin-top-100">
                    <h2 class="titulo">CONSELHO FISCAL</h2>
                </div>
                <div class="row margin-top-50">
                    @foreach($fiscal as $item)
                    <div class="col-lg-4">
                        <div class="row padding-left-5 padding-right-5">
                            <div class="col-lg-12 center-block profissional">
                                <div class="row imagem" style="background-image: url('{{ $item->imagem }}')"></div>
                                <div class="row margin-top-10">
                                    <h3>{{ $item->nome }}</h3>
                                </div>
                                <div class="row margin-top-20 informacoes">
                                    {!! $item->informacoes !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="row margin-top-100">
                    <h2 class="titulo">CONSELHO CONSULTIVO</h2>
                </div>
                <div class="row margin-top-50">
                    @foreach($consultivo as $item)
                    <div class="col-lg-4">
                        <div class="row padding-left-5 padding-right-5">
                            <div class="col-lg-12 center-block profissional">
                                <div class="row imagem" style="background-image: url('{{ $item->imagem }}')"></div>
                                <div class="row margin-top-10">
                                    <h3>{{ $item->nome }}</h3>
                                </div>
                                <div class="row margin-top-20 informacoes">
                                    {!! $item->informacoes !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
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

