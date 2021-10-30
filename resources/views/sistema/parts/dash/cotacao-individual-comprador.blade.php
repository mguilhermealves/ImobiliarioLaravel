
<div class="row detalhes-produto-cotacao  padding-left-20 padding-top-30">
  
  <div class="col-xs-2 col-sm-2 col-lg-2 col-lg-2 text-center imagem-produto">
    <img src="{{$cotacao->produto->principal}}" alt="" />
  </div>
  
  
  <div class="col-xs-10 col-sm-10 col-lg-10 col-lg-10 padding-left-15">
    <div class="row">
      <h3><a target="_blank" href="{{route('sistema.produto', $cotacao->produto->slug)}}">{{$cotacao->produto->nome}}</a></h3>
    </div>
    <div class="row">
      <p><strong>Quantidade desejada:</strong> {{$cotacao->quantidade}} {{$cotacao->produto->unidade->nome}}(s)</p>
    </div>
    <p><strong>Data de validade:</strong> {{dateBdToApp($cotacao->validade)}}</p>
    @if($cotacao->anexo != null )
      <div class="row margin-top-10">
        <strong>Arquivo anexo:</strong>
      </div>
      <div class="row margin-top-10 padding-left-10">
        <a href="{{$cotacao->anexo}}" target="_blank" class="text-center">
          <i class="far fa-file-alt text-black text-40-pt"></i><br>
          <span class="">{{$cotacao->present()->nomeAnexo()}}</span>
        </a>
      </div>
    @endif
    <div class="row">
      @if( $cotacao->mensagem()->exists() && $cotacao->mensagem->usuarioOrigem->id != $usuario->id )
          @if( !$usuario->present()->contato($cotacao->mensagem->usuarioOrigem) )
            <button class="btn-warning add add-contato" data-id="{{$cotacao->mensagem->id}}" data-toggle="tooltip" title="Adicionar contato" data-url="{{route('sistema.dash.contato.adicionar', $cotacao->mensagem->usuarioOrigem)}}"><i class="far fa-user"></i>+</button>
          @endif
        @else
          @if( $cotacao->mensagem()->exists() && !$usuario->present()->contato($cotacao->mensagem->usuarioDestino) )
            <button class="btn-warning add add-contato padding-10" data-id="{{$cotacao->mensagem->id}}" data-toggle="tooltip" title="Adicionar contato" data-url="{{route('sistema.dash.contato.adicionar', $cotacao->mensagem->usuarioDestino)}}"><i class="far fa-user"></i>+</button>
          @endif
        @endif
    </div>
  </div>
  
</div>

<div class="row">
  
  <div class="col-xs-5 col-sm-5 col-lg-5 col-lg-5">                                                                                       
    <div class="row margin-top-10 infos-cotacao flex-column">
      @if( $cotacao->valor != null )
        <div class="row padding-top-10 padding-bottom-10 padding-left-20 linha-title">
          <h3>Resposta da cotação</h3>
        </div>
          <div class="row infos">
            <div class="col-xs-6 col-sm-6 col-lg-6 col-lg-6 padding-top-40 padding-bottom-30 padding-left-20 cabecalho">
              <h4>Valor Unitário</h4>
            </div>
            <div class="col-xs-6 col-sm-6 col-lg-6 col-lg-6 detalhes">
              <div class="row">                                            
                <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 padding-left-10 padding-right-10 padding-top-40 padding-bottom-30 text-center border-linha">
                  <p>{{currencyToApp($cotacao->valor)}}</p>
                </div>                                                                                                                           
              </div>
            </div>
          </div>
          
          <div class="row infos">
            <div class="col-xs-6 col-sm-6 col-lg-6 col-lg-6 padding-top-40 padding-bottom-30 padding-left-20 cabecalho">
              <h4>Forma de pagamento</h4>
            </div>
            <div class="col-xs-6 col-sm-6 col-lg-6 col-lg-6 detalhes">
              <div class="row">                                            
                <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 padding-left-10 padding-right-10 padding-top-40 padding-bottom-30 text-center border-linha">
                  <p>{{$cotacao->pagamento}}</p>
                </div>                                                                 
              </div>
            </div>
          </div>
          
          <div class="row infos">
            <div class="col-xs-6 col-sm-6 col-lg-6 col-lg-6 padding-top-40 padding-bottom-30 padding-left-20 cabecalho">
              <h4>Validade da cotação</h4>
            </div>
            <div class="col-xs-6 col-sm-6 col-lg-6 col-lg-6 detalhes">
              <div class="row">                                            
                <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 padding-left-10 padding-right-10 padding-top-40 padding-bottom-30 text-left border-linha horizontal-center">
                  <p>{{dateBdToApp($cotacao->validade)}}</p>
                </div>
              </div>
            </div>
          </div>
      @else
        <div class="row padding-top-10 padding-bottom-10 padding-left-20 linha-title">
          <h3>Cotação ainda não respondida!</h3>
        </div>
      @endif
      </div>
  </div>
  
  
  <div class="col-lg-7 padding-left-20 main-mensagem relative" id="{{$cotacao->mensagem->id ?? 0}}" data-url="{{route('sistema.dash.comprador.cotacao.mensagens', [$cotacao->mensagem ?? 0])}}">
  </div>
  
  
</div>
<link rel="stylesheet" href="{{assets('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<script src="{{assets('plugins/js/mask.js')}}"></script>
<script src="{{assets('plugins/js/masks.js')}}"></script>
<script src="{{assets('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{assets('bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.pt-BR.min.js')}}"></script>
<script src="{{assets('sistema/js/app.js')}}"></script>
<link rel="stylesheet" href="{{assets('node_modules/sweetalert2/dist/sweetalert2.css')}}">
<script src="{{assets('node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
<script src="{{assets('sistema/js/dash/vendedor/mensagens.js')}}"></script>
<script>
  $(document).ready(function(){
    $('.validade').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy',
      language: 'pt-BR',
    });
    $('.add-contato').on('click', function () {
      addContato($(this));
      return false;
    });
    @if( $cotacao->mensagem != null )
      getMensagem($('.main-mensagem'));
    @endif
  })
</script>