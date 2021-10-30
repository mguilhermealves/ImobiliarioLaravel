
<div class="row detalhes-produto-cotacao  padding-left-20 padding-top-30">
  
  <div class="col-xs-2 col-sm-2 col-lg-2 col-lg-2 text-center imagem-produto">
    <img src="{{$cotacao->produto->principal}}" alt="" />
  </div>
  
  
  <div class="col-xs-10 col-sm-10 col-lg-10 col-lg-10 padding-left-15">
    <div class="row">
      <h3>{{$cotacao->produto->nome}}</h3>
    </div>
    <div class="row">
      <p><strong>Quantidade desejada:</strong> {{$cotacao->quantidade}} {{$cotacao->produto->unidade->nome}}(s)</p>
    </div>
    {{-- <p><strong>Data de validade:</strong> 08/05/2019 às 09:00:30</p> --}}
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
  </div>
  
</div>

<div class="row">
  
  <div class="col-xs-5 col-sm-5 col-lg-5 col-lg-5">                                                                                       
    <div class="row margin-top-10 infos-cotacao">
      <div class="row padding-top-10 padding-bottom-10 padding-left-20 linha-title">
        <h3>Responder cotação</h3>
      </div>
      <form data-action="{{route('sistema.dash.vendedor.cotacao.responder',[$usuario->empresa->id, $cotacao->id])}}" class="form-normal">
        <div class="row infos">
          <div class="col-xs-6 col-sm-6 col-lg-6 col-lg-6 padding-top-40 padding-bottom-30 padding-left-20 cabecalho">
            <h4>Valor Unitário</h4>
          </div>
          <div class="col-xs-6 col-sm-6 col-lg-6 col-lg-6 detalhes">
            <div class="row">                                            
              <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 padding-left-10 padding-right-10 padding-top-30 padding-bottom-30 text-center border-linha">
                <input type="text" class="form-control dinheiro-input-mask" name="valor" placeholder="R$ 0.00" value="{{$cotacao->valor}}">
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
                <input type="text" class="form-control" name="pagamento" placeholder="A vista, em 10x, etc..." value="{{$cotacao->pagamento}}">
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
                <input type="text" class="form-control data-hora-input-mask validade" name="validade" placeholder="dd/mm/yyyy" value="{{dateBdToApp($cotacao->validade)}}">
              </div>
            </div>
          </div>
        </div>
        <div class="row margin-top-50 horizontal-center">
          <button class="roboto text-white text-18-pt bold button-yellow" type="submit">Responder Cotação</button>
        </div>
      </form>
    </div>
  </div>
  
  
  <div class="col-xs-7 col-sm-7 col-lg-7 col-lg-7 padding-left-20 padding-right-20 mensagens">
    <div class="row mensagem-comprador margin-bottom-50">                            
      <div class="col-xs-1 col-sm-1 col-lg-1 col-lg-1 imagem-comprador">
        <img src="assets/img/avatar-comprador.png" />
      </div>                            
      <div class="col-xs-11 col-sm-11 col-lg-11 col-lg-11 padding-left-5">
        <div class="row">
          <h5>Casa dos Celulares Taiwan</h5>                                    
        </div>
        <div class="row padding-left-15 padding-right-15 padding-top-10 padding-bottom-10 mensagem">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sit amet rutrum enim. Pellentesque ac imperdiet metus. Morbi faucibus faucibus sapien, sit amet tincidunt eros congue sed. Sed vel suscipit mauris, sit amet vestibulum nulla. Suspendisse rutrum ante vel nunc pulvinar, eget semper ipsum maximus. In eu tincidunt lacus. Etiam viverra viverra pretium. In hac habitasse platea dictumst. Vivamus dapibus, risus sed convallis maximus, mauris enim ultrices dui, non cursus odio odio in dui.</p>
          <span class="hour">5 minutos atrás</span>
        </div>
      </div>                                                        
    </div>
    
    <div class="row mensagem-vendedor margin-bottom-50">                                                                                       
      <div class="col-xs-11 col-sm-11 col-lg-11 col-lg-11 padding-right-5">
        <div class="row text-right">
          <h5>Você</h5>                                    
        </div>
        <div class="row padding-left-15 padding-right-15 padding-top-10 padding-bottom-10 mensagem">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sit amet rutrum enim. Pellentesque ac imperdiet metus. Morbi faucibus faucibus sapien, sit amet tincidunt eros congue sed. Sed vel suscipit mauris, sit amet vestibulum nulla. Suspendisse rutrum ante vel nunc pulvinar, eget semper ipsum maximus. In eu tincidunt lacus. Etiam viverra viverra pretium. In hac habitasse platea dictumst. Vivamus dapibus, risus sed convallis maximus, mauris enim ultrices dui, non cursus odio odio in dui.</p>
          <span class="hour">5 minutos atrás</span>
        </div>
      </div>  
      <div class="col-xs-1 col-sm-1 col-lg-1 col-lg-1 imagem-comprador">
        <img src="assets/img/avatar-comprador.png" />
      </div>                                                       
    </div>
    
    <div class="row mensagem-comprador margin-bottom-50">                            
      <div class="col-xs-1 col-sm-1 col-lg-1 col-lg-1 imagem-comprador">
        <img src="assets/img/avatar-comprador.png" />
      </div>                            
      <div class="col-xs-11 col-sm-11 col-lg-11 col-lg-11 padding-left-5">
        <div class="row">
          <h5>Casa dos Celulares Taiwan</h5>                                    
        </div>
        <div class="row padding-left-15 padding-right-15 padding-top-10 padding-bottom-10 mensagem">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sit amet rutrum enim. Pellentesque ac imperdiet metus. Morbi faucibus faucibus sapien, sit amet tincidunt eros congue sed. Sed vel suscipit mauris, sit amet vestibulum nulla. Suspendisse rutrum ante vel nunc pulvinar, eget semper ipsum maximus. In eu tincidunt lacus. Etiam viverra viverra pretium. In hac habitasse platea dictumst. Vivamus dapibus, risus sed convallis maximus, mauris enim ultrices dui, non cursus odio odio in dui.</p>
          <span class="hour">5 minutos atrás</span>
        </div>
      </div>                                                        
    </div>
    
    <div class="row mensagem-comprador margin-bottom-50">                            
      <div class="col-xs-1 col-sm-1 col-lg-1 col-lg-1 imagem-comprador">
        <img src="assets/img/avatar-comprador.png" />
      </div>                            
      <div class="col-xs-11 col-sm-11 col-lg-11 col-lg-11 padding-left-5">
        <div class="row">
          <h5>Casa dos Celulares Taiwan</h5>                                    
        </div>
        <div class="row padding-left-15 padding-right-15 padding-top-10 padding-bottom-10 mensagem">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus sit amet rutrum enim. Pellentesque ac imperdiet metus. Morbi faucibus faucibus sapien, sit amet tincidunt eros congue sed. Sed vel suscipit mauris, sit amet vestibulum nulla. Suspendisse rutrum ante vel nunc pulvinar, eget semper ipsum maximus. In eu tincidunt lacus. Etiam viverra viverra pretium. In hac habitasse platea dictumst. Vivamus dapibus, risus sed convallis maximus, mauris enim ultrices dui, non cursus odio odio in dui.</p>
          <span class="hour">5 minutos atrás</span>
        </div>
      </div>                                                        
    </div>
    
    <div class="row margin-bottom-50 padding-25 enviar-mensagem">
      
      <div class="col-xs-9 col-sm-9 col-lg-9 col-lg-9">
        <textarea name="enviar_mensagem" placeholder="Digite aqui sua mensagem…" ></textarea>
      </div>
      
      <div class="col-xs-3 col-sm-3 col-lg-3 col-lg-3 text-center">
        <button class="btn-enviar-mensagem">Enviar</button>
      </div>
      
    </div>
    
  </div>
  
  
</div>
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