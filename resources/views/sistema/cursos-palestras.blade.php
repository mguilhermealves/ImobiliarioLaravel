@extends('sistema.layouts.default')
@section('content')

        <div class="container-fluid topo-internas">
            <div class="container">
                <div class="row padding-top-15 breadcrumbs">
                    <div class="col-lg-12">
                        <ul>
                            <li><a href="{{route('sistema.index')}}">home</a></li>
                            <li>/</li>
                            <li>cursos e palestras</li>
                        </ul>
                    </div>
                </div>

                <div class="row padding-top-15 padding-bottom-100">
                    <div class="col-lg-5 titulo-pagina">
                        <h1>cursos<br/>                            
                            <b>e palestras</b></h1>

                            <div class="row margin-top-30">
                                <div class="col-lg-10">
                                    <p>{{$geral->subtitulo_cursos_palestras}}</p>
                                </div>
                            </div>                            
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid padding-top-65 padding-bottom-60 bg-internas xs-padding-top-10">
            <div class="container">

                <div class="row">
                    <div class="col-lg-12 padding-top-50 xs-padding-top-30 padding-bottom-50 cursos-palestras-listagem">
                        <div class="row">

                            @foreach($cursos as $curso)
                                
                            <div class="col-lg-3 padding-5">
                                <div class="row box-palestra-listagem">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-12 imagem">
                                                <img src="{{$curso->imagem1}}" />
                                            </div>
                                        </div>
                                        <div class="row title-box">
                                            <div class="col-lg-12 padding-left-25 padding-right-25">
                                                <span>{{ $curso->tipo == 0 ? "Curso" : "Palestra" }}</span>
                                                <br/><br/>
                                                <h2>{{$curso->titulo}}</h2>
                                            </div>
                                        </div>
                                        <div class="row margin-top-75 padding-bottom-40 text-box">
                                            <div class="col-lg-12 padding-left-35 padding-right-35">
                                                <p>{!!$curso->resumo!!}</p>
                                                <br/><br/>
                                                <a href="{{route('sistema.cursos-detalhes',['slug'=>$curso->slug])}}"><img src="{{assets('site/images/icon-leia-mais.png')}}" class="margin-right-10"> Leia mais</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </div>
                    </div>
                </div>

                {{$cursos->appends(request()->all())->links()}}
                
            </div>
        </div>
@endsection