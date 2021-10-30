
<div class="row detalhes-produto-rfq  padding-left-20 padding-top-30">
  <div class="col-xs-2 col-sm-2 col-lg-2 col-lg-2 text-center imagem-produto">
    <img src="{{$item->imagem1 ?? assets('sistema/images/sem-imagem.png')}}" alt="" />
  </div>
  <div class="col-xs-10 col-sm-10 col-lg-10 col-lg-10 padding-left-15">
    <div class="row">
      <h3 class="text-black text-24-pt bold">{{$item->termo}}</h3>
    </div>
    <div class="row margin-top-10 text-16-pt">
      <p><strong>Quantidade solicitada:</strong> {{$item->quantidade }} {{$item->unidade->nome}}(s) </p>
    </div>
    <div class="row margin-top-10 text-16-pt">
      <p><strong>Solicitado em:</strong> {{$item->created_at->format('d/m/Y H:i:s')}} </p>
    </div>
  </div>
</div>
<div class="row respostas-produto">
  <div class="col-12 margin-top-35">
    <div class="row padding-top-10 padding-bottom-10 padding-left-20 linha-title">
      <h3>{{$item->respostas->count()}} respostas para seu produto acima</h3>
    </div>
    
    <div class="row respostas">
      <div class="col-lg-2">
        <h4>Cotação</h4>
      </div>
        @foreach( $item->respostas->sortByDesc('created_at') as $resposta)
          <div class="col-lg-2 padding-top-15 padding-left-5 padding-bottom-15  border-linha">
            <img src="{{$resposta->fornecedor->imagem ?? assets('sistema/images/avatar.png')}}" alt="" width="25" />
            <p>{{$resposta->fornecedor->nome}}<br>
              <img src="{{assets('sistema/images/icons/bandeira.png')}}" class="margin-top-5 margin-right-5" />
              <img src="{{assets('sistema/images/icons/medalha.png')}}" />
            </p>
            <br class="clear"/>
            <a href="#" data-id="{{$resposta->id}}" class="ver-cotacao" data-url="{{route('sistema.dash.comprador.rfq', [$usuario->empresa->id, $resposta->id])}}">ver cotação</a>
          </div>
        @endforeach
    </div>
    
  </div>
</div>
<div class="row margin-top-20">
  <div class="col-lg-2 infos-cotacao">                                                                                       
    <div class="row infos">
      <div class="col-12 padding-top-40 padding-bottom-30 padding-left-20 cabecalho">
        <h4>Nome do produto</h4>
      </div>
    </div>
    <div class="row infos">
      <div class="col-12 padding-top-40 padding-bottom-30 padding-left-20 cabecalho descricao">
        <h4>Descricao do produto</h4>
      </div>
    </div>
    <div class="row infos">
      <div class="col-12 padding-top-40 padding-bottom-30 padding-left-20 cabecalho imagens">
        <h4>Imagens do produto</h4>
      </div>
    </div>
    <div class="row infos">
      <div class="col-12 padding-top-40 padding-bottom-30 padding-left-20 cabecalho">
        <h4>Valor unitário</h4>
      </div>
    </div>
    <div class="row infos">
      <div class="col-12 padding-top-40 padding-bottom-30 padding-left-20 cabecalho">
        <h4>Forma de pagamento</h4>
      </div>
    </div>
    <div class="row infos">
      <div class="col-12 padding-top-40 padding-bottom-30 padding-left-20 cabecalho">
        <h4>Validade da cotação</h4>
      </div>
    </div>
  </div>
  @foreach( $item->respostas->sortByDesc('created_at') as $resposta)
    <div class="col-lg-2 infos-cotacao">                                                                                       
      <div class="row infos">
        <div class="col-12 detalhes">
          <div class="row padding-left-10 padding-right-10 padding-top-30 padding-bottom-30 text-center border-linha">                                             
            <span class="text-14-pt bold">{{$resposta->nomeProduto}}</span>
          </div>
        </div>
      </div>
      <div class="row infos">
        <div class="col-12 detalhes">
          <div class="row padding-left-10 padding-right-10 padding-top-30 padding-bottom-30 text-center border-linha descricao">                                             
            <span class="text-14-pt bold">{!! $resposta->descricao !!}</span>
          </div>
        </div>
      </div>
      <div class="row infos">
        <div class="col-12 detalhes">
            @if( count($resposta->imagens) > 1 ) 
              <div class="slider text-center border-linha imagens">
                @foreach($resposta->imagens as $img)
                  <a href="{{$img}}" data-fancybox="images" data-src="{{$img}}" rel="slider" class="">
                    <img src="{{$img}}" alt="">
                  </a>
                @endforeach
              </div>
            @else
              Sem Imagens
            @endif
        </div>
      </div>
      <div class="row infos">
        <div class="col-12 detalhes">
          <div class="row padding-left-10 padding-right-10 padding-top-40 padding-bottom-30 text-center border-linha">                                             
            <span class="text-14-pt bold">{{currencyToApp($resposta->valor)}} por {{$resposta->unidade->nome}}</span>
          </div>
        </div>
      </div>
      <div class="row infos">
        <div class="col-12 detalhes">
          <div class="row padding-left-10 padding-right-10 padding-top-40 padding-bottom-30 text-center border-linha">                                             
            <span class="text-14-pt bold">{{$resposta->pagamento}}</span>
          </div>
        </div>
      </div>
      <div class="row infos">
        <div class="col-12 detalhes">
          <div class="row padding-left-10 padding-right-10 padding-top-40 padding-bottom-30 text-center border-linha">                                             
            <span class="text-14-pt bold">{{dateBdToApp($resposta->validade)}}</span>
          </div>
        </div>
      </div>
    </div>
  @endforeach
</div>
  
  
  
</div>
<script src="{{assets('sistema/js/app.js')}}"></script>
<script src="{{assets('sistema/js/dash/vendedor/mensagens.js')}}"></script>
<link rel="stylesheet" href="{{assets('sistema/css/rfq/resposta.css')}}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" rel="stylesheet">
<script>
  $(document).ready(function(){
    if( $('.slider').length > 0  ){
      $('.slider').slick({
        dots: false,
        arrows: true
      });
    }
  })
</script>