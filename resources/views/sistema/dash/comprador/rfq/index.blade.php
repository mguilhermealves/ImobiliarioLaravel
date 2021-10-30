@extends('sistema.layouts.dash')
@section('content')
<link rel="stylesheet" href="{{assets('sistema/css/dash/rfqs.css')}}">

<section class="dash-rfqs">
  <div class="row">     
    <div class="col-lg-3 padding-right-10 text-center coluna-usuarios-mensagem">
      <h3>Meu 88Market</h3>
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
          <div class="cotacoes">
            @forelse( $rfqs as $item )
              <div class="row padding-top-30 padding-bottom-30 lista-rfqs linha-usuario-mensagem" data-search="{{$item->termo}}">                            
                <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12">
                  <div class="row">                                    
                    <div class="col-lg-2 avatar-usuario">
                      <img src="{{$item->imagem1}}" />
                    </div>
                    <div class="col-lg-10 text-left padding-left-15">
                      <div class="row">
                        <h4>{{$item->termo}}
                          <a href="#" title="editar cotação" class="editar" data-url="{{route('sistema.dash.comprador.editarrfq', $item->id)}}">
                            <i class="margin-left-15 fas fa-edit"></i>
                          </a>
                        </h4>
                      </div>
                      <div class="row margin-top-10">
                        @if( $item->respostas->count() > 0)
                          <a href="#" data-url="{{route('sistema.dash.comprador.rfq.comparar', $item->id)}}" class="text-blue text-14-pt regular comparar">Comparar todas as respostas</a>
                        @else
                          <span class="text-orange text-12-pt">Nenhum resposta ainda.</span>
                        @endif
                      </div>
                    </div>
                  </div>
                  @foreach($item->respostas->sortByDesc('created_at') as $resposta)
                    <div class="row sub-user margin-top-20 rfq">
                      <div class="col-lg-2 bolinha-laranja @if( $resposta->lida == 1 ) lida @endif"></div>
                      <div class="col-lg-10 individual" id="individual_{{$resposta->id}}" data-url="{{route('sistema.dash.comprador.rfq', [$usuario->empresa->id, $resposta->id])}}">
                        <div class="row">                                                
                          <div class="col-xs-2 col-sm-2 col-lg-2 col-lg-2 avatar-usuario">
                            <img src="{{$resposta->fornecedor->imagem ?? assets('sistema/images/avatar.png')}}" />
                          </div>  
                          <div class="col-xs-10 col-sm-10 col-lg-10 col-lg-10 text-left padding-left-10">
                            <div class="row margin-top-5">
                              <p class="text-navy medium">{{$resposta->fornecedor->nome}}</p>
                            </div>
                            <div class="row">
                              <img src="{{assets('sistema/images/icons/bandeira.png')}}" class="margin-top-5 margin-right-5" />
                              <img src="{{assets('sistema/images/icons/medalha.png')}}" />
                            </div>
                            <div class="row">
                              <span class="data">{{$resposta->created_at->format('d/m/Y H:i:s')}}</span>
                            </div>
                          </div>
                        </div>
                      </div>                                        
                    </div>
                    <div class="row margin-top-20 horizontal-right padding-right-20">
                      <button class="btn text-danger btn-sm vertical-middle"  data-toggle="collapse" data-target="#encerra_{{$resposta->id}}" aria-expanded="false" aria-controls="encerra_{{$resposta->id}}">
                        Finalizar Cotação
                        <i class="fas fa-chevron-down padding-left-10"></i>
                      </button>
                    </div>  
                    <div class="collapse margin-top-10 finaliza padding-10 padding-top-20 padding-bottom-20" id="encerra_{{$resposta->id}}">
                      <div class="col-12 finalizar">
                        <form data-action="{{route('sistema.dash.comprador.rfq.avaliar', $resposta->id)}}" class="form-avaliacao" autocomplete="off">
                          <div class="row horizontal-center">
                            <h4 class="text-navy text-12-pt medium">Avalie o atendimento deste fornecedor:</h4>
                          </div>
                          <div class="row margin-top-10 padding-left-100">
                            <input id="rating_{{$resposta->id}}" name="nota" autocomplete="new-password" class="rating-loading" min="0" max="5" value="0" required title="Por favor, avalie o fornecedor">  
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
              <div class="alert alert-info margin-top-50">Sem RFQs até o momento</div>
            @endforelse
          </div>
        </div>
        <div class="tab-pane fade" id="finalizadas" role="tabpanel" aria-labelledby="finalizadas-tab">
          <div class="cotacoes">
            @forelse( $fechadas as $item )
              <div class="row padding-top-30 padding-bottom-30 lista-rfqs linha-usuario-mensagem" data-search="{{$item->termo}}">                            
                <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12">
                  <div class="row">                                    
                    <div class="col-lg-2 avatar-usuario">
                      <img src="{{$item->imagem1}}" />
                    </div>
                    <div class="col-lg-10 text-left padding-left-15">
                      <div class="row">
                        <h4>{{$item->termo}}</h4>
                      </div>
                      <div class="row margin-top-10">
                        @if( $item->respostas->count() > 0)
                          <a href="#" data-url="{{route('sistema.dash.comprador.rfq.comparar', $item->id)}}" class="text-blue text-14-pt regular comparar">Comparar todas as respostas</a>
                        @else
                          <span class="text-orange text-12-pt">Nenhum resposta ainda.</span>
                        @endif
                      </div>
                    </div>
                  </div>
                  @foreach($item->respostas->sortByDesc('created_at') as $resposta)
                    <div class="row sub-user margin-top-20 rfq">
                      <div class="col-lg-2 bolinha-laranja @if( $resposta->lida == 1 ) lida @endif"></div>
                      <div class="col-lg-10 individual" id="individual_{{$resposta->id}}" data-url="{{route('sistema.dash.comprador.rfq', [$usuario->empresa->id, $resposta->id])}}">
                        <div class="row">                                                
                          <div class="col-xs-2 col-sm-2 col-lg-2 col-lg-2 avatar-usuario">
                            <img src="{{$resposta->fornecedor->imagem ?? assets('sistema/images/avatar.png')}}" />
                          </div>  
                          <div class="col-xs-10 col-sm-10 col-lg-10 col-lg-10 text-left padding-left-10">
                            <div class="row margin-top-5">
                              <p class="text-navy medium">{{$resposta->fornecedor->nome}}</p>
                            </div>
                            <div class="row">
                              <img src="{{assets('sistema/images/icons/bandeira.png')}}" class="margin-top-5 margin-right-5" />
                              <img src="{{assets('sistema/images/icons/medalha.png')}}" />
                            </div>
                            <div class="row">
                              <span class="data">{{$resposta->created_at->format('d/m/Y H:i:s')}}</span>
                            </div>
                          </div>
                        </div>
                      </div>                                        
                    </div>
                  @endforeach
                </div>                                                                                  
              </div>
            @empty
              <div class="alert alert-info margin-top-50">Sem RFQs até o momento</div>
            @endforelse
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-9 main-rfq">
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/css/star-rating.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/themes/krajee-fas/theme.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/js/star-rating.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/js/locales/pt-BR.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.6/themes/krajee-fas/theme.min.js"></script>
  <script src="{{assets('sistema/js/dash/comprador/rfqs.js')}}"></script>
@endsection