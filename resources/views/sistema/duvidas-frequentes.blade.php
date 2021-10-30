@extends('sistema.layouts.default')
@section('content')



<div class="container-fluid topo-internas">
    <div class="container">
        <div class="row padding-top-15 breadcrumbs">
            <div class="col-lg-12">
                <ul>
                    <li><a href="{{route('sistema.index')}}">home</a></li>
                    <li>/</li>
                    <li>jurídico</li>
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



<div class="container-fluid padding-top-70 bg-internas duvidas-frequentes">
    <div class="container">

        @foreach($perguntas as $per)
        @foreach($per as $k=>$v)          
        <div class="row padding-bottom-35 margin-bottom-55 linha-duvida">
            <div class="col-lg-12">
                <h2>{{$v['pergunta']}}</h2>
                <br/>
                <p>{!!$v['resposta']!!}</p>
            </div>
        </div>
        @endforeach 
        @endforeach  
              
    </div>
</div>



@include('sistema.parts.numeros-asserttem')
    
@include('sistema.parts.cursos-palestras')


@endsection
@section('scripts')
<link rel="stylesheet" href="{{assets('node_modules/sweetalert2/dist/sweetalert2.css')}}">
<script src="{{assets('node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
@endsection