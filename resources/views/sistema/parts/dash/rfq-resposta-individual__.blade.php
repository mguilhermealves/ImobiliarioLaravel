
<div class="row detalhes-produto-rfq  padding-left-20 padding-top-30">
  <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-center imagem-produto">
    <img src="{{$resposta->fornecedor->imagem ?? assets('sistema/images/avatar.png')}}" alt="" />
  </div>
  <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 padding-left-15">
    <div class="row">
      <h3 class="text-black text-24-pt bold">{{$resposta->fornecedor->nome}}</h3>
    </div>
    <div class="row margin-top-10 text-16-pt">
      <p><strong>Respondida em:</strong> {{$resposta->created_at->format('d/m/Y H:i:s')}} </p>
    </div>
  </div>
</div>
<div class="row margin-top-20">
  <div class="col-md-4">                                                                                       
    <div class="row margin-top-10 infos-cotacao flex-column">
      <div class="row padding-top-10 padding-bottom-10 padding-left-20 linha-title">
        <h3 class="text-black text-20-pt bold">Resposta da cotação</h3>
      </div>
      <div class="row flex-column">
        <div class="row infos">
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 padding-top-40 padding-bottom-30 padding-left-20 cabecalho">
            <h4>Nome do produto</h4>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 detalhes">
            <div class="row padding-left-10 padding-right-10 padding-top-30 padding-bottom-30 text-center border-linha">                                             
              <span class="text-14-pt bold">{{$resposta->nomeProduto}}</span>
            </div>
          </div>
        </div>
        <div class="row infos">
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 padding-top-40 padding-bottom-30 padding-left-20 cabecalho">
            <h4>Descrição do produto</h4>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 detalhes">
            <div class="row padding-left-10 padding-right-10 padding-top-30 padding-bottom-30 text-center border-linha">                                             
              <span class="text-14-pt bold">{{$resposta->descricao}}</span>
            </div>
          </div>
        </div>
        <div class="row infos">
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 padding-top-40 padding-bottom-30 padding-left-20 cabecalho">
            <h4>Imagens do produto</h4>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 detalhes">
            <div class="row padding-left-10 padding-right-10 padding-top-30 padding-bottom-30 text-center border-linha">                                             
              @if( count($resposta->imagens) > 1 ) 
                <div class="slider">
                  @foreach($resposta->imagens as $img)
                    <a href="{{$img}}" data-fancybox data-src="{{$img}}" class="">
                      <img src="{{$img}}" alt="">
                    </a>
                  @endforeach
                </div>
              @else
                Sem Imagens
              @endif
            </div>
          </div>
        </div>
        <div class="row infos">
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 padding-top-40 padding-bottom-30 padding-left-20 cabecalho">
            <h4>Valor Unitário</h4>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 detalhes">
            <div class="row padding-left-10 padding-right-10 padding-top-40 padding-bottom-30 text-center border-linha">                                             
              <span class="text-14-pt bold">{{currencyToApp($resposta->valor)}} por {{$resposta->unidade->nome}}</span>
            </div>
          </div>
        </div>
        <div class="row infos">
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 padding-top-40 padding-bottom-30 padding-left-20 cabecalho">
            <h4>Forma de pagamento</h4>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 detalhes">
            <div class="row padding-left-10 padding-right-10 padding-top-40 padding-bottom-30 text-center border-linha">                                             
              <span class="text-14-pt bold">{{$resposta->pagamento}}</span>
            </div>
          </div>
        </div>
        <div class="row infos">
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 padding-top-40 padding-bottom-30 padding-left-20 cabecalho">
            <h4>Validade da cotação</h4>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 detalhes">
            <div class="row padding-left-10 padding-right-10 padding-top-40 padding-bottom-30 text-center border-linha">                                             
              <span class="text-14-pt bold">{{dateBdToApp($resposta->validade)}}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
  {{--  <div class="col-md-7 padding-left-20 main-mensagem relative" id="{{$rfq->mensagem->id ?? 0}}" data-url="{{route('sistema.dash.vendedor.rfq.mensagens', [$rfq->mensagem ?? 0])}}">
            
  </div>  --}}
  
  
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
        infinite: true,
        dots: false,
        arrows: true
      });
    }
  })
</script>