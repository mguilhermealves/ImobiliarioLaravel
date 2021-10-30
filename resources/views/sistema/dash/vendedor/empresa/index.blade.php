@extends('sistema.layouts.dash')
@section('content')
<link rel="stylesheet" href="{{assets('sistema/css/dash/website.css')}}">

<section class="minha-empresa">
  
    <div class="row">     

        <div class="col-12 padding-bottom-50">
            <div class="row padding-left-30 padding-top-20  padding-bottom-20 titulo-fundo-cinza">
                <h2>Informações da empresa</h2>
            </div>

            <div class="row padding-left-30 padding-top-20">                            
                <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 dados-empresa-nome">
                        <h3>{{$empresa->nome}}</h3>
                        <h4>{{$empresa->cnpj}}</h4>
                        <p><img src="{{$usuario->empresa->plano->icone}}" width="30px"> {{$usuario->empresa->plano->nome}}</p>
                </div>                                                      
            </div> 
            <form data-action="{{route('sistema.dash.vendedor.empresa.salvar')}}" class="form-normal">
              <input type="hidden" name="empresa_id" value="{{$empresa->id}}">
            <div class="row padding-left-30 padding-right-30 padding-top-20">                              
                <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 formulario-empresa">
                    <div class="row">        
                      <div class="col-lg-2">
                        <div class="row">
                          <h3>Altere sua logo</h3>  
                        </div>
                        <div class="row margin-top-5">
                          <a href="#p" class="text-10-pt logo-padrao" data-src="{{assets('sistema/images/dash/logo-padrao.png')}}">(Usar logo padrão)</a>
                        </div>
                      </div>                            
                    </div>
                    <div class="row padding-top-20">                                    
                        <div class="col-xs-6 col-sm-6 col-lg-6 col-lg-6 area-imagem">
                            <div class="imagem-empresa">
                                <img class="img-editor imagem fr-fil fr-dib" src="{{ $empresa->logo ?? assets('sistema/images/dash/logo-padrao.png')}}" alt="Imagem"/>
                                <input type="hidden" name="logo" value="{{$empresa->logo ?? assets('sistema/images/dash/logo-padrao.png')}}" class="url-imagem" id="logo">
                            </div>
                                <p>Insira um arquivo nos formatos<br/>PNG, JPG ou GIF…</p>
                        </div>                                                                        
                    </div>

                    <div class="row padding-top-30">                                    
                        <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12">
                            <h3>Informações da empresa</h3>
                        </div>                                                                        
                    </div>

                    <div class="row padding-top-30">                                    
                        <div class="col-xs-4 col-sm-4 col-lg-4 col-lg-4 padding-right-10">
                            <label>Nome da empresa <span class="text-red">*</span></label>
                            <input type="text" value="{{$empresa->nome}}" name="nome" placeholder="" />
                        </div>
                        <div class="col-lg-2 padding-right-10">
                          <label class="">CNPJ  <span class="text-red">*</span></label>
                          <input type="text" class="cnpj-input-mask" placeholder="" name="cnpj" value="{{$empresa->cnpj}}" />
                        </div> 
                        <div class="col-lg-2 padding-right-10">
                                <label>Telefone</label>
                                <input type="tel" class="telefone-input-mask" name="telefone" placeholder="" value="{{$empresa->telefone}}" />
                        </div>
                        <div class="col-lg-4">
                                <label>E-mail</label>
                                <input type="email" name="email" placeholder="" value="{{$empresa->email}}" />
                        </div>                                    
                    </div>

                    <div class="row padding-top-30">                                        
                        <div class="col-xs-2 col-sm-2 col-lg-2 col-lg-2 padding-right-10">
                            <label class="">Ano de fundação</label>
                            <input type="text" class="ano-input-mask" placeholder="" name="fundacao" value="{{$empresa->fundacao}}" />
                        </div> 
                        <div class="col-xs-3 col-sm-3 col-lg-3 col-lg-3 padding-right-10">
                            <label>Website</label>
                            <input type="text" placeholder="" name="site" value="{{$empresa->site}}" />
                        </div> 
                    </div>
                    <div class="row padding-top-30 endereco">
                      <div class="col-lg-2 padding-right-10">
                        <label>CEP: <span class="text-red">*</span></label>
                        <input type="text" class="form-control cep-input-mask cep" name="cep" autocomplete="new-password" class="form-control" value="{{$empresa->cep}}">
                      </div>
                      <div class="col-lg-8 padding-right-10">
                        <label>Logradouro: <span class="text-red">*</span></label>
                        <input type="text" class="form-control  logradouro" name="logradouro" value="{{$empresa->logradouro}}">
                      </div>
                      <div class="col-lg-2">
                        <label>Número: <span class="text-red">*</span></label>
                        <input type="text" class="form-control numero" name="numero" value="{{$empresa->numero}}">
                      </div>
                      <div class="col-lg-3 padding-top-30 padding-right-10">
                        <label>Complemento:</label>
                        <input type="text" class="form-control complemento" name="complemento" value="{{$empresa->complemento}}">
                      </div>
                      <div class="col-lg-4 padding-top-30 padding-right-10">
                        <label>Bairro: <span class="text-red">*</span></label>
                        <input type="text" class="form-control  bairro" name="bairro" value="{{$empresa->bairro}}">
                      </div>
                      <div class="col-lg-4 padding-top-30 padding-right-10">
                        <label>Cidade: <span class="text-red">*</span></label>
                        <input type="text" class="form-control  localidade" name="cidade" value="{{$empresa->cidade}}">
                      </div>
                      <div class="col-sm-1 padding-top-30">
                        <label>UF: <span class="text-red">*</span></label>
                        @include('sistema/parts/uf', ['item' => $empresa])
                      </div>
                    </div>
                    <div class="row padding-top-30">                                     
                        <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 checkboxes">
                            <label>Tipo de empresa</label>
                            <p><input type="checkbox" {{$empresa->tipo == 1 ? 'checked' : ''}} name="tipo" value="1"> Fabricante</p>
                            <p><input type="checkbox" {{$empresa->tipo == 2 ? 'checked' : ''}} name="tipo" value="2"> Importador</p>
                            <p><input type="checkbox" {{$empresa->tipo == 3 ? 'checked' : ''}} name="tipo" value="3"> Distribuidor</p>
                        </div>                                    
                    </div>
                    <div class="row padding-top-30">                                     
                      <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 produtos-empresa">
                        <label>Produtos principais:</label>
                      </div>                                    
                      <div class="col-12">
                        <div class="row">
                          <div class="col-lg-3 padding-5">
                            <input type="text" class="form-control" value="{{$empresa->produto1}}" placeholder="Produto 1" name="produto1">
                          </div>
                          <div class="col-lg-3 padding-5">
                            <input type="text" class="form-control" value="{{$empresa->produto2}}" placeholder="Produto 2" name="produto2">
                          </div>
                          <div class="col-lg-3 padding-5">
                            <input type="text" class="form-control" value="{{$empresa->produto3}}" placeholder="Produto 3" name="produto3">
                          </div>
                          <div class="col-lg-3 padding-5">
                            <input type="text" class="form-control" value="{{$empresa->produto4}}" placeholder="Produto 4" name="produto4">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row padding-top-30">                                     
                        <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 produtos-empresa">
                            <label>Sobre a empresa:</label>
                            <textarea class="form-control editor-min" name="sobre" id="sobre">{!! $empresa->sobre !!}</textarea>
                        </div>                                    
                    </div>
                    <div class="row padding-top-30">                                     
                        <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 produtos-empresa">
                            <label>Certificados da Empresa (máximo 4):</label>
                            <input type="file" class="galeria" name="galeria" multiple />
                        </div>                                    
                    </div>
                    <div class="row padding-top-30">                                    
                        <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12">
                            <button type="submit" class="salvar">Salvar alterações</button>
                        </div>                                    
                    </div>
                </div>                                
            </div>
          </form>
        </div>
    </div>
  
</section>

@endsection

@section('scripts')
  <script type="text/javascript" src="{{assets('backend/plugins/froala/js/froala_editor.pkgd.min.js')}}"></script>
  <script type="text/javascript" src="{{assets('backend/plugins/froala/js/languages/pt_br.js')}}"></script>
  <link href="{{assets('backend/plugins/froala/css/froala_editor.pkgd.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{assets('backend/plugins/froala/css/froala_style.min.css')}}" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="{{assets('node_modules/sweetalert2/dist/sweetalert2.css')}}">
  <script src="{{assets('node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
  <script src="{{assets('plugins/js/mask.js')}}"></script>
  <script src="{{assets('plugins/js/masks.js')}}"></script>
  <script src="{{assets('sistema/js/dash/vendedor/endereco.js')}}"></script>
  <script src="{{assets('sistema/js/dash/vendedor/empresa.js')}}"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/plugins/piexif.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/fileinput.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/locales/pt-BR.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.8/themes/fa/theme.min.js"></script>
  <script>
    var $token = "{{ csrf_token() }}";
    $(document).ready(function(){
        @php
          $galeria = [];
          foreach( $empresa->certificados as $g ){
            $galeria[] = $g;
          }
        @endphp
        @if( is_array( $galeria ) && !empty( $galeria ) )
          @foreach( $galeria as $v )
            var url{{$v->id}} = '{{$v->certificado}}';
          @endforeach
        @endif
        var $inputg = jQuery('.galeria');
        $inputg.fileinput({
          uploadExtraData: function() {
            return {
                _token: $token,
            };
          },
          @if( is_array($galeria) && !empty( $galeria ) )
            initialPreviewAsData: true,
            initialPreview: [@foreach( $galeria as $v ) url{{$v->id}},@endforeach],
            initialPreviewConfig: [
             @foreach( $galeria as $v )
              {
                size: '{{$v->tamanho}}',
                caption: "{{$v->nome}}", 
                key: {{$v->id}},
                downloadUrl: '{{$v->certificado}}', 
                filename: '{{$v->nome}}',
                extra: { _token: $token }
              },
              @endforeach
            ],
            @endif
            language: "pt-BR",
            theme: "fa",
            previewFileType: 'image',
            overwriteInitial: false,
            @if( is_array( $galeria ) && !empty( $galeria ) )
              deleteUrl: "{{route('sistema.dash.vendedor.empresa.certificados.apagar', [$empresa->id])}}",
            @endif
            maxFileSize: 5000,
            showClose: false,
            showCaption: true,
            showBrowse: true,
            browseOnZoneClick: true,
            removeLabel: 'Remover',
            allowedFileTypes: ["image"],
            allowedFileExtensions: ["png", "jpg", "jpeg", "gif"],
            showUpload: false,
            uploadUrl: "{{route('sistema.dash.vendedor.empresa.certificados.adicionar', $empresa->id)}}",
            uploadAsync: true,
            maxFileCount: 4,
            validateInitialCount: true,
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