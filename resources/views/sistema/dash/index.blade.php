@extends('sistema.layouts.default')
@section('content')

<div class="container-fluid topo-internas">
  <div class="container">
      <div class="row padding-top-15 breadcrumbs">
          <div class="col-lg-12">
              <ul>
                  <li><a href="{{route('sistema.index')}}">home</a></li>
                  <li>/</li>
                  <li>Login</li>
              </ul>
          </div>
      </div>

      <div class="row padding-top-15 padding-bottom-50">
          <div class="col-lg-12 titulo-pagina">
            <h1 class="xs-gone">Àrea                            
                <b>Restrita</b></h1>
                <h1 class="xs-only">Àrea                            
                  <b>Restrita</b></h1>

                  <div class="row margin-top-30">
                      <div class="col-lg-10">
                          <p>Acesse os documentos exclusivos e edite seus dados.</p>
                      </div>
                  </div>                            
          </div>
      </div>
  </div>
</div>

<div class="container-fluid padding-top-65 padding-bottom-80 bg-internas">
  <div class="container">

      <div class="row">
          <div class="col-lg-3 padding-right-15">
              <div class="row padding-top-30 padding-bottom-30 padding-left-35 padding-right-35 menu-restrita">
                  <div class="col-lg-12">
                      <ul>
                        <li><a href="{{route('sistema.dash.inicio')}}"><img src="{{assets('site/images/seta-login.png')}}" /> Inicio</a></li>
                        <li><a href="{{route('sistema.dash.meus-dados')}}"><img src="{{assets('site/images/seta-login.png')}}" /> Meus dados</a></li>                         
                        <li><a href="{{route('sistema.sair')}}"><img src="{{assets('site/images/seta-login.png')}}" /> Sair</a></li>
                      </ul>
                  </div>
              </div>
          </div>
          <div class="col-lg-9 padding-left-15 painel">
              <div class="row interna-juridico">
                  <div class="col-lg-12">
                      <h2>Acesse <b>abaixo</b></h2>
                     {!!$geral->conteudo_area_restrita!!}
                  </div>
              </div>

              <div class="row padding-top-35 padding-bottom-50 categorias-juridico">

                @foreach($categorias as $cat)                    
                    <div class="col-lg-4 padding-10">
                        <a href="#" data-toggle="modal" data-target=".arquivos-modal-{{$cat->id}}">
                            <div class="row">
                                <div class="col-lg-12 padding-left-50 padding-right-50  padding-top-50 padding-bottom-50 text-center box-categ">
                                    <h3>
                                        <i class="fas fa-check-circle"></i>
                                        <br/>
                                        {{$cat->nome}}</h3>
                                </div>
                            </div>
                        </a>
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
                                             <li><a href="{{url('/') . '/storage/app/public/' . $arquivo->arquivo}}" target="_blank"><i class="fas fa-file-pdf"></i> {{ $arquivo->titulo}}</a></li>
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

  </div>
</div>


@stop
@section('scripts')
  <link href="{{ assets('sistema/css/auth/login.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="{{assets('node_modules/sweetalert2/dist/sweetalert2.css')}}">
  <script src="{{assets('plugins/js/mask.js')}}"></script>
  <script src="{{assets('plugins/js/masks.js')}}"></script>
  <script src="{{assets('node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
@endsection