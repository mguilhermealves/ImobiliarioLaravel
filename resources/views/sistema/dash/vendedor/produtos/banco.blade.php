@extends('sistema.layouts.dash')
@section('content')

<section class="banco-de-fotos">
  
  <div class="row">     
    
    <div class="col-12 padding-bottom-50">
      <div class="row padding-left-30 padding-top-20 padding-bottom-20 titulo-fundo-cinza">                            
        <div class="col-xs-3 col-sm-3 col-lg-3 col-lg-3">
          <h2>Banco de Fotos</h2>
        </div>                                                                                    
        <div class="col-xs-9 col-sm-9 col-lg-9 col-lg-9 topo-banco">
          <div class="row">                                    
            <div class="col-xs-4 col-sm-4 col-lg-4 col-lg-4 padding-top-10 capacidade-banco">
              Você usou {{$tamanho}}mb de {{$usuario->empresa->plano->banco}} MB
            </div>
            <div class="col-xs-3 col-sm-3 col-lg-3 col-lg-3 padding-right-10 barra-porcentagem text-center">
              {{ number_format( ($tamanho / $usuario->empresa->plano->banco) * 100,2) }}%
              <div class="barra-loading">
                <div class="porcentagem" data-porcentagem="{{ number_format( ($tamanho / $usuario->empresa->plano->banco) * 100,2,'.', ',') }}"></div>
              </div>
            </div> 
            
          </div>                                   
        </div>                            
      </div>
      @if( $add )
        <div class="row margin-top-50 padding-left-30">
          <h3 class="text-24-pt bold">Adicionar Imagens</h3>
        </div>

        <div class="row margin-top-30 padding-left-30 padding-right-30 flex-column">
            <input type="file" class="galeria" name="file" multiple />
        </div>
      @else
        <div class="row margin-top-50 padding-left-30">
          <h3 class="text-24-pt bold">Você atingiu o limite do seu banco de imagens!</h3>
        </div>
      @endif
      
      <div class="row padding-left-30 padding-top-20 padding-bottom-20 barra-pesquisa-banco">                            
        <div class="col-xs-6 col-sm-6 col-lg-6 col-lg-6">
          <input type="search" class="busca-imagens" placeholder="Busque em todas as fotos…" />
        </div>                              
      </div>
      
      <div class="row padding-left-30 padding-right-30">                            
        <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 padding-10 padding-left-20 padding-right-20 barra-selecao">
          <div class="row">                                    
            <div class="col-xs-10 col-sm-10 col-lg-10 col-lg-10">
              <label><input type="checkbox"  class="select-all-banco"/> Selecionar todos</label>
            </div>                                    
            <div class="col-xs-2 col-sm-2 col-lg-2 col-lg-2 text-right">
              <a href="#" class="btn-apagar">Deletar <i class="fas fa-trash-alt" aria-hidden="true"></i></a>
            </div>                                                                        
          </div>
        </div>                            
      </div>
      
      <div class="row margin-top-30 padding-left-30 padding-right-30">                            
        <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 lista-imagens-banco">
          <ul class="lista-imagens">
            @forelse( $imagens as $imagem )
              <li data-code="{{$imagem->titulo}}">
                <div class="actions">
                  <a href="#" class="btn-apagar" data-id="{{$imagem->id}}"><i class="fas fa-trash-alt" aria-hidden="true"></i></a>
                </div>
                <input type="checkbox" class="check-image" value="{{$imagem->id}}"/>
                <div class="imagem-produto"><img src="{{$imagem->imagem}}" alt=""></div>
                <div class="image-code">{{$imagem->titulo}}</div>
              </li>
            @empty
            @endforelse
          </ul>
        </div>
        
      </div>
      
      <div class="row padding-left-30 padding-right-30">                            
        <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 padding-10 padding-left-20 padding-right-20 barra-selecao">
          <div class="row">                                    
            <div class="col-xs-10 col-sm-10 col-lg-10 col-lg-10">
              <label><input type="checkbox" class="select-all-banco"/> Selecionar todos</label>
            </div>                                    
            <div class="col-xs-2 col-sm-2 col-lg-2 col-lg-2 text-right">
              <a href="#" class="btn-apagar">Deletar <i class="fas fa-trash-alt" aria-hidden="true"></i></a>
            </div>                                                                        
          </div>
        </div>                            
      </div>

      
    </div>
  </div>
  
  @endsection
  
  @section('scripts')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/plugins/piexif.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/fileinput.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/locales/pt-BR.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/themes/fas/theme.js"></script>
  <script src="{{assets('sistema/js/dash/vendedor/produtos.js')}}"></script>
  <link rel="stylesheet" href="{{assets('node_modules/sweetalert2/dist/sweetalert2.css')}}">
  <script src="{{assets('node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
  <script>
    jQuery(document).ready(function(){
      var total = jQuery(".porcentagem").data("porcentagem");
      jQuery(".porcentagem").css('width',total+"%");
    });
    $(document).ready(function(){
      $input = $('.galeria');
      $input.fileinput({
        uploadExtraData: function() {
          return {
            _token: $('meta[name=_token]').attr('content'),
            banco: true,
          };
        },
        language: "pt-BR",
        previewFileType: 'image',
        overwriteInitial: false,
        maxFileSize: 5000,
        showClose: false,
        showCaption: true,
        showBrowse: true,
        enableResumableUpload: false,
        browseOnZoneClick: true,
        removeLabel: 'Remover',
        allowedFileTypes: ["image"],
        showUpload: true,
        uploadAsync: true,
        maxFileCount: 0,
        initialPreviewAsData: true,
        overwriteInitial: false,
        maxAjaxThreads: 1,
        theme: "fas",
        uploadUrl: '{{route('sistema.dash.vendedor.imagem.post', $usuario->empresa->id)}}',
      });

      $input.on('filebatchpreupload', function (event, data, previewId, index) {
        $('body').addClass('load');
      });

      $input.on('fileuploaderror', function(event, data, msg) {
        $('body').removeClass('load');
        response = data.response, reader = data.reader;
      });

      $input.on('filebatchuploaderror', function(event, data, msg) {
        $('body').removeClass('load');
      });

      $input.on('filebatchuploadcomplete', function(event, data, previewId, index) {
        window.location.reload();
      });

      $input.on("filebatchselected", function(event, files) {
        //$(this).fileinput("upload"); 
      });
    })
  </script>
  @endsection