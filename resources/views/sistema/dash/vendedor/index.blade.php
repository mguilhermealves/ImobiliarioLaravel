@extends('sistema.layouts.dash')
@section('content')
  @if($usuario->empresa->plano->valor == 0 )
    <div class="row margin-top-20">                    
      <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 padding-bottom-10 cabecalho-grid">
        <h4>Seja bem-vindo à sua conta <strong>Status da conta: Free - <a href="{{route('sistema.painel.plano')}}">Torne-se premium</a> anual e ganhe 60 dias grátis</strong></h4>
      </div>                    
    </div>
  @endif

<div class="row padding-bottom-90 padding-top-30">     
  
  <!-- CONTENT PAGE -->        
  <div class="col-lg-9">
    <div class="row padding-25 margin-bottom-30 panel-central">
      <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12">
        <div class="row title-box-dash">                                    
          <div class="col-xs-9 col-sm-9 col-lg-9 col-lg-9">
            <h3>Meus produtos</h3>
          </div>  
          
          <div class="text-right padding-top-10 col-xs-3 col-sm-3 col-lg-3 col-lg-3">
            <a href="#" class="link-mais-visualizados">Mais visualizados</a>
          </div>                                                                                
        </div>
        <div class="row">
          <div class="col-xs-6 col-sm-6 col-lg-6 col-lg-6">
            
            <div id="donutchart" style="width:100%; height:400px;"></div>
          </div>
          
          <div class="col-xs-6 col-sm-6 col-lg-6 col-lg-6 chart-subs">
            
          </div>
        </div>
      </div>                                                                                
    </div>
    <div class="row padding-25 margin-bottom-30 panel-central">                            
      <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12">
        <div class="row title-box-dash">                                    
          <div class="col-xs-9 col-sm-9 col-lg-9 col-lg-9">
            <h3>Cotações</h3>
          </div>                                     
          <div class="text-right padding-top-10 col-xs-3 col-sm-3 col-lg-3 col-lg-3">
            <span class="balao-msg">{{$ultimasCotacoes->count()}}</span>
            <a href="{{route('sistema.dash.vendedor.cotacoes')}}" class="link-novas-cotacoes">Novas cotações</a>
          </div>                                                                       
        </div>
        
        <!-- LISTA COTAÇÕES -->
        <div class="row margin-top-30 lista-cotacoes">
          @forelse( $ultimasCotacoes->slice(0, 4) as $cotacao )
          <div class="col-xs-6 col-sm-6 col-lg-6 col-lg-6 padding-right-10 margin-bottom-25">
            <div class="row">                                             
              <div class="col-xs-3 col-sm-3 col-lg-3 col-lg-3">
                <div class="imagem-produto"><img src="{{optional($cotacao->produto)->principal}}" alt="" /></div>
              </div>                                             
              <div class="col-xs-9 col-sm-9 col-lg-9 col-lg-9">
                <div class="row titulo-produto">
                  <h4>{{optional($cotacao->produto)->nome}}</h4>
                </div>
                <div class="row margin-top-5">
                  {{$cotacao->created_at->format('d/m/Y H:i:s')}}
                </div>
                <div class="row margin-top-10 loja-cidade">
                  <h5>{{optional($cotacao->origem)->nome}}</h5>
                </div>
                
                <div class="row margin-top-10">
                  <a href="{{route('sistema.dash.vendedor.cotacoes')}}#{{$cotacao->id}}" class="btn-detalhes-big">ver detalhes</a>
                </div>
                
              </div>                                                                                          
            </div>
          </div>
          @empty
          <div class="col-lg-6">
            <div class="row">
              <div class="alert alert-dan">Sem novas cotações por enquanto...</div>
            </div>
          </div>
          @endforelse
          
        </div>
        <!-- LISTA COTAÇÕES -->
      </div>                            
    </div>
    
    <div class="row padding-25 margin-bottom-30 panel-central">                            
      <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12">
        <div class="row title-box-dash">                                    
          <div class="col-xs-9 col-sm-9 col-lg-9 col-lg-9">
            <h3>Mensagens</h3>
          </div>                                     
          <div class="text-right padding-top-10 col-xs-3 col-sm-3 col-lg-3 col-lg-3">
            <span class="balao-msg">{{$naoLidas}}</span>
            <a href="#" class="link-novas-cotacoes">Mensagem(ns) não lida(s)</a>
          </div>                                                                       
        </div>
        <!-- LISTA COTAÇÕES -->
        <div class="row margin-top-30 lista-mensagens">
          @forelse($mensagens as $mensagem)
            <div class="col-xs-6 col-sm-6 col-lg-6 col-lg-6 padding-right-10 margin-bottom-25">
              <div class="row">                                             
                <div class="col-xs-3 col-sm-3 col-lg-3 col-lg-3">
                  <div class="imagem-user-msg"><img src="{{$mensagem->usuarioOrigem->imagem ?? assets('sistema/images/avatar.png')}}" alt="" /></div>
                </div>                                             
                <div class="col-xs-9 col-sm-9 col-lg-9 col-lg-9">
                  <div class="row previa-msg">
                    <p>
                      {{optional($mensagem->mensagens->last())->mensagem}}
                    </p>
                  </div>
                  <div class="row margin-top-10 loja-cidade">
                    <div class="col-xs-10 col-sm-10 col-lg-10 col-lg-10 nome-user">
                      <h5>{{$mensagem->usuarioOrigem->fullName}}</h5>
                    </div> 
                    <div class="row margin-top-5">
                    </div>                                                                                                                                                              
                  </div>
                  <div class="row margin-top-10">
                    <a href="{{route('sistema.dash.vendedor.mensagens')}}#{{$mensagem->id}}" class="btn-detalhes-big">ver conversa</a>
                  </div>
                </div>                                                                                          
              </div>
            </div>
          @empty
          <div class="col-lg-6">
            <div class="row">
              <div class="alert alert-dan">Sem novas mensagens por enquanto...</div>
            </div>
          </div>
          @endif
        </div>
      </div>
    </div>
    </div>
          <!-- CONTENT PAGE -->        
          
          
          <!-- ALERTS BAR RIGHT -->  
          
          
          <div class="col-xs-3 col-sm-3 col-lg-3 col-lg-3 padding-left-20 xs-padding-left-0">
            @if( $produtos->count() < 1 )
            <div class="row padding-top-35 padding-bottom-35 padding-left-10 padding-right-10 text-center mensagem-azul-bg">
              <p>Você não tem produtos no seu perfil</p>
            </div>
            @endif
            
            <div class="row padding-top-20 padding-bottom-20 padding-left-10 padding-right-10 painel-padrao-info">
              <div class="row margin-bottom-15 title-panel-padrao padding-bottom-10">
                <h5>INFO. do <strong>USUÁRIO</strong></h5>
              </div>
              
              <div class="row user-info-panel">
                
                <div class="col-xs-3 col-sm-3 col-lg-3 col-lg-3 imagem-avatar">
                  <img src="{{$usuario->imagem ?? assets('sistema/images/avatar.png')}}" />
                </div>
                
                
                <div class="col-xs-9 col-sm-9 col-lg-9 col-lg-9 padding-left-10">
                  <p>{{$usuario->fullName}}</p>
                  <p>{{$usuario->email}}</p>
                </div>
                
              </div>
              
              <div class="row margin-top-15 padding-top-15 padding-left-5 acoes-account">
                <ul>
                  <li><a href="{{route('sistema.painel.conta')}}">Alterar informações do usuário</a></li>
                  <li><a href="{{route('sistema.painel.conta')}}">Alterar senha</a></li>
                  <li><a href="{{route('sistema.painel.perfil')}}">Upload/Alterar Foto</a></li>
                  <li><a href="{{route('sistema.painel.perfil')}}">Alterar informações da empresa</a></li>
                </ul>
              </div>
            </div>
            
            <div class="row margin-top-30 padding-top-20 padding-bottom-20 padding-left-10 padding-right-10 painel-padrao-info">
              <div class="row margin-bottom-15 title-panel-padrao padding-bottom-10">
                <h5><strong>ATALHOS</strong></h5>
              </div>
              
              <div class="row padding-top-15 padding-left-5 acoes-account alert">
                <ul>
                  <li><a class="btn btn-danger text-white text-18-pt" href="{{route('sistema.dash.vendedor.produtos.novo')}}">Cadastrar novo produto</a></li>
                  <li><a class="btn btn-danger text-white text-18-pt" href="{{route('sistema.dash.vendedor.produtos')}}">Gerenciar produtos</a></li>
                  <li><a class="btn btn-danger text-white text-18-pt" href="{{route('sistema.dash.vendedor.rfqs')}}">Acessar RFQ 88</a></li>
                  <li><a class="btn btn-danger text-white text-18-pt" href="{{route('sistema.dash.vendedor.website')}}">Acessar meu Website</a></li>
                </ul>
              </div>
            </div>
            
            <div class="row margin-top-30 padding-top-20 padding-bottom-20 padding-left-10 padding-right-10 painel-padrao-info flex-column">
              <div class="row margin-bottom-15 title-panel-padrao padding-bottom-10 vertical-middle">
                <h5>RFQS <strong>RECENTES</strong></h5>
                <a href="{{route('sistema.rfq.index')}}" target="_blank" class="margin-left-15">(Ver todos)</a>
              </div>
              @forelse($leads as $lead)
                <div class="row margin-bottom-15 previa-lead">                                    
                  <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12">
                    <p><strong>Empresa: {{$lead->empresa->nome}}</strong><br/>
                      <i>{{$lead->termo}}</i><br/>
                      <strong>{{$lead->created_at->toFormattedDateString()}}</strong>
                    </p>
                  </div>                                    
                </div>
              @empty
              @endforelse
            </div>
            
            <div class="row margin-top-35 contatos-recentes lista-contatos">
              
              <div class="row padding-bottom-20 title-contatos-lateral">
                <h3>Contatos recentes</h3>
              </div>
              @forelse($usuario->contatos->sortByDesc('created_at')->take(2) as $contato)
                <div class="col-lg-12 margin-top-20">
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
                                  <button class="btn btn-sm btn-primary btn-nova text-12-pt" data-toggle="tooltip" data-url="{{route('sistema.dash.contato.novamensagem', $contato->id)}}" title="Nova Mensagem" data-id="{{$contato->id}}">
                                    <i class="fas fa-plus"></i>
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
              @endforelse
            </div>
            
            
          </div>
          
          
          <!-- ALERTS BAR RIGHT -->
          
          
          
        </div>
        @endsection
        @section('scripts')
        <link rel="stylesheet" href="{{assets('node_modules/sweetalert2/dist/sweetalert2.css')}}">
        <script src="{{assets('node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
        <link rel="stylesheet" href="{{assets('sistema/css/dash/contatos.css')}}">
        <script src="{{assets('sistema/js/dash/contatos.js')}}"></script>
        <script type="text/javascript">
          $(document).ready(function(){
            
            google.charts.load("current", {packages:["corechart"]});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
              var data = google.visualization.arrayToDataTable([
              ['Produtos', 'Categorias', 'id'],
              @forelse($categorias as $categoria)
                ['{!! $categoria->nome !!}',     {{$categoria->visitas}}, {{$categoria->id}}],
              @empty
              @endforelse
              ]);
              
              var options = {
                title: 'Categorias mais visitadas (clique para ver as subcategorias)',
                pieHole: 0.4,
                fontSize:12,                                            
                legend: 'none'
              };
              
              var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
              function selectHandler() {
                var selectedItem = chart.getSelection()[0];
                if (selectedItem) {
                  var id = data.getValue(selectedItem.row, 2);
                  getSubs(id);
                }
              }
      
              google.visualization.events.addListener(chart, 'select', selectHandler);    
              chart.draw(data, options);
              
            }
          });
          
        </script>
        @endsection