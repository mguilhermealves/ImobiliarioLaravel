@extends('backend.layouts.default')
@section('content')
<section class="content-header">
    <h1>
        Administrativo
        <small>Listagem de Imagens do Produto {{$produto->titulo}}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Painel Inicial</a></li>
        <li class="active">Listagem de Imagens do Produto {{$produto->titulo}}</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Confira abaixo todas as <b>Imagens do Produto</b> {{$produto->titulo}}!</h3>
                </div>
                <div class="box-body table-responsive">
                    <div class="box box-primary">
                        <div class="box-header">
                          <h3 class="box-title">Imagens</h3>
                        </div>
                        <div class="box-body">
                          <div class="col-xs-12">
                            <input type="file" class="galeria" name="galeria" multiple />
                          </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</section>
<link rel="stylesheet" href="{{assets('backend/plugins/fileinput/css/fileinput.min.css')}}" media="all"  type="text/css" />
<script src="{{assets('backend/plugins/fileinput/js/fileinput.min.js')}}" type="text/javascript"></script>
<script src="{{assets('backend/plugins/fileinput/js/fileinput_locale_pt-BR.js')}}"></script>
  <script>
    var $token = "{{ csrf_token() }}";
    $(document).ready(function(){
        @php
          $galeria = [];
          foreach( $produto->imagens as $g ){
            $galeria[] = $g;
          }
        @endphp
        @if( is_array( $galeria ) && !empty( $galeria ) )
          @foreach( $galeria as $v )
            var url{{$v->id}} = '{{url('storage/app/public/backend/produtos/') .'/'. $produto->id . '/' .$v->imagem}}';
          @endforeach
        @endif
        var $inputg = jQuery('.galeria');
        $inputg.fileinput({
          uploadExtraData: function() {
            return {
                _token: $token,
                produto:  '{{$produto->id}}'
            };
          },
          @if( is_array($galeria) && !empty( $galeria ) )
            initialPreviewAsData: true,
            initialPreview: [@foreach( $galeria as $v ) url{{$v->id}},@endforeach],
            initialPreviewConfig: [
             @foreach( $galeria as $v )
              @php
                $dir = 'backend/produtos/' . $produto->id . '/';
                $arquivo = $dir . '/' . $v->imagem;
              @endphp
              {
                size: @php echo Storage::size($arquivo) > 0 ? Storage::size($arquivo) : 0; @endphp,
                caption: "", 
                key: {{$v->id}},
                downloadUrl: '{{ url('storage/app/public/backend/produtos/') .'/'. $produto->id . '/' .$v->imagem}}', 
                filename: '{{$v->imagem}}',
                extra: { _token: $token }
              },
              @endforeach
            ],
            @endif
            language: "pt-BR",
            previewFileType: 'image',
            overwriteInitial: false,
            @if( is_array( $galeria ) && !empty( $galeria ) )
              deleteUrl: "{{route('backend.produtos.produto.imagem.apagar', [$produto->id])}}",
            @endif
            maxFileSize: 10000,
            showClose: false,
            showCaption: true,
            showBrowse: true,
            browseOnZoneClick: true,
            removeLabel: 'Remover',
            allowedFileTypes: ["image"],
            allowedFileExtensions: ["png", "jpg", "jpeg", "gif"],
            showUpload: false,
            uploadUrl: "{{route('backend.produtos.produto.imagem', $produto->id)}}",
            uploadAsync: true,
            maxFileCount: 0
        });

        $inputg.on('filebeforedelete', function(jqXHR) {
            var abort = true; if (confirm("Confirma a exclusao desta imagem?")) { abort = false; } return abort;
        });

        $inputg.on("filebatchselected", function(event, files) {
            $(this).fileinput("upload"); 
        });
        
        $inputg.on('filebatchuploadcomplete', function(event, files, extra) {
          window.location.reload();
        });
    })
  </script>

@endsection