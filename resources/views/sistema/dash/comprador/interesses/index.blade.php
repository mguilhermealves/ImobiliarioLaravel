@extends('sistema.layouts.dash')
@section('content')

<section class="dash-interesses">
  <div class="row">                                                                                                      
    <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12">
      <div class="row padding-left-30 padding-top-20  padding-bottom-20 titulo-fundo-cinza">
        <h2>Minha lista de interesses</h2>
      </div>
      <div class="row padding-top-30 padding-bottom-30 padding-left-30 lista-interesse">
        @forelse($lista as $produto)
          <div class="col-xs-6 col-sm-6 col-lg-6 col-lg-6 padding-15 produto">
            <div class="row box-interesse">                                    
              <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12">
                <div class="row padding-left-30 padding-right-30 padding-top-25 padding-bottom-25">                                            
                  <div class="col-xs-3 col-sm-3 col-lg-3 col-lg-3">
                    <div class="imagem-produto">
                      <img src="{{$produto->principal}}" alt="">
                    </div>
                  </div>                                            
                  <div class="col-xs-9 col-sm-9 col-lg-9 col-lg-9 padding-left-10">
                    <h3>{{$produto->nome}}</h3>
                  </div>                                            
                </div>
                
                <div class="row padding-top-15 padding-bottom-15 text-center label-info">                                            
                  <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12">
                    <h2>Informações do produto</h2>
                  </div>                                            
                </div>
                <div class="row detalhes-produto-lista">                                            
                  <div class="col-xs-6 col-sm-6 col-lg-6 col-lg-6 padding-right-40 text-right">
                    <p><strong>Local</strong></p>
                  </div>                                                    
                  <div class="col-xs-6 col-sm-6 col-lg-6 col-lg-6 text-left">
                    <p>{{$produto->empresa->cidade}} - {{$produto->empresa->uf}}</p>
                  </div>                                                                                
                </div>
                <div class="row detalhes-produto-lista">                                            
                  <div class="col-xs-6 col-sm-6 col-lg-6 col-lg-6 padding-right-40 text-right">
                    <p><strong>Quantidade Mínima</strong></p>
                  </div>                                                    
                  <div class="col-xs-6 col-sm-6 col-lg-6 col-lg-6 text-left">
                    <p>{{$produto->quantidade_minima}} {{$produto->unidade->nome}}s</p>
                  </div>                                                                                
                </div>
                <div class="row detalhes-produto-lista">                                            
                  <div class="col-xs-6 col-sm-6 col-lg-6 col-lg-6 padding-right-40 text-right">
                    <p><strong>Preço</strong></p>
                  </div>                                                    
                  <div class="col-xs-6 col-sm-6 col-lg-6 col-lg-6 text-left">
                    <p>{{$produto->preco}} por {{$produto->unidade->nome}}</p>
                  </div>                                                                                
                </div>
                <div class="row detalhes-produto-lista">                                            
                  <div class="col-xs-6 col-sm-6 col-lg-6 col-lg-6 padding-right-40 text-right">
                    <p><strong>Forma de pagamento</strong></p>
                  </div>                                                    
                  <div class="col-xs-6 col-sm-6 col-lg-6 col-lg-6 text-left">
                    <p>{{$produto->pagamentoFront}}</p>
                  </div>                                                                                
                </div>
                <div class="row detalhes-produto-lista">                                            
                  <div class="col-xs-6 col-sm-6 col-lg-6 col-lg-6 padding-right-40 text-right">
                    <p><strong>Tipo de frete</strong></p>
                  </div>                                                    
                  <div class="col-xs-6 col-sm-6 col-lg-6 col-lg-6 text-left">
                    <p>{{$produto->freteFront}}</p>
                  </div>                                                                                
                </div>
                <div class="row">                                            
                  <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 padding-top-30 padding-bottom-30 entrar-contato">
                    <a href="{{route('sistema.produto.cotacao', $produto->slug)}}" target="_blank" class="btn-detalhes-big">Solicitar Cotação</a>
                  </div>                                            
                </div>
                <div class="row text-center padding-top-15 padding-bottom-15 remover-da-lista">
                  <a href="#" data-url="{{route('sistema.produto.favorito.del', $produto->slug)}}" class="del-interesse"><i class="fas fa-trash-alt" aria-hidden="true"></i> Remover item da lista de interesse</a>
                </div>
              </div>                                    
            </div>
          </div>
        @empty
        @endforelse
        
      </div>
      
      
    </div>
  </div>
  
</section>

@endsection

@section('scripts')
  <link rel="stylesheet" href="{{assets('node_modules/sweetalert2/dist/sweetalert2.css')}}">
  <script src="{{assets('node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
  <script src="{{assets('sistema/js/dash/interesse.js')}}"></script>
@endsection