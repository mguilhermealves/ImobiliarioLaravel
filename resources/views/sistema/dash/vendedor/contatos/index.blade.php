@extends('sistema.layouts.dash')
@section('content')
<link rel="stylesheet" href="{{assets('sistema/css/dash/contatos.css')}}">

<section class="contatos">
  <div class="container-fluid">
    <div class="row padding-left-30 padding-top-20 padding-bottom-10 titulo-fundo-cinza">
      <h2>Contatos</h2>
    </div>
    <div class="row margin-top-20 barra-search">
      <div class="col-4">
        <input type="search" placeholder="Pesquisa..." class="pesquisa" />
      </div>
    </div>
    <div class="row lista-contatos margin-top-30">
      @forelse( $contatos as $contato )
        <div class="col-lg-3">
          <div class="row">
            <div class="col-lg-11 center-block card-wrapper" data-search="{{$contato->usuario->fullname}} {{$contato->usuario->empresa->nome}}">
              <div class="row">
                <div class="card-flip">
                  <div class="flip">
                    <div class="front">
                      <div class="card padding-10">
                        <div class="row">
                          <div class="col-lg-2">
                            <div class="row imagem">
                              <img src="{{$contato->usuario->imagem ?? assets('sistema/images/avatar.png')}}" />
                            </div>
                          </div>
                          <div class="col-lg-10 padding-left-10">
                            <div class="row margin-top-10">
                              <h3 class="text-navy text-14-pt bold">{{$contato->usuario->fullname}}</h3>
                            </div>
                            <div class="row margin-top-5">
                              <h3 class="text-orange text-12-pt bold">{{$contato->usuario->empresa->nome}}</h3>
                            </div>
                            <div class="row margin-top-10">
                              <div class="col-lg-1">
                                <div class="row text-navy">
                                  <i class="fas fa-phone"></i>
                                </div>
                              </div>
                              <div class="col-lg-11">
                                <div class="row text-orange">
                                  <span class="padding-left-10">{{$contato->usuario->telefone}}</span>
                                </div>
                              </div>
                            </div>
                            <div class="row margin-top-10">
                              <div class="col-lg-1">
                                <div class="row text-navy">
                                  <i class="fas fa-mobile-alt"></i>
                                </div>
                              </div>
                              <div class="col-lg-11">
                                <div class="row text-orange">
                                  <span class="padding-left-10">{{$contato->usuario->celular ?? '-'}}</span>
                                </div>
                              </div>
                            </div>
                            <div class="row margin-top-10">
                              <div class="col-lg-1">
                                <div class="row text-navy">
                                  <i class="far fa-envelope"></i>
                                </div>
                              </div>
                              <div class="col-lg-11">
                                <div class="row text-orange">
                                  <span class="padding-left-10">{{$contato->usuario->email}}</span>
                                </div>
                              </div>
                            </div>
                            <div class="row margin-top-10 padding-bottom-20">
                              <div class="col-lg-1">
                                <div class="row text-navy">
                                  <i class="far fa-calendar-plus"></i>
                                </div>
                              </div>
                              <div class="col-lg-11">
                                <div class="row text-orange">
                                  <span class="padding-left-10">{{$contato->usuario->created_at->format('Y')}}</span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row" style="background-color: #ddd; height: 1px"></div>
                        <div class="row margin-top-10">
                          <button class="btn btn-sm btn-primary text-12-pt btn-nova" data-toggle="tooltip" data-url="{{route('sistema.dash.contato.novamensagem', $contato->id)}}" title="Nova Mensagem" data-id="{{$contato->id}}">
                            <i class="fas fa-plus"></i>
                          </button>
                          <button class="btn btn-sm btn-info btn-bloqueia text-12-pt margin-left-10" data-url="{{route('sistema.dash.contato.bloquear', $contato->id)}}" data-toggle="tooltip" title="Bloquear Contato">
                            <i class="fas fa-ban"></i>
                          </button>
                          <button class="btn btn-sm btn-danger btn-apagar text-12-pt margin-left-10" data-url="{{route('sistema.dash.contato.excluir', $contato->id)}}" data-toggle="tooltip" title="Excluir Contato">
                            <i class="fas fa-trash"></i>
                          </button>
                        </div>
                        <div class="row margin-top-10" style="background-color: #ddd; height: 1px"></div>
                        <div class="row horizontal-center text-navy semibold vertical-middle padding-top-10">
                          <a href="#" class="btn-flip text-14-pt padding-left-10">
                            <i class="fas fa-undo"></i>
                            Informações da empresa
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="back">
                      <div class="card">
                        <div class="card padding-10">
                          <div class="row">
                            <div class="col-lg-2">
                              <div class="row imagem">
                                <img src="{{$contato->usuario->empresa->imagem ?? assets('sistema/images/avatar.png')}}" />
                              </div>
                            </div>
                            <div class="col-lg-10 padding-left-10">
                              <div class="row margin-top-10">
                                <h3 class="text-navy text-14-pt bold">{{$contato->usuario->empresa->nome}}</h3>
                              </div>
                              <div class="row margin-top-5">
                                <h3 class="text-orange text-12-pt bold">CNPJ: {{$contato->usuario->empresa->cnpj}}</h3>
                              </div>
                              <div class="row margin-top-10">
                                <div class="col-lg-1">
                                  <div class="row text-navy">
                                    <i class="fas fa-phone"></i>
                                  </div>
                                </div>
                                <div class="col-lg-11">
                                  <div class="row text-orange">
                                    <span class="padding-left-10">{{$contato->usuario->empresa->telefone}}</span>
                                  </div>
                                </div>
                              </div>
                              <div class="row margin-top-10">
                                <div class="col-lg-1">
                                  <div class="row text-navy">
                                    <i class="far fa-envelope"></i>
                                  </div>
                                </div>
                                <div class="col-lg-11">
                                  <div class="row text-orange">
                                    <span class="padding-left-10">{{$contato->usuario->empresa->email}}</span>
                                  </div>
                                </div>
                              </div>
                              <div class="row margin-top-10">
                                <div class="col-lg-1">
                                  <div class="row text-navy">
                                    <i class="fas fa-globe"></i>
                                  </div>
                                </div>
                                <div class="col-lg-11">
                                  <div class="row text-orange">
                                    <a href="http://{{$contato->usuario->empresa->site}}" target="_blank" class="padding-left-10">{{$contato->usuario->empresa->site}}</a>
                                  </div>
                                </div>
                              </div>
                              <div class="row margin-top-10 padding-bottom-20">
                                <div class="col-lg-1">
                                  <div class="row text-navy">
                                    <i class="fas fa-map-marker-alt"></i>
                                  </div>
                                </div>
                                <div class="col-lg-11">
                                  <div class="row text-orange">
                                    <span class="padding-left-10">{!! $contato->usuario->empresa->endereco !!}</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row" style="background-color: #ddd; height: 1px"></div>
                          <div class="row horizontal-center text-navy semibold vertical-middle padding-top-10">
                            <a href="#" class="btn-flip text-14-pt padding-left-10">
                              <i class="fas fa-undo"></i>
                              Informações do usuário
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>  
              </div>
            </div>
          </div>
        </div>  
      @empty
        <div class="alert alert-danger">
          Nenhum contato adicionado ainda!
        </div>
      @endforelse
    </div>
  </div>
  
</section>

@endsection

@section('scripts')
  <link rel="stylesheet" href="{{assets('node_modules/sweetalert2/dist/sweetalert2.css')}}">
  <script src="{{assets('node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
  <script src="{{assets('sistema/js/dash/contatos.js')}}"></script>
@endsection