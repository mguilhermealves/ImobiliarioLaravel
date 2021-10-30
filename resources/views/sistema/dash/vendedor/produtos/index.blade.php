@extends('sistema.layouts.dash')
@section('content')
<link rel="stylesheet" href="{{assets('sistema/css/painel/perfil.css')}}">

<section class="meus-produtos">

  <div class="row">     
              
    <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 padding-bottom-50">
      <div class="row padding-left-30 padding-top-20  padding-bottom-20 titulo-fundo-cinza">
        <h2>Todos os produtos</h2>
      </div>
      <div class="row margin-top-30 horizontal-right padding-right-30">
        @if( $add )
          <a href="{{route('sistema.dash.vendedor.produtos.novo')}}" class="btn btn-primary vertical-middle"><i class="fa fa-plus padding-right-10"></i> Novo Produto</a>
        @else
          <a href="" class="btn btn-primary vertical-middle"><i class="fa fa-plus padding-right-10"></i> Limite de produtos atingido!</a>
        @endif
      </div>
      <div class="row table-responsive padding-10">
        <table class="produtos-table table normal table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Produto</th>
                    <th>Preço</th>
                    <th>Categoria</th>
                    <th>Subcategoria</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
              @foreach($produtos as $produto)
                <tr>
                  <td>{!! $produto->statusTag !!}</td>
                  <td><img src="{{optional($produto->imagemPrincipal())->imagem}}" alt="" class="padding-right-10">{{$produto->nome}}</td>
                  <td>{{$produto->precoFront}}</td>
                  <td>{{optional($produto->categoria)->nome}}</td>
                  <td>{{optional($produto->subcategoria)->nome}}</td>
                  <td>
                    <a href="{{route('sistema.dash.vendedor.produto.editar', $produto->slug)}}" data-toggle="tooltip" class="btn btn-primary btn-sm" title="Editar produto"><i class="fas fa-pen-square"></i></a>
                    <button class="btn btn-danger btn-apagar btn-sm" data-url="{{route('sistema.dash.vendedor.produto.apagar',$produto->id)}}" data-toggle="tooltip" title="Excluir produto"><i class="fa fa-trash"></i></button>
                    <button class="btn btn-info btn-clonar btn-sm" data-url="{{route('sistema.dash.vendedor.produto.duplicar',$produto->id)}}" data-toggle="tooltip" title="Duplicar produto"><i class="fa fa-copy"></i></button>
                  </td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Status</th>
                    <th>Produto</th>
                    <th>Preço</th>
                    <th>Categoria</th>
                    <th>Subcategoria</th>
                    <th>Ações</th>
                </tr>
            </tfoot>
        </table>
      </div>
      
    </div>
  </div>
</section>

@endsection
@section('scripts')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/sl-1.3.1/datatables.min.css"/>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/sl-1.3.1/datatables.min.js"></script>
  <link rel="stylesheet" href="{{assets('node_modules/sweetalert2/dist/sweetalert2.css')}}">
  <script src="{{assets('node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
  <script>
    $(document).ready(function(){
      $tabela = $('.table.normal').DataTable({
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.18/i18n/Portuguese-Brasil.json",
          "decimal": ",",
          "thousands": "."
        },
        'paging': true,
        "pageLength": 100,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
        dom: 'lBfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf',
            {
              extend: 'print',
              text: 'Imprimir',
            },
            {
              extend: 'selectAll',
              text: 'Selecionar Todas',
            },
            {
              extend: 'selectNone',
              text: 'Deselecionar Todas',
            },
            {
              text: 'Excluir Selecionados',
            },
          ],
        select: {
          style: 'multi',
          blurable: false,
          selector: 'td:first-child'
        },
      });

      $.fn.dataTableExt.ofnSearch['dom-select'] = function(value) {
        return $(value).find('option:selected').text();
      };
      
      $.fn.dataTable.ext.order['dom-select'] = function  ( settings, col )
      {
          return this.api().column( col, {order:'index'} ).nodes().map( function ( td, i ) {
              return $('select option:selected', td).text();
          } );
      }
    });
  </script>
@endsection