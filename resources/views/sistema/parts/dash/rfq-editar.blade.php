
<div class="row detalhes-produto-cotacao  padding-left-20 padding-top-30">

    <link href="{{ assets('sistema/css/rfq/rfq.css') }}" rel="stylesheet" />
<section class="rfq-global">
  <div class="container-fluid limit padding-30 margin-bottom-50">
    <div class="row horizontal-center">
      <h3 class="text-navy text-20-pt semibold">Editar cotação pública</h3>
    </div>
 
    <div class="row margin-top-40 flex-column">
      <form class="form-normal formulario" data-action="{{route('sistema.dash.comprador.salvarrfq')}}">
        <div class="row">
            <input type="hidden" value="{{$item->id}}" name="id" />
          <div class="form-group col-lg-7 padding-right-10">
            <label for="produto" class="tajawal text-black text-20-pt bold">
              Produto
            </label>
            <input type="text" value="@if( $item->termo ) {{$item->termo}} @endif" class="form-control" name="termo" id="produto" placeholder="Ex: Celular..." />
          </div>
          <div class="form-group col-lg-5 padding-left-10">
            <div class="row">
              <div class="form-group col-lg-6 padding-right-10">
                <label for="quantidade" class="tajawal text-black text-20-pt bold">Quantidade <span class="text-red">*</span></label>
                <input type="text" value="@if( $item->quantidade ) {{$item->quantidade}} @endif" class="form-control" name="quantidade" id="quantidade" placeholder="Digite aqui..." />
              </div>  
              <div class="form-group col-lg-6 padding-left-10">
                <label for="unidade" class="tajawal text-black text-20-pt bold">Unidade <span class="text-red">*</span></label>
                {{Form::select('unidade_id', [null => 'Selecione'] + $unidades, $item->unidade->id != null ? $item->unidade->id : null, ['class' => 'form-control'])}}
              </div>            
            </div>
          </div>
        </div>

        <div class="row margin-top-20">
          <div class="form-group col-lg-4 padding-right-10">
            <label for="categoria" class="tajawal text-black text-20-pt bold">Categoria <span class="text-red">*</span></label>
            <div class="row">
              <div class="col-lg-12">
                {{Form::select('categoria_id', [null => 'Selecione'] + $categorias, $item->categoria->id, ['class' => 'custom-select select2  categorias categoria_id', 'data-url' => route('sistema.dash.vendedor.produtos.get-sub')])}}
              </div>
            </div>
          </div>
          
          <div class="form-group col-lg-4 padding-right-10 padding-left-10">
            <label for="subcategoria" class="tajawal text-black text-20-pt bold">Subcategoria <span class="text-red">*</span></label>
            <div class="subs">
              {!! Form::select('subcategoria_id', [null => 'Selecione'] + $subs, $item->subcategoria->id, ['class' => 'custom-select select2 subcategoria_id', 'data-url' => route('sistema.dash.vendedor.produtos.get-grupo')]) !!}
            </div>  
          </div>
          <div class="form-group col-lg-4 padding-left-10">
            <label for="grupo" class="tajawal text-black text-20-pt bold">Grupo</label>
            <div class="grupos">
              {!! Form::select('grupo_id', [null => 'Selecione'] + $grupos, $item->grupo != null ? $item->grupo->id : null, ['class' => 'custom-select select2 grupo_id', 'data-url' => route('sistema.dash.vendedor.produtos.get-grupo') ]) !!}
            </div>  
          </div>
        </div>
        
        <div class="row margin-top-20 flex-column">
          <div class="form-group">
            <label for="informacoes" class="tajawal text-black text-20-pt bold">
              Informações do produto
            </label>
            <textarea class="form-control" id="informacoes" placeholder="Digite aqui..." name="informacoes">@if( $item->informacoes ) {{$item->informacoes}} @endif</textarea>
          </div>
        </div>
        <div class="row margin-top-20 flex-column">
          <div class="form-group">
            <label for="informacoes" class="tajawal text-black text-20-pt bold">
              Especificações do produto
            </label>
            
            <div class="uploads row">
              @for($i = 1; $i < 6; $i++)
              <div class="col-lg-2 padding-5">
                <div class="image">
                  <figure> 
                    @if($i == 1)                                                                                                 
                    <img class="img-editor imagem fr-fil fr-dib" src="{{ $item->imagem1 ?? assets('backend/images/sem-imagem.png')}}" alt="Imagem"/>
                    <input type="hidden" name="imagem{{$i}}" value="{{ $item->imagem1 ?? '' }}" class="url-imagem" id="imagem_{{$i}}">
                    @elseif($i == 2)
                    <img class="img-editor imagem fr-fil fr-dib" src="{{ $item->imagem2 ?? assets('backend/images/sem-imagem.png')}}" alt="Imagem"/>
                    <input type="hidden" name="imagem{{$i}}" value="{{ $item->imagem2 ?? '' }}" class="url-imagem" id="imagem_{{$i}}">
                    @elseif($i == 3)
                    <img class="img-editor imagem fr-fil fr-dib" src="{{ $item->imagem3 ?? assets('backend/images/sem-imagem.png')}}" alt="Imagem"/>
                    <input type="hidden" name="imagem{{$i}}" value="{{ $item->imagem3 ?? '' }}" class="url-imagem" id="imagem_{{$i}}">
                    @elseif($i == 4)
                    <img class="img-editor imagem fr-fil fr-dib" src="{{ $item->imagem4 ?? assets('backend/images/sem-imagem.png')}}" alt="Imagem"/>
                    <input type="hidden" name="imagem{{$i}}" value="{{ $item->imagem4 ?? '' }}" class="url-imagem" id="imagem_{{$i}}">
                    @else
                    <img class="img-editor imagem fr-fil fr-dib" src="{{ $item->imagem5 ?? assets('backend/images/sem-imagem.png')}}" alt="Imagem"/>
                    <input type="hidden" name="imagem{{$i}}" value="{{ $item->imagem5 ?? '' }}" class="url-imagem" id="imagem_{{$i}}">
                    @endif
                  </figure> 
                  <div class="upload horizontal-center">
                    <label class="tajawal text-black text-20-pt bold">                                                                                              
                      <div class="legend">Imagem {{$i}}</div>                                  
                    </label>
                  </div>  
                </div>
              </div>
              @endfor
            </div>
          </div>
        </div>
        <div class="row margin-top-30 horizontal-center">
          <div class="button">
            <button type="submit" class="roboto text-white text-18-pt bold toupper button-yellow">editar cotação</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>



<script> 
  var routes = {
    sistema: {
      dash: {
        ajax: {
          upload: '{{route('sistema.rfq.anexar', $usuario->empresa)}}',
          delete: '{{route('sistema.dash.vendedor.produtos.banco.apagar')}}',
          load: '{{route('sistema.dash.vendedor.imagem.get')}}',
        }
      }
    }
  }
</script>
<link rel="stylesheet" href="{{assets('backend/bower_components/select2/dist/css/select2.min.css')}}">
<script src="{{assets('backend/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script type="text/javascript" src="{{assets('backend/plugins/froala/js/froala_editor.pkgd.min.js')}}"></script>
<script type="text/javascript" src="{{assets('backend/plugins/froala/js/languages/pt_br.js')}}"></script>
<link href="{{assets('backend/plugins/froala/css/froala_editor.pkgd.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{assets('backend/plugins/froala/css/froala_style.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{assets('node_modules/sweetalert2/dist/sweetalert2.css')}}">
<script src="{{assets('node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
<script src="{{assets('sistema/js/app.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('body').find('.select2').each(function(){
      makeSelect2($(this));
    })
    $('.categoria_id').on('change', function(){
      getDataDados($(this), 'subcategoria_id', '.subs');
      $('.grupos').find('.select2').val(null).trigger('change');
    })
  
    $('body').on('change', '.subcategoria_id', function(){
      getDataDados($(this), 'grupo_id', '.grupos');
    })
  });
</script>

    
</div>
  

 
