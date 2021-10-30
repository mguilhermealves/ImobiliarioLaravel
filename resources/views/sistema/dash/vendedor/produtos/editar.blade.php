@extends('sistema.layouts.dash')
@section('content')
<link rel="stylesheet" href="{{assets('sistema/css/painel/perfil.css')}}">

<section class="novo-produto">

  <main class="cadastro-produto -produto padding-bottom-90">
    <!-- GRID PANEL -->
    <div class="container-fluid padding-10">
        <div class="box-header padding-top-15 padding-bottom-25 margin-bottom-30">
            <div class="d-flex align-items-center justify-content-between">
                <h1 class="page-title">Edição do produto - {{$produto->nome}}</h1>

                <a href="{{route('sistema.dash.vendedor.produtos')}}">Ir para meus produtos</a>
            </div>
        </div>
        
        <form class="form-normal" data-action="{{route('sistema.dash.vendedor.produto.salvar', $produto->slug)}}">
            <div class="box-content">
                <div class="box-content-header">
                    <h2 class="title">Informações do produto</h2>
                </div>

                <div class="box-content-body">
                    <div class="row">
                        <div class="form-group col-lg-9">
                          <input type="hidden" value="{{$usuario->empresa->id}}" name="empresa_id">
                            <div class="row vertical-middle">
                                <label for="nome" class="col-lg-4 label mandatory">Nome do produto</label>

                                <div class="col-lg-8">
                                    <input type="text" class="form-control" value="{{$produto->nome}}" name="nome" id="nome" placeholder="5.0 Polegada 3G Smartphone">
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-lg-3">
                            <div class="row">
                                <label for="modelo" class="col-lg-5 label">Modelo</label>

                                <div class="col-lg-7">
                                    <input type="text" class="form-control" value="{{$produto->modelo}}" name="modelo" id="modelo" placeholder="30450">
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-lg-12 box-add-field">
                            <div class="row">
                                <label for="palavra_chave" class="col-lg-3 label mandatory">Palavras-chave (keywords)</label>

                                <div class="col-lg-9">
                                    <div class="inputs">
                                        <div class="field">
                                            <input type="text" class="form-control" value="{{$produto->keywords}}" name="keywords" id="keywords" placeholder="asdasdasd" />
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="form-group col-lg-12">
                            <div class="row">
                                <label for="categoria" class="col-lg-3 label mandatory">Categoria do produto</label>

                                <div class="col-lg-9">
                                    {!! Form::select('categoria_id', $categorias, $produto->categoria_id, ['class' => 'custom-select select2 categoria_id', 'data-url' => route('sistema.dash.vendedor.produtos.get-sub') ]) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-lg-12">
                            <div class="row">
                                <label for="subctegoria" class="col-lg-3 label mandatory">Subcategoria do produto</label>

                                <div class="col-lg-9 subs">
                                    {!! Form::select('subcategoria_id', $subs, $produto->subcategoria_id, ['class' => 'custom-select  subcategoria_id', 'data-url' => route('sistema.dash.vendedor.produtos.get-grupo') ]) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-lg-12">
                            <div class="row">
                                <label for="grupo" class="col-lg-3 label">Grupo do produto</label>

                                <div class="col-lg-9 grupos">
                                    {!! Form::select('grupo_id', $grupos, $produto->grupo_id, ['class' => 'custom-select  grupo_id','data-url' => route('sistema.dash.vendedor.produtos.get-grupo')  ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 margin-bottom-30">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h2>Informações de cotação</h2>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-lg-12">
                            <div class="row">
                                <label for="valor_minimo" class="col-lg-3 label mandatory">Valor por peça</label>

                                <div class="col-lg-2">
                                    <input type="text" class="form-control dinheiro-input-mask" name="valor_minimo" id="valor_minimo" value="{{currencyToAppOnlyNumbersFront($produto->valor_minimo)}}" placeholder="Valor mínimo">
                                </div>

                                <div class="col-lg-2">
                                    <input type="text" class="form-control dinheiro-input-mask" name="valor_maximo"  value="{{currencyToAppOnlyNumbersFront($produto->valor_maximo)}}" id="valor_maximo" placeholder="Valor Máximo">
                                </div>
                                <div class="col-2">
                                  <div class="row horizontal-center margin-top-15">
                                    <span><b>OU</b></span>
                                  </div>
                                </div>

                                <div class="col-lg-3">
                                    <input type="text" class="form-control dinheiro-input-mask"  value="{{currencyToAppOnlyNumbersFront($produto->valor_unico)}}" name="valor_unico" id="valor_unico" placeholder="Valor Único">
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-lg-6">
                            <div class="row">
                                <label for="unidade" class="col-lg-6 label mandatory">Unidade</label>

                                <div class="col-lg-6">
                                    {!! Form::select('unidade_id', $unidades, $produto->unidade_id, ['class' => 'custom-select select2 unidade_id' ]) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-lg-6">
                            <div class="row">
                                <label for="qtde_minima" class="col-lg-6 label mandatory">Quantidade mínima</label>

                                <div class="col-lg-6">
                                    <input type="text" class="form-control"  value="{{$produto->quantidade_minima}}" name="quantidade_minima" id="qtde_minima" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-lg-9">
                            <div class="row">
                                <label for="pagamento" class="col-lg-4 label mandatory">Pagamento</label>

                                <div class="col-lg-8">
                                    {!! Form::select('pagamento', [0 => 'À Vista', 1 => 'À prazo'], $produto->pagamento, ['class' => 'custom-select']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-lg-3">
                            <div class="row">
                                <label for="frete" class="col-lg-5 label mandatory">Frete</label>

                                <div class="col-lg-7">
                                    {!! Form::select('frete', [0 => 'CIF', 1 => 'FOB'], $produto->frete, ['class' => 'custom-select']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-content margin-top-60">
              <div class="box-content-header">
                  <h2 class="title">Informações adicionais</h2>
              </div>

              <div class="box-content-body">
                  <div class="row">
                    <div class="form-group col-lg-8">
                      <div class="row vertical-middle">
                          <label for="nome" class="col-lg-4 label">Marca</label>
                          <div class="col-lg-8">
                              <input type="text" class="form-control" name="marca" id="marca" value="{{$produto->marca}}" placeholder="">
                          </div>
                      </div>
                  </div>
                      <div class="form-group col-lg-8">
                          <div class="row vertical-middle">
                              <label for="nome" class="col-lg-4 label">Tipo de Material</label>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" value="{{$produto->tipo_material}}" name="tipo_material" id="tipo_material" placeholder="">
                              </div>
                          </div>
                      </div>
                      <div class="form-group col-lg-4">
                          <div class="row">
                              <label for="modelo" class="col-lg-5 label">Amostra</label>
                              <div class="col-lg-7">
                                <div class="row margin-top-15">
                                  <div class="col-6">
                                    <div class="row">
                                        <input type="radio" id="amostra_1" name="amostra" {{$produto->amostra == 1 ? 'checked' : ''}} class="" value="1">
                                        <label for="amostra_1" class="padding-left-10">Sim</label>
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="row">
                                        <input type="radio" id="amostra_0" name="amostra" {{$produto->amostra == 0 ? 'checked' : ''}}  class="" value="0">
                                        <label for="amostra_0" class="padding-left-10">Não</label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </div>
                      </div>
                      <div class="form-group col-lg-8">
                          <div class="row vertical-middle">
                              <label for="nome" class="col-lg-4 label">Prazo de entrega estimado</label>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" value="{{$produto->prazo_entrega}}" name="prazo_entrega" id="prazo_entrega" placeholder="">
                              </div>
                          </div>
                      </div>
                      <div class="form-group col-lg-4">
                          <div class="row">
                              <label for="modelo" class="col-lg-5 label">Reciclável</label>
                              <div class="col-lg-7">
                                <div class="row margin-top-15">
                                  <div class="col-6">
                                    <div class="row">
                                        <input type="radio" id="reciclavel_1" name="reciclavel" {{$produto->reciclavel == 1 ? 'checked' : ''}} class="" value="1">
                                        <label for="reciclavel_1" class="padding-left-10">Sim</label>
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="row">
                                        <input type="radio" id="reciclavel_0" name="reciclavel" {{$produto->reciclavel == 0 ? 'checked' : ''}} class="" value="0">
                                        <label for="reciclavel_0" class="padding-left-10">Não</label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </div>
                      </div>
                      <div class="form-group col-lg-8">
                          <div class="row">
                              <label for="modelo" class="col-lg-5 label">Origem</label>
                              <div class="col-lg-7">
                                <div class="row margin-top-15">
                                  <div class="col-6">
                                    <div class="row">
                                        <input type="radio" id="origem_0" name="origem" {{$produto->origem == 0 ? 'checked' : ''}} class="" value="0">
                                        <label for="origem_0" class="padding-left-10">Nacional</label>
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="row">
                                        <input type="radio" id="origem_1" name="origem" {{$produto->origem == 1 ? 'checked' : ''}} class="" value="1">
                                        <label for="origem_1" class="padding-left-10">Importado</label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </div>
                      </div>
                      <div class="form-group col-lg-8">
                          <div class="row vertical-middle">
                              <label for="nome" class="col-lg-4 label">Cidade de Origem</label>
                              <div class="col-lg-8">
                                  <input type="text" class="form-control" value="{{$produto->cidade_origem}}" name="cidade_origem" id="cidade_origem" placeholder="">
                              </div>
                          </div>
                      </div>
                      <div class="form-group col-lg-4">
                          <div class="row">
                              <label for="modelo" class="col-lg-5 label">OEM</label>
                              <div class="col-lg-7">
                                <div class="row margin-top-15">
                                  <div class="col-6">
                                    <div class="row">
                                        <input type="radio" id="oem_1" name="oem" {{$produto->oem == 1 ? 'checked' : ''}} class="" value="1">
                                        <label for="oem_1" class="padding-left-10">Sim</label>
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="row">
                                        <input type="radio" id="oem_0" name="oem" {{$produto->oem == 0 ? 'checked' : ''}} class="" value="0">
                                        <label for="oem_0" class="padding-left-10">Não</label>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>

            <div class="box-content margin-top-60">
              <div class="box-content-header">
                  <h2 class="title">Informações de logística</h2>
              </div>

              <div class="box-content-body">
                  <div class="row">
                      <div class="form-group col-lg-6">
                          <div class="row vertical-middle">
                              <label for="nome" class="col-lg-6 label">Dimensão do produto</label>
                              <div class="col-lg-6">
                                  <input type="text" class="form-control" value="{{$produto->dimensao_produto}}" name="dimensao_produto" id="dimensao_produto" placeholder="">
                              </div>
                          </div>
                      </div>
                      <div class="form-group col-lg-6">
                          <div class="row vertical-middle">
                              <label for="nome" class="col-lg-6 label">Dimensão da caixa master</label>
                              <div class="col-lg-6">
                                  <input type="text" class="form-control" value="{{$produto->dimensao_master}}" name="dimensao_master" id="dimensao_master" placeholder="">
                              </div>
                          </div>
                      </div>
                      <div class="form-group col-lg-6">
                          <div class="row vertical-middle">
                              <label for="nome" class="col-lg-6 label">Peso do produto</label>
                              <div class="col-lg-6">
                                  <input type="text" class="form-control" value="{{$produto->peso_produto}}" name="peso_produto" id="peso_produto" placeholder="">
                              </div>
                          </div>
                      </div>
                      <div class="form-group col-lg-6">
                          <div class="row vertical-middle">
                              <label for="nome" class="col-lg-6 label">Peso da caixa master</label>
                              <div class="col-lg-6">
                                  <input type="text" class="form-control" value="{{$produto->peso_master}}" name="peso_master" id="peso_master" placeholder="">
                              </div>
                          </div>
                      </div>
                      <div class="form-group col-lg-6">
                          <div class="row vertical-middle">
                              <label for="nome" class="col-lg-6 label">Quantidade caixa master</label>
                              <div class="col-lg-6">
                                  <input type="text" class="form-control" value="{{$produto->quantidade_master}}" name="quantidade_master" id="quantidade_master" placeholder="">
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>

            <div class="box-content margin-top-60">
                <div class="box-content-header">
                    <h2 class="title">Fotos do produto</h2>
                </div>

                <div class="box-content-body">
                    <div class="row">
                        <div class="col-lg-12 margin-bottom-30">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h2>Fotos do produto ( máximo de 5MB por imagem )</h2>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-lg-12">
                            <label class="margin-bottom-10 mt-0 label">Selecione as fotos</label>

                            <div class="row lista-imagens">
                                <div class="col-lg-2 relative imagem">
                                  <img class="img-editor imagem fr-fil fr-dib" src="{{optional($produto->imagemPrincipal())->imagem ?? assets('backend/images/sem-imagem.png')}}" alt="Imagem"/>
                                  <input type="hidden" name="principal" value="{{optional($produto->imagemPrincipal())->imagem}}" class="url-imagem" id="principal">
                                  <span class="featured">Principal *</span>
                                </div>
                                @foreach( range(1,5) as $x )
                                  <div class="col-lg-2 relative imagem">
                                    <img class="img-editor imagem fr-fil fr-dib" src="{{ $produto->outrasImagens()[$x-1]->imagem ?? assets('backend/images/sem-imagem.png')}}" alt="Imagem"/>
                                    <input type="hidden" name="imagem_{{$x}}" value="{{ $produto->outrasImagens()[$x-1]->imagem ?? '' }}" class="url-imagem" id="imagem_1">
                                  </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-content margin-top-60">
              <div class="box-content-header">
                  <h2 class="title">Descrição do produto</h2>
              </div>

              <div class="box-content-body">
                  <div class="row">
                    <div class="form-group col-lg-12">
                      <div class="row">
                          <div class="col-lg-12 margin-top-10">
                            <div>
                              <textarea class="form-control editor" name="descricao" id="descricao">{!! $produto->descricao !!}</textarea>
                            </div>
                          </div>
                      </div>
                  </div>
                  </div>
              </div>
          </div>
          <div class="row margin-top-20">
            <div class="col-lg-6">
              <a href="{{route('sistema.dash.vendedor.produtos')}}" class="btn btn-danger text-18-pt">
                <i class="fas fa-arrow-left margin-top-5"></i>
                Cancelar alterações
              </a>
            </div>
            <div class="col-lg-6">
              <button class="btn btn-success text-24-pt bold " type="submit">
                <i class="fas fa-save margin-top-5"></i>
                Alterar produto
              </button>
            </div>
          </div>
        </form>
    </div>
    <!-- GRID PANEL -->
</main>
</section>
@endsection
@section('scripts')
  <link href="{{assets('sistema/css/dash/tags.css')}}" rel="stylesheet">
  <script src="{{assets('sistema/js/dash/vendedor/produtos.js')}}"></script>
  <script src="{{assets('sistema/js/dash/tags.js')}}"></script>
  <script src="{{assets('backend/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
  <script type="text/javascript" src="{{assets('backend/plugins/froala/js/froala_editor.pkgd.min.js')}}"></script>
  <script type="text/javascript" src="{{assets('backend/plugins/froala/js/languages/pt_br.js')}}"></script>
  <script src="{{assets('plugins/js/mask.js')}}"></script>
  <script src="{{assets('plugins/js/masks.js')}}"></script>
  <link href="{{assets('backend/plugins/froala/css/froala_editor.pkgd.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{assets('backend/plugins/froala/css/froala_style.min.css')}}" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="{{assets('node_modules/sweetalert2/dist/sweetalert2.css')}}">
  <script src="{{assets('node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
@endsection