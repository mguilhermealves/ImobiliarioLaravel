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
            <input type="search" class="form-control pesquisa" placeholder="Pesquisa..." />
          </div>
          <div class="row"></div>
          @forelse( $cotacoes as $item )
            <div class="row padding-top-30 padding-bottom-30 lista-cotacoes linha-usuario-mensagem" data-search="{{$item[0]->produto->nome}} {{$item[0]->destino->usuario->fullName}} {{$item[0]->destino->nome}}">                            
              <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 relative">
                <div class="row">                                    
                  <div class="col-lg-2 avatar-usuario">
                    <img src="{{$item[0]->produto->principal}}" />
                  </div>
                  <div class="col-lg-10 text-left padding-left-15">
                    <h4>{{$item[0]->produto->nome}}</h4>
                  </div>
                </div>
                @foreach( $item as $cotacao )
                <div class="row sub-user margin-top-20 cotacao">
                  <div class="col-lg-2 bolinha-laranja @if( $cotacao->status != 0  ) lida @endif"></div>
                  <div class="col-lg-10 individual" data-id="#{{$cotacao->id}}" data-url="{{route('sistema.dash.comprador.cotacao', [$usuario->empresa->id, $cotacao->id])}}">
                    <div class="row">                                                
                      <div class="col-xs-2 col-sm-2 col-lg-2 col-lg-2 avatar-usuario">
                        <img src="{{$cotacao->destino->logo ?? assets('sistema/images/avatar.png')}}" />
                      </div>  
                      <div class="col-xs-10 col-sm-10 col-lg-10 col-lg-10 text-left padding-left-10">
                        <div class="row">
                          <p>{{$cotacao->destino->usuario->fullName}}</p>
                        </div>
                        <div class="row margin-top-5">
                          <p class="text-navy medium">{{$cotacao->destino->nome}}</p>
                        </div>
                        <div class="row">
                          <img src="{{assets('sistema/images/icons/medalha.png')}}" />
                        </div>
                        <div class="row">
                          <span class="data">{{$cotacao->updated_at->format('d/m/Y H:i:s')}}</span>
                        </div>
                      </div>
                    </div>
                  </div>  
                </div>
                <div class="row margin-top-20 horizontal-right padding-right-20">
                  <button class="btn text-danger btn-sm vertical-middle"  data-toggle="collapse" data-target="#encerra_{{$cotacao->id}}" aria-expanded="false" aria-controls="encerra_{{$cotacao->id}}">
                    Finalizar Cotação
                    <i class="fas fa-chevron-down padding-left-10"></i>
                  </button>
                </div>  
                <div class="collapse margin-top-10 finaliza padding-10 padding-top-20 padding-bottom-20" id="encerra_{{$cotacao->id}}">
                  <div class="col-12 finalizar">
                    <form data-action="{{route('sistema.dash.comprador.cotacoes.avaliar', $cotacao->id)}}" class="form-avaliacao" autocomplete="off">
                      <div class="row horizontal-center">
                        <h4 class="text-navy text-12-pt medium">Avalie o atendimento deste fornecedor:</h4>
                      </div>
                      <div class="row margin-top-10 padding-left-100">
                        <input id="rating_{{$cotacao->id}}" name="nota" autocomplete="new-password" class="rating-loading" min="0" max="5" value="0" required title="Por favor, avalie o fornecedor">  
                      </div>
                      <div class="row margin-top-20 horizontal-center">
                        <button type="submit" class="btn btn-success btn-sm avalia-fornecedor">Enviar avaliação e finalizar cotação</button>
                      </div>
                    </form>
                  </div>
                </div>
                @endforeach
              </div>                                                                                  
            </div>
          @empty
            <div class="row flex-column margin-top-20">
              <div class="alert alert-info">Sem cotações até o momento</div>
            </div>
          @endforelse
        </div>
        <div class="tab-pane fade" id="finalizadas" role="tabpanel" aria-labelledby="finalizadas-tab">
          <div class="row padding-top-15 padding-left-20 barra-search">
            <input type="search" class="form-control pesquisa" placeholder="Pesquisa..." />
          </div>
          <div class="row"></div>
          @forelse( $fechadas as $item )
            <div class="row padding-top-30 padding-bottom-30 lista-cotacoes linha-usuario-mensagem" data-search="{{$item[0]->produto->nome}} {{$item[0]->destino->usuario->fullName}} {{$item[0]->destino->nome}}">                            
              <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 relative">
                <div class="row">                                    
                  <div class="col-lg-2 avatar-usuario">
                    <img src="{{$item[0]->produto->principal}}" />
                  </div>
                  <div class="col-lg-10 text-left padding-left-15">
                    <h4>{{$item[0]->produto->nome}}</h4>
                  </div>
                </div>
                @foreach( $item as $cotacao )
                <div class="row sub-user margin-top-20 cotacao">
                  <div class="col-lg-2 bolinha-laranja @if( $cotacao->valor == null ) lida @endif"></div>
                  <div class="col-lg-10 individual" data-id="#{{$cotacao->id}}" data-url="{{route('sistema.dash.comprador.cotacao', [$usuario->empresa->id, $cotacao->id])}}">
                    <div class="row">                                                
                      <div class="col-xs-2 col-sm-2 col-lg-2 col-lg-2 avatar-usuario">
                        <img src="{{$cotacao->destino->logo ?? assets('sistema/images/avatar.png')}}" />
                      </div>  
                      <div class="col-xs-10 col-sm-10 col-lg-10 col-lg-10 text-left padding-left-10">
                        <div class="row">
                          <p>{{$cotacao->destino->usuario->fullName}}</p>
                        </div>
                        <div class="row margin-top-5">
                          <p class="text-navy medium">{{$cotacao->destino->nome}}</p>
                        </div>
                        <div class="row">
                          <img src="{{assets('sistema/images/icons/medalha.png')}}" />
                        </div>
                        <div class="row">
                          <span class="data">{{$cotacao->updated_at->format('d/m/Y H:i:s')}}</span>
                        </div>
                      </div>
                    </div>
                  </div>  
                </div>
                @endforeach
              </div>                                                                                  
            </div>
          @empty
            <div class="row flex-column margin-top-20">
              <div class="alert alert-info">Sem cotações até o momento</div>
            </div>
          @endforelse
        </div>
      </div>
    </div>
    <div class="col-lg-9 main-cotacao">
      {{--  <div class="jumbotron">
        <h1 class="display-4 text-blue">Bem-vindo(a) à suas cotações!</h1>
        <p class="lead text-orange">Por favor, selecione alguma cotação ao lado esquerdo para que os dados da mesma sejam exibidos aqui</p>
        <hr class="my-4">
      </div>  --}}
    </div>
  </div>
  
</section>

@endsection

@section('scripts')
<link rel="stylesheet" href="{{assets('node_modules/sweetalert2/dist/sweetalert2.css')}}">
<script src="{{assets('node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
<script src="{{assets('sistema/js/dash/vendedor/cotacoes.js')}}"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/plugins/piexif.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/fileinput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/locales/pt-BR.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/css/star-rating.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/js/star-rating.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/js/locales/pt-BR.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/css/star-rating.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/themes/krajee-fas/theme.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/js/star-rating.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/js/locales/pt-BR.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/themes/krajee-fas/theme.min.js"></script>
@endsection