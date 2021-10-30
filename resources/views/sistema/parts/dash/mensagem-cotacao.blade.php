<div class="mensagens">
  @foreach($mensagem->mensagens->sortBy('created_at') as $msg)
    @if($msg->destino == $usuario->id )
      <div class="row mensagem-comprador margin-bottom-50">                            
        <div class="col-xs-1 col-sm-1 col-lg-1 col-lg-1 imagem-comprador">
          @if( $mensagem->usuarioOrigem->id != $usuario->id )
            <img src="{{$mensagem->usuarioOrigem->imagem ?? assets('sistema/images/avatar.png')}}" />
          @else
            <img src="{{$mensagem->usuarioDestino->imagem ?? assets('sistema/images/avatar.png')}}" />
          @endif
        </div>                            
        <div class="col-xs-11 col-sm-11 col-lg-11 col-lg-11 padding-left-5">
          <div class="row">
            @if( $mensagem->usuarioOrigem->id != $usuario->id )
            <h2><a target="_blank" href="{{route('sistema.usuarios.perfil', [$mensagem->usuarioOrigem->empresa->slug, $mensagem->usuarioOrigem->slug])}}">{{$mensagem->usuarioOrigem->fullname}}</a></h2>
            <p class="cidade-loja">{{$mensagem->usuarioOrigem->cidade}} / <a target="_blank" href="{{route('sistema.fornecedor', $mensagem->usuarioOrigem->empresa->slug)}}">{{$mensagem->usuarioOrigem->empresa->nome}}</a></p>
          @else
          <h2><a target="_blank" href="{{route('sistema.usuarios.perfil', [$mensagem->usuarioDestino->empresa->slug, $mensagem->usuarioDestino->slug])}}">{{$mensagem->usuarioDestino->fullname}}</a></h2>
            <p class="cidade-loja">{{$mensagem->usuarioDestino->cidade}} / <a target="_blank" href="{{route('sistema.fornecedor', $mensagem->usuarioDestino->empresa->slug)}}">{{$mensagem->usuarioDestino->empresa->nome}}</a></p>
          @endif
          </div>
          @if($msg->tipo == 0 )
            <div class="row margin-top-10 padding-left-15 padding-right-15 padding-top-10 padding-bottom-10 mensagem">
              <div class="col-12">
                {!! nl2p($msg->mensagem) !!}
              </div>
              <div class="col-12 margin-top-10">
                <span class="hour">{{$msg->created_at->diffForHumans()}}</span>
              </div>
            </div>
          @else
            <div class="row margin-top-10 padding-left-15 padding-right-15 padding-top-10 padding-bottom-10 mensagem">
              <div class="col-12">
                <a href="{{$msg->mensagem}}" target="_blank">
                  <div class="row">
                    {!! $msg->present()->anexo($msg) !!} <br>
                  </div>
                  <div class="row margin-top-5">
                    {{ $msg->present()->nomeAnexo($msg) }}
                  </div>
                </a>
              </div>
              <div class="col-12 margin-top-10">
                <span class="hour">{{$msg->created_at->diffForHumans()}}</span>
              </div>
            </div>
          @endif
        </div>                                                        
      </div>
    @else
      <div class="row mensagem-vendedor margin-bottom-50">
        <div class="col-xs-11 col-sm-11 col-lg-11 col-lg-11 padding-right-5">
          <div class="row text-right">
            <h5>Você</h5>                                    
          </div>
          @if($msg->tipo == 0 )
            <div class="row margin-top-10 padding-left-15 padding-right-15 padding-top-10 padding-bottom-10 mensagem">
              <div class="col-12">
                {!! nl2p($msg->mensagem) !!}
              </div>
              <div class="col-12 margin-top-10">
                <span class="hour">{{$msg->created_at->diffForHumans()}}</span>
              </div>
            </div>
          @else
            <div class="row margin-top-10 padding-left-15 padding-right-15 padding-top-10 padding-bottom-10 mensagem">
              <div class="col-12">
                <a href="{{$msg->mensagem}}" target="_blank">
                  <div class="row">
                    {!! $msg->present()->anexo($msg) !!} <br>
                  </div>
                  <div class="row margin-top-5">
                    {{ $msg->present()->nomeAnexo($msg) }}
                  </div>
                </a>
              </div>
              <div class="col-12 margin-top-10">
                <span class="hour">{{$msg->created_at->diffForHumans()}}</span>
              </div>
            </div>
          @endif
        </div>  
        <div class="col-xs-1 col-sm-1 col-lg-1 col-lg-1 imagem-comprador">
          @if( $mensagem->usuarioOrigem->id == $usuario->id )
            <img src="{{$mensagem->usuarioOrigem->imagem ?? assets('sistema/images/avatar.png')}}" />
          @else
            <img src="{{$mensagem->usuarioDestino->imagem ?? assets('sistema/images/avatar.png')}}" />
          @endif
        </div>                                                       
      </div>
    @endif
  @endforeach
</div>
@if( ($mensagem->cotacao()->exists() && $mensagem->cotacao->status != 2 ) || ( $mensagem->rfqresposta()->exists() && $mensagem->rfqresposta->lida != 2 )  )
  @if( $mensagem->usuarioOrigem->id != $usuario->id )
    <form data-action="{{route('sistema.dash.vendedor.cotacoes.mensagem.responder', $mensagem->id)}}" class="form-resposta" data-mensagem="{{$mensagem->id}}">
  @else
    <form data-action="{{route('sistema.dash.comprador.cotacoes.mensagem.responder', $mensagem->id)}}" class="form-resposta" data-mensagem="{{$mensagem->id}}">
  @endif
    <div class="row margin-bottom-50 padding-25 enviar-mensagem">
      <div class="col-lg-8">
        <textarea name="mensagem" placeholder="Digite aqui sua mensagem…" required ></textarea>
      </div>
      <div class="col-lg-1">
        <div class="row horizontal-right margin-top-5">
          <button type="button" class="btn btn-primary" title="Enviar Arquivo" data-toggle="modal" data-target="#modal_anexo">
            <i class="fas fa-paperclip"></i>
          </button>
        </div>
      </div>
      <div class="col-lg-2 text-center">
        <button class="btn-enviar-mensagem" type="submit">Enviar</button>
      </div>
    </div>
  </form>
  <div class="modal fade" id="modal_anexo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-navy text-24-pt bold" id="exampleModalLabel">Enviar arquivo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="file-loading">
            <input id="anexo" name="anexo" type="file" required>
          </div>
          <div id="kartik-file-errors"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-success btn-envia-anexo" title="Enviar arquivo para a mensagem">Enviar</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function(){
      $('.form-resposta').on('submit', function () {
        responder($(this));
        return false;
      });

      $input = $('#modal_anexo #anexo');
        $input.fileinput({
          uploadExtraData: function() {
            return {
              _token: $('meta[name=_token]').attr('content'),
              banco: true,
            };
          },
          minFileCount: 1,
          language: "pt-BR",
          overwriteInitial: false,
          maxFileSize: 5000,
          showClose: false,
          showCaption: true,
          showBrowse: true,
          browseOnZoneClick: true,
          removeLabel: 'Remover',
          showUpload: false,
          uploadAsync: true,
          maxFileCount: 0,
          initialPreviewAsData: true,
          overwriteInitial: false,
          allowedFileExtensions: ["jpg", "jpeg", "png", "gif", "pdf", "doc", "docx", "xls", "xlsx"],
          uploadUrl: '{{route('sistema.dash.mensagem.anexo', $mensagem->id)}}',
        });

        $input.on('filebatchpreupload', function (event, data, previewId, index) {
          $('body').addClass('load');
        });

        $input.on('filebatchuploaderror', function(event, data, msg) {
          $('body').removeClass('load');
        });

        $input.on('filebatchuploadcomplete', function(event, data, previewId, index) {
          $('#modal_anexo').modal('hide');
          $('.modal-backdrop').remove();
          $('body').removeClass('modal-open');
          getMensagem($('#{{$mensagem->id}}'));
        });

        $('.btn-envia-anexo').on('click', function(){
          $input.fileinput("upload");
        })
    })
  </script>
  @endif