@extends('sistema.layouts.default')
@section('content')

        <div class="container-fluid topo-internas">
            <div class="container">
                <div class="row padding-top-15 breadcrumbs">
                    <div class="col-lg-12">
                        <ul>
                            <li><a href="{{route('sistema.index')}}">home</a></li>
                            <li>/</li>                                                      
                            <li>agências associadas</li>
                        </ul>
                    </div>
                </div>

                <div class="row padding-top-15 padding-bottom-85 xs-padding-bottom-30">
                    <div class="col-lg-5 titulo-pagina">
                        <h1>Agências<br/>                            
                            <b>associadas</b></h1>
                       
                            <div class="row margin-top-30 xs-margin-top-10 ">
                                <div class="col-lg-10">
                                    <p>{{ $geral->subtitulo_agencias_associadas }}</p>
                                </div>
                            </div>  
                    </div>
                </div>
            </div>
        </div>


        <div class="container-fluid  padding-bottom-45 mapa-busca-resultado">

            <div class="container">

                

                <div class="row">
                    <div class="col-lg-8 padding-right-50 xs-padding-right-0">
                        <div class="caixa-resultado padding-left-45 padding-right-45 padding-top-30">
                            <div class="row padding-bottom-25 agencia">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <h2 class="xs-gone">Utilize o mapa ao lado.</h2>     
                                        <h2 class="xs-only">Utilize o mapa abaixo.</h2>     
                                        <span>Nos estados em <b>amarelo</b> já temos agências associadas.</span> 
                                    </div>
                                    <div class="row">
                                        <a href="{{route('sistema.auth.cadastro')}}">Clique para se associar</a>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>

                    <div class="col-lg-4 padding-top-50 xs-padding-top-20">
                        @include('sistema.parts.mapa')
                    </div>

                </div>
            </div>
                      
        </div>

     
@endsection

@section('scripts')
    <link rel="stylesheet" href="{{assets('node_modules/sweetalert2/dist/sweetalert2.css')}}">
    <script src="{{assets('node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
@endsection