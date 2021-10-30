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

<div class="container-fluid padding-top-65 bg-internas">
    <div class="container">
        <div class="row interna-juridico">
            <div class="col-lg-12">
                {!!$item->conteudo!!}
            </div>
        </div>


       



        <div class="row padding-top-35 padding-bottom-50 categorias-juridico">

            @foreach($categorias as $cat)                    
                <div class="col-lg-4 padding-10">
                    <div class="row">
                        <div class="col-lg-11 center-block categoria padding-30">
                            <div class="row vertical-middle horizontal-center">
                                <a href="#" data-toggle="modal" data-target=".arquivos-modal-{{$cat->id}}">
                                    <h3 class="text-center">
                                        <i class="fas fa-check-circle"></i>
                                        <br/>
                                        {{$cat->nome}}
                                    </h3>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>    
                

                    <div class="modal fade modal-arquivos arquivos-modal-{{$cat->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">{{$cat->nome}}</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                            
                            <div class="row">
                                <div class="col-lg-12 padding-top-20 padding-bottom-20 padding-left-30 padding-right-30">
                                    <ul>                                                                            
                                    @foreach($arquivos->where('categoria_id',$cat->id) as $arquivo) 
                                        @if( $arquivo->tipo == 0)
                                            <li><a href="{{url('/') . '/storage/app/public/' . $arquivo->arquivo}}" target="_blank"><i class="fas fa-file-pdf"></i> {{ $arquivo->titulo}}</a></li>
                                        @else

                                            @guest('sistema')
                                                <li><a href="{{route('sistema.auth')}}" target="_blank"><i class="fas fa-lock"></i> {{ $arquivo->titulo }}</a></li>
                                            @endguest
                                            @auth('sistema')
                                                <li><a href="{{url('/') . '/storage/app/public/' . $arquivo->arquivo}}" target="_blank"><i class="fas fa-lock"></i> {{ $arquivo->titulo }}</a></li>
                                            @endauth
                                            

                                        @endif
                                    @endforeach                                        
                                    </ul>
                                </div>
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