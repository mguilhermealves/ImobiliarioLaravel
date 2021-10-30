  <div class="row detalhes-produto-cotacao  padding-left-20 padding-top-30 ">
    
    <div class="col-xs-2 col-sm-2 col-lg-2 col-lg-2 text-center imagem-produto">
      <img src="{{$produto->principal}}" alt="" />
    </div>
    
    
    <div class="col-xs-10 col-sm-10 col-lg-10 col-lg-10 padding-left-15">
      <h3>{{$produto->nome}}</h3>
      {{--  <p><strong>Quantidade desejada:</strong> 30.000 peças</p>
        <p><strong>Data de validade:</strong> 08/05/2019 às 09:00:30</p>  --}}
      </div>
      
    </div>
    
    <div class="row margin-top-35 respostas-produto flex-column">
      <div class="row padding-top-10 padding-bottom-10 padding-left-20 linha-title">
        <h3>{{$cotacoes->count()}} cotações para o produto acima</h3>
      </div>
      
      <div class="row respostas">
        
        <div class="col-xs-2 col-sm-2 col-lg-2 col-lg-2">
          <h4>Cotação</h4>
        </div>
        
        
        <div class="col-xs-10 col-sm-10 col-lg-10 col-lg-10">
          <div class="row">
            @foreach( $cotacoes as $cotacao)
              <div class="col-xs-3 col-sm-3 col-lg-3 col-lg-3 padding-top-15 padding-left-5 padding-bottom-15  border-linha">
                <img src="{{$cotacao->origem->logo ?? assets('sistema/images/avatar.png')}}" width="25"/>
                <p>{{$cotacao->origem->nome}}<br>
                  <img src="{{assets('sistema/images/icons/bandeira.png')}}" class="margin-top-5 margin-right-5" />
                  <img src="{{assets('sistema/images/icons/medalha.png')}}" />
                </p>
                <br class="clear"/>
                <a href="" class="ver-cotacao margin-top-20">ver cotação</a>
              </div>
            @endforeach
          </div>
        </div>
        
        
      </div>
      
    </div>
    <form data-action="{{route('sistema.dash.vendedor.cotacao.responder.todas', [$usuario->empresa->id, $produto->id])}}" class="form-normal">
      <div class="row margin-top-10 infos-cotacao">
        <div class="col-12 padding-top-10 padding-bottom-10 padding-left-20 linha-title">
          <h3>Informações da cotação</h3>
        </div>
        <div class="col-xs-2 col-sm-2 col-lg-2 col-lg-2">
          <div class="row infos">
            <div class="col-12 padding-top-30 padding-bottom-30 padding-left-20 cabecalho">
              <h4>Quantidade Desejada</h4>
            </div>
          </div>
          <div class="row infos">
            <div class="col-12 padding-top-30 padding-bottom-30 padding-left-20 cabecalho desc">
              <h4>Detalhes</h4>
            </div>
          </div>
        </div>
        @foreach($cotacoes as $cotacao)
          <div class="col-xs-2 col-sm-2 col-lg-2 col-lg-2">
            <div class="row detalhes">
              <div class="col-12 padding-top-30 padding-bottom-30 padding-left-20 border-linha">
                <p><b>{{$cotacao->quantidade}} {{$cotacao->produto->unidade->nome}}(s)</b></p>
              </div>
            </div>
            <div class="row detalhes">
              <div class="col-12 padding-top-30 padding-bottom-30 padding-left-20 text-left border-linha desc">
                {{$cotacao->detalhes}}
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <div class="row margin-top-10 infos-cotacao respostas">
        <div class="col-12 padding-top-10 padding-bottom-10 padding-left-20 linha-title">
          <h3>Responder cotação</h3>
        </div>
        <div class="col-xs-2 col-sm-2 col-lg-2 col-lg-2">
          <div class="row infos">
            <div class="col-12 cabecalho padding-left-20">
              <div class="row vertical-middle">
                <h4>Valor Unitário</h4>
              </div>
            </div>
          </div>
          <div class="row infos">
            <div class="col-12 cabecalho padding-left-20">
              <div class="row vertical-middle">
                <h4>Forma de Pagamento</h4>
              </div>
            </div>
          </div>
          <div class="row infos">
            <div class="col-12 cabecalho padding-left-20">
              <div class="row vertical-middle">
                <h4>Validade</h4>
              </div>
            </div>
          </div>
        </div>
        @foreach($cotacoes as $cotacao)
          <div class="col-xs-2 col-sm-2 col-lg-2 col-lg-2 respostas">
            <div class="row detalhes">
              <div class="col-12 padding-left-20 padding-right-20 border-linha">
                <div class="row vertical-middle">
                  <input type="text" class="form-control dinheiro-input-mask" required name="valor[{{$cotacao->id}}]" placeholder="R$ 0.00" value="{{$cotacao->valor}}">
                </div>
              </div>
            </div>
            <div class="row detalhes">
              <div class="col-12 padding-left-20 padding-right-20 border-linha">
                <div class="row vertical-middle">
                  <input type="text" class="form-control" name="pagamento[{{$cotacao->id}}]" required placeholder="A vista, em 10x, etc..." value="{{$cotacao->pagamento}}">
                </div>
              </div>
            </div>
            <div class="row detalhes">
              <div class="col-12 padding-left-20 padding-right-20 border-linha">
                <div class="row vertical-middle">
                  <input type="text" class="form-control data-hora-input-mask validade" required name="validade[{{$cotacao->id}}]" placeholder="dd/mm/yyyy" value="{{dateBdToApp($cotacao->validade)}}">
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <div class="row margin-top-50 margin-bottom-50 horizontal-center">
        <button class="roboto text-white text-18-pt bold button-yellow" type="submit">Responder Cotações</button>
      </div>
    </form>


<link rel="stylesheet" href="{{assets('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<script src="{{assets('plugins/js/mask.js')}}"></script>
<script src="{{assets('plugins/js/masks.js')}}"></script>
<script src="{{assets('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{assets('bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.pt-BR.min.js')}}"></script>
<script src="{{assets('sistema/js/app.js')}}"></script>
<script>
  $(document).ready(function(){
    $('.validade').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy',
      language: 'pt-BR',
    });
  })
</script>