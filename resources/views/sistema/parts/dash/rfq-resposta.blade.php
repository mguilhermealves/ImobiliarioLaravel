
<div class="row detalhes-produto-rfq  padding-left-20 padding-top-30">
  <div class="col-xs-2 col-sm-2 col-lg-2 col-lg-2 text-center imagem-produto">
    <img src="{{$resposta->rfq->imagem1}}" alt="" />
  </div>
  <div class="col-xs-10 col-sm-10 col-lg-10 col-lg-10 padding-left-15">
    <div class="row">
      <h3 class="text-black text-24-pt bold">{{$resposta->rfq->termo}}</h3>
    </div>
    <div class="row margin-top-10 text-16-pt">
      <p><strong>Quantidade solicitada:</strong> {{$resposta->rfq->quantidade}} {{$resposta->rfq->unidade->nome}}(s)</p>
    </div>
    <div class="row margin-top-10 text-16-pt">
      <p><strong>Informações adicionais:</strong> {{$resposta->rfq->informacoes}}</p>
    </div>
  </div>
</div>
@if($resposta->rfq->imagem1 != null )
  <div class="row margin-top-10 padding-left-20 text-black text-18-pt">
    <strong>Arquivo(s) anexo(s):</strong>
  </div>
  <div class="row margin-top-10 padding-left-20">
    @foreach(range(1,5) as $item)
      @if( $resposta->rfq->{'imagem'.$item} != null )
        <div class="col-lg-2">
          <div class="row margin-top-5">
            <a href="{{ $resposta->rfq->{'imagem'.$item} }}" target="_blank" class="text-center text-navy">
              <i class="far fa-file-alt text-black text-40-pt padding-bottom-10"></i><br>
              <span class="">{{$resposta->rfq->present()->nomeAnexo($resposta->rfq->{'imagem'.$item})}}</span>
            </a>
          </div>
        </div>
      @endif
    @endforeach
  </div>
@endif
<div class="row margin-top-20">
  <div class="col-lg-8">                                                                                       
    <div class="row margin-top-10 infos-cotacao flex-column">
      <div class="row padding-top-10 padding-bottom-10 padding-left-20 linha-title">
        <h3 class="text-black text-20-pt bold">Responder cotação</h3>
      </div>
      <div class="row flex-column">
        <form data-action="{{route('sistema.dash.vendedor.rfq.responder',[$usuario->empresa->id, $resposta->id])}}" class="form-normal">
          <div class="row infos">
            <div class="col-xs-6 col-sm-6 col-lg-6 col-lg-6 padding-top-40 padding-bottom-30 padding-left-20 cabecalho">
              <h4>Produto a ser enviado</h4>
            </div>
            <div class="col-xs-6 col-sm-6 col-lg-6 col-lg-6 detalhes">
              <div class="row">                                             
                <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 padding-left-10 padding-right-10 padding-top-30 padding-bottom-30 text-center border-linha">
                  {!! Form::select('produto_id', [null => 'Selecione uma opção'] + $produtos, $resposta->produto_id ?? null, ['class' => 'select2 form-control produtos']) !!}
                </div>                                                                                                                           
              </div>
            </div>
          </div>
          <div class="row infos">
            <div class="col-xs-6 col-sm-6 col-lg-6 col-lg-6 padding-top-40 padding-bottom-30 padding-left-20 cabecalho">
              <h4>Valor Unitário</h4>
            </div>
            <div class="col-xs-6 col-sm-6 col-lg-6 col-lg-6 detalhes">
              <div class="row">                                             
                <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 padding-left-10 padding-right-10 padding-top-30 padding-bottom-30 text-center border-linha">
                  <input type="text" class="form-control dinheiro-input-mask" name="valor" placeholder="R$ 0.00" value="{{currencyToApp($resposta->valor)}}">
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
                <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 padding-left-10 padding-right-10 padding-top-30 padding-bottom-30 text-center border-linha">
                  <input type="text" class="form-control" name="pagamento" placeholder="A vista, em 10x, etc..." value="{{$resposta->pagamento}}">
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
                <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 padding-left-10 padding-right-10 padding-top-30 padding-bottom-30 text-left border-linha">
                  <input type="text" class="form-control data-hora-input-mask validade" name="validade" placeholder="dd/mm/yyyy" value="{{dateBdToApp($resposta->validade)}}">
                </div>
              </div>
            </div>
          </div>
          <div class="row margin-top-50 horizontal-center margin-bottom-50">
            <button class="roboto text-white text-18-pt bold button-yellow" type="submit">Responder Cotação</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  
  {{--  <div class="col-lg-7 padding-left-20 main-mensagem relative" id="{{$rfq->mensagem->id ?? 0}}" data-url="{{route('sistema.dash.vendedor.rfq.mensagens', [$rfq->mensagem ?? 0])}}">
            
  </div>  --}}
  
  
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
<link rel="stylesheet" href="{{assets('backend/bower_components/select2/dist/css/select2.min.css')}}">
<script src="{{assets('backend/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script>
  $(document).ready(function(){
    $('body').find('.select2').each(function(){
      makeSelect2($(this));
    })
    $('.validade').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy',
      language: 'pt-BR',
    });
  })
</script>