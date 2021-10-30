@extends('sistema.layouts.dash')
@section('content')
<link rel="stylesheet" href="{{assets('sistema/css/dash/cotacoes.css')}}">

<section class="dash-cotacoes">
  
  <div class="row">     
    <div class="col-lg-3 padding-right-10 text-center coluna-usuarios-mensagem">
      <h3>Cotações</h3>
      <div class="row margin-top-20 abas">
        <ul class="nav nav-tabs text-navy text-16-pt bold abas" id="abas" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="abertas-tab" data-toggle="tab" href="#abertas" role="tab" aria-controls="abertas" aria-selected="true">Abertas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="finalizadas-tab" data-toggle="tab" href="#finalizadas" role="tab" aria-controls="finalizadas" aria-selected="false">Finalizadas</a>
          </li>
        </ul>
      </div>
      <div class="tab-content">
        <div class="tab-pane fade show active" id="abertas" role="tabpanel" aria-labelledby="abertas-tab">
          <div class="row padding-top-15 padding-left-20 barra-search">
            <input type="search" placeholder="Pesquisa..." />
          </div>
          <div class="cotacoes">
            @forelse( $cotacoes as $item )
              <div class="row padding-top-30 padding-bottom-30 lista-cotacoes linha-usuario-mensagem">                            
                <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12">
                  <div class="row">                                    
                    <div class="col-lg-2 avatar-usuario">
                      <img src="{{$item[0]->produto->principal}}" />
                    </div>
                    <div class="col-lg-10 text-left padding-left-15">
                      <h4>{{$item[0]->produto->nome}}</h4>
                      <a href="#{{$item[0]->id}}" data-url="{{route('sistema.dash.vendedor.cotacao.todas', [$usuario->empresa->id, $item[0]->produto_id])}}" class="responder-cotacoes">Responder todas as cotações</a>
                    </div>
                  </div>
                  @foreach( $item as $cotacao )
                  <div class="row sub-user margin-top-20 cotacao">
                    <div class="col-lg-2 bolinha-laranja @if( $cotacao->status == 1 ) lida @endif"></div>
                    <div class="col-lg-10 individual" data-id="#{{$cotacao->id}}" data-url="{{route('sistema.dash.vendedor.cotacao', [$usuario->empresa->id, $cotacao->id])}}">
                      <div class="row">                                                
                        <div class="col-xs-2 col-sm-2 col-lg-2 col-lg-2 avatar-usuario">
                          <img src="{{$cotacao->origem->usuario->imagem ?? assets('sistema/images/avatar.png')}}" />
                        </div>  
                        <div class="col-xs-10 col-sm-10 col-lg-10 col-lg-10 text-left padding-left-10">
                          <div class="row">
                            <p>{{$cotacao->origem->usuario->fullName}}</p>
                          </div>
                          <div class="row margin-top-5">
                            <p class="text-navy medium">{{$cotacao->origem->nome}}</p>
                          </div>
                          <div class="row">
                            <img src="{{assets('sistema/images/icons/medalha.png')}}" />
                          </div>
                          <div class="row">
                            <span class="data">{{$cotacao->created_at->format('d/m/Y H:i:s')}}</span>
                          </div>
                        </div>
                      </div>
                    </div>                                        
                  </div>
                  <div class="row margin-top-20 horizontal-right padding-right-20">
                    <button class="btn text-danger btn-sm vertical-middle btn-finaliza" data-action="{{route('sistema.dash.vendedor.cotacoes.finalizar', $cotacao->id)}}">
                      Finalizar Cotação
                    </button>
                  </div>  
                  @endforeach
                </div>                                                                                  
              </div>
            @empty
              <div class="alert alert-info">Sem cotações até o momento</div>
            @endforelse
          </div>
        </div>
        <div class="tab-pane fade" id="finalizadas" role="tabpanel" aria-labelledby="finalizadas-tab">
          <div class="row padding-top-15 padding-left-20 barra-search">
            <input type="search" placeholder="Pesquisa..." />
          </div>
          <div class="cotacoes">
          @forelse( $fechadas as $item )
            <div class="row padding-top-30 padding-bottom-30 lista-cotacoes linha-usuario-mensagem">                            
              <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12">
                <div class="row">                                    
                  <div class="col-lg-2 avatar-usuario">
                    <img src="{{$item[0]->produto->principal}}" />
                  </div>
                  <div class="col-lg-10 text-left padding-left-15">
                    <h4>{{$item[0]->produto->nome}}</h4>
                    <a href="#{{$item[0]->id}}" data-url="{{route('sistema.dash.vendedor.cotacao.todas', [$usuario->empresa->id, $item[0]->produto_id])}}" class="responder-cotacoes">Responder todas as cotações</a>
                  </div>
                </div>
                @foreach( $item as $cotacao )
                <div class="row sub-user margin-top-20 cotacao">
                  <div class="col-lg-2 bolinha-laranja @if( $cotacao->status == 1 ) lida @endif"></div>
                  <div class="col-lg-10 individual" data-id="#{{$cotacao->id}}" data-url="{{route('sistema.dash.vendedor.cotacao', [$usuario->empresa->id, $cotacao->id])}}">
                    <div class="row">                                                
                      <div class="col-xs-2 col-sm-2 col-lg-2 col-lg-2 avatar-usuario">
                        <img src="{{$cotacao->origem->usuario->imagem ?? assets('sistema/images/avatar.png')}}" />
                      </div>  
                      <div class="col-xs-10 col-sm-10 col-lg-10 col-lg-10 text-left padding-left-10">
                        <div class="row">
                          <p>{{$cotacao->origem->usuario->fullName}}</p>
                        </div>
                        <div class="row margin-top-5">
                          <p class="text-navy medium">{{$cotacao->origem->nome}}</p>
                        </div>
                        <div class="row">
                          <img src="{{assets('sistema/images/icons/medalha.png')}}" />
                        </div>
                        <div class="row">
                          <span class="data">{{$cotacao->created_at->format('d/m/Y H:i:s')}}</span>
                        </div>
                      </div>
                    </div>
                  </div>                                        
                </div>
                @endforeach
              </div>                                                                                  
            </div>
          @empty
            <div class="alert alert-info">Sem cotações até o momento</div>
          @endforelse
        </div>
      </div>
      </div>
    </div>
    <div class="col-lg-9 main-cotacao">
    </div>
  </div>
  
</section>

@endsection

@section('scripts')
<link rel="stylesheet" href="{{assets('node_modules/sweetalert2/dist/sweetalert2.css')}}">
<script src="{{assets('node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/plugins/piexif.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/fileinput.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/locales/pt-BR.js"></script>
<script src="{{assets('sistema/js/dash/vendedor/cotacoes.js')}}"></script>
@endsection