@extends('sistema.layouts.dash')
@section('content')
<link rel="stylesheet" href="{{assets('sistema/css/dash/mensagens.css')}}">

<section class="dash-mensagens">
  
    <div class="row">     
      <div class="col-12 grid-panel padding-right-30">
        <div class="row">     
          <div class="col-lg-3 text-center coluna-usuarios-mensagem lista-mensagens">
            <h3>Todas as mensagens</h3>
            <div class="row padding-top-15 padding-left-20 barra-search">
              <input type="search" placeholder="Pesquisa..." />
              <a class="btn btn-primary margin-left-20" title="Nova conversa" data-toggle="tooltip" data-fancybox data-type="iframe" data-src="{{route('sistema.dash.contatos.modal')}}" href="javascript:;">+</a>
            </div>
            @forelse( $mensagens as $mensagem)
              <div class="row padding-top-30 padding-bottom-30 padding-left-20 linha-usuario-mensagem mensagem" data-id="#{{$mensagem->id}}" id="{{$mensagem->id}}" data-url="{{route('sistema.dash.comprador.mensagens.mensagem', $mensagem->id)}}">                            
                <div class="col-xs-9 col-sm-9 col-lg-9 col-lg-9">
                  <div class="row">                                    
                    <div class="col-xs-3 col-sm-3 col-lg-3 col-lg-3 avatar-usuario">
                      <img src="{{$mensagem->usuarioDestino->imagem ?? assets('sistema/images/avatar.png')}}" />
                    </div>
                    <div class="col-xs-9 col-sm-9 col-lg-9 col-lg-9 text-left padding-left-15">
                      <div class="row">
                        <p>{{$mensagem->usuarioDestino->fullName}}</p> <?php echo   $mensagem->rfqresposta_id;   ?>
                      </div>
                      <div class="row margin-top-5">
                        <p class="text-navy medium">{{$mensagem->usuarioDestino->empresa->nome}}</p>
                      </div>
                      <div class="row">
                        @if( $mensagem->status == 0 )
                          <h5>Novas mensagens</h5>
                        @else
                          <h5>Respondido {{$mensagem->updated_at->diffForHumans()}}</h5>
                        @endif
                      </div>
                    </div>
                    
                  </div>
                </div>                            
                <div class="col-xs-3 col-sm-3 col-lg-3 col-lg-3 padding-top-5 icones text-left">
                  <img src="{{$mensagem->usuarioDestino->empresa->plano->icone}}" width="30px"/>
                </div>                                                        
              </div>
            @empty
              <div class="alert alert-danger">Nenhuma mensagem enviada ainda!</div>
            @endforelse
            
          </div>
          
          <div class="col-lg-9 padding-left-20 main-mensagem relative">
            
          </div>
          
          
          
        </div>
        
      </div>  
    </div>
  
</section>

@endsection

@section('scripts')
  <link rel="stylesheet" href="{{assets('node_modules/sweetalert2/dist/sweetalert2.css')}}">
  <script src="{{assets('node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
  <script src="{{assets('sistema/js/dash/vendedor/mensagens.js')}}"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/plugins/piexif.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/fileinput.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/locales/pt-BR.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
  <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
  <style>
    @media( min-width: 769px ){
      .fancybox-slide--iframe .fancybox-content {
        width  : auto;
        height : auto;
        max-width  : 80%;
        max-height : 100%;
        margin: 0;
        background: #191919;
      }
    }
  </style>
  <script>
    $(document).ready(function(){
      if(window.location.hash !== "") {
        $('a[href="' + window.location.hash + '"]').click();
        $target = $('div[data-id="' + window.location.hash + '"]');
        if( $target.length > 0 ){
          getMensagem($target);
        }
      }
    })
  </script>
@endsection