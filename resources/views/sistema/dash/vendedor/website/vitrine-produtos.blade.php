@extends('sistema.layouts.vazio')
@section('content')
  <section class="vinculados padding-10">
    <div class="container-fluid">
      <div class="row padding-20">
        <h3 class="text-navy text-28-pt semibold">Selecionar produtos para a Vitrine</h3>
      </div>
      <div class="row">
        <ul class="nav nav-tabs text-gray text-18-pt bold" id="detalhes" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="vinculados" data-toggle="tab" href="#detalhes_vinculados" role="tab" aria-controls="vinculados" aria-selected="true">Selecionar Produtos</a>
          </li>
        </ul>
      </div>
      <div class="row flex-column tabs">
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active padding-50" id="detalhes_vinculados" role="tabpanel" aria-labelledby="vinculados-tab">
            <form data-action="{{route('sistema.dash.vendedor.vitrine.produtos.adicionar', $usuario->empresa->id)}}" class="form-normal">
              <div class="row vertical-middle">
                <div class="col-lg-6">
                  <input type="search" class="form-control pesquisar" placeholder="Pesquisar...">
                </div>
                <div class="col-lg-6 padding-left-20">
                  <div class="row vertical-middle">
                    <input type="checkbox" class="form-control todos" value="1" name="todos" id="todos">
                    <label for="todos" class="text-blue text-16-pt semibold padding-left-10 label-todos">Marcar todos</label>
                  </div>
                </div>
              </div>
              <div class="row margin-top-20 lista-produtos">
                @forelse( $items as $produto )
                  @include('sistema.parts.dash.produtos')
                @empty
                  <div class="alert alert-warning">Nenhum produto cadastrado ainda!</div>
                @endforelse
              </div>
              <div class="row margin-top-20 horizontal-right">
                <button type="submit" class="roboto text-white text-18-pt bold toupper button-yellow">Adicionar à vitrine</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@section('scripts')
  <link rel="stylesheet" href="{{assets('sistema/css/dash/app.css')}}">
  <link rel="stylesheet" href="{{assets('sistema/css/dash/vinculados.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/flat/blue.css">
  <script src="{{assets('sistema/js/dash/vendedor/vinculados.js')}}"></script>
  <script src="{{assets('backend/plugins/iCheck/icheck.min.js')}}"></script>
  <script>
    $(document).ready(function(){
      $('input').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
      });
    })
  </script>
@stop