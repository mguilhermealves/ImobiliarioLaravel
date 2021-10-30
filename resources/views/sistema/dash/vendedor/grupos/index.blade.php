@extends('sistema.layouts.dash')
@section('content')

<section class="gerenciar-grupos padding-right-10">
  
  <div id="grupo-de-produtos">
    <div class="title-section">
        <h1>Grupo de produtos</h1>
    </div>

    <div class="inside margin-top-15">
        <div class="info text-16-pt">
            Número de grupos: <span><b>{{$grupos->count()}}</b></span> -- Total de Produtos: <span><b>{{$totalProdutos}}</b></span> -- Produtos agrupados: <span><b>{{$totalVinculados}}</b></span> -- Produtos sem grupo: <span><b>{{$totalSemvinculo}}</b></span>
        </div>

        <div class="search">
            <input type="search" class="form-control pesquise" placeholder="Pesquisar Grupos..." />
        </div>

        <div class="groups">
            <div class="top">
                <div class="button">
                  <a class="btn btn-secondary btn-novo" data-titulo="Cadastro de Novo Grupo" data-empresa="{{$usuario->empresa->id}}" data-post="{{route('sistema.dash.vendedor.produtos.grupos.adicionar', $usuario->empresa->id)}}" data-put="{{route('sistema.dash.vendedor.produtos.grupos.salvar', $usuario->empresa->id)}}">Adicionar grupo</a>
                </div>
            </div>

            <table class="table table-hover ">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Exibir no Site <a tabindex="0" class="" data-toggle="popover" data-trigger="hover" title="Exibir no Site" data-content="Aqui você define se o grupo será ou não exibido no menu principal do seu MiniSite">(?)</a></th>
                        <th scope="col">Nome do grupo</th>
                        <th scope="col">Adicionar Subgrupo</th>
                        <th scope="col" class="center">Ações</th>
                        <th scope="col" class="center">Vincular Produtos <a tabindex="0" class="" data-toggle="popover" data-trigger="hover" title="Gerenciar Produtos" data-content="Aqui vai o texto para Vincular Produtos">(?)</a></th>
                        <th scope="col" class="center">Gerenciar destaques <a tabindex="0" class="" data-toggle="popover" data-trigger="hover" title="Gerenciar Destaques" data-content="Aqui vai o texto para Gerenciar Destaques">(?)</a></th>
                    </tr>
                </thead>

                <tbody class="table-striped table-grupos">
                    
                </tbody>
            </table>

            <div class="bottom">
                <div class="button">
                    <a class="btn btn-secondary btn-novo" data-titulo="Cadastro de Novo Grupo" data-post="{{route('sistema.dash.vendedor.produtos.grupos.adicionar', $usuario->empresa->id)}}" data-put="{{route('sistema.dash.vendedor.produtos.grupos.salvar', $usuario->empresa->id)}}">Adicionar grupo</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-spa" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-blue text-24-pt"><b>Novo Grupo</b></h4>
      </div>
      <form action="#" role="form" class="form-spa-grupo" data-post="{{route('sistema.dash.vendedor.produtos.grupos.adicionar', $usuario->empresa->id)}}" data-put="{{route('sistema.dash.vendedor.produtos.grupos.salvar', $usuario->empresa->id)}}">
        <input type="hidden" name="id" value="" class="idobj" id="id">
        <input type="hidden" name="empresagrupo_id" value="" class="idobj" id="empresagrupo_id">
        <input type="hidden" name="empresa_id" class="idobj" id="empresa_id" value="{{$usuario->empresa->id}}">
        <div class="modal-body">
          <div class="col-lg-12 padding-top-20">
            <div class="row">
              <label for="nome" class="text-blue text-14-pt semibold">Nome </label>
              <input type="text" class="form-control margin-top-5" id="nome" placeholder="Nome do grupo..." name="nome" required="">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger vertical-middle" data-dismiss="modal"><i class="fa fa-times padding-right-10"></i> Fechar</button>
          <button type="submit" class="btn btn-success vertical-middle"><i class="fa fa-check padding-right-10"></i> Salvar</button>
        </div>
      </form>
    </div>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade modal-sub" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-blue text-24-pt"><b></b></h4>
      </div>
      <form action="#" role="form" class="form-sub" data-post="" data-put="">
        <input type="hidden" name="id" value="" class="idobj" id="id">
        <input type="hidden" name="empresagrupo_id" value="" class="grupo_id" id="grupo_id">
        <div class="modal-body">
          <div class="col-lg-12">
            <div class="row">
              <label for="nome" class="text-blue text-14-pt semibold">Nome</label>
              <input type="text" class="form-control margin-top-5" id="nome" placeholder="Nome do sub grupo..." name="nome" required="">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger vertical-middle" data-dismiss="modal"><i class="fa fa-times padding-right-10"></i> Fechar</button>
          <button type="submit" class="btn btn-success vertical-middle"><i class="fa fa-check padding-right-10"></i> Salvar</button>
        </div>
        </form>
      </div><!-- /.modal-content -->
    </div>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

  </section>
@endsection
  
@section('scripts')
  <link href="{{assets('backend/bower_components/toastr/toastr.css')}}" rel="stylesheet">
  <script src="{{assets('backend/bower_components/toastr/toastr.js')}}"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
  <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
  <link rel="stylesheet" href="{{assets('node_modules/sweetalert2/dist/sweetalert2.css')}}">
  <script src="{{assets('node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/flat/blue.css">
  <script src="{{assets('backend/plugins/iCheck/icheck.min.js')}}"></script>
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
  <script src="{{assets('sistema/js/dash/vendedor/grupos.js')}}"></script>
  <script>
    var routes = {
      sistema: {
        ajax: {
          getgrupos: "{{route('sistema.dash.vendedor.produtos.grupos.get')}}",
          exibesite: "",
        }
      }
    }
    $(document).ready(function(){
      $(document).on('beforeClose.fb', function( e, instance, slide ) {
        window.location.reload();
      });
    })
  </script>
@endsection