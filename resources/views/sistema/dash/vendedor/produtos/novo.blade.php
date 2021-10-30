@extends('sistema.layouts.dash')
@section('content')
<link rel="stylesheet" href="{{assets('sistema/css/painel/perfil.css')}}">

<section class="novo-produto">

    <main class="cadastro-produto -categoria padding-bottom-90">
        <!-- GRID PANEL -->
        <div class="container">
            <div class="box-header padding-top-15 padding-bottom-25 margin-bottom-30">
                <div class="d-flex align-items-center justify-content-between">
                    <h1 class="page-title">Cadastre um novo produto</h1>
                </div>
            </div>
            
            <div class="box-steps">
                <ul>
                    <li class="step-01 active"><span>Selecione a categoria</span></li>
                    <li class="step-02"><span>Preencha informações sobre o produto</span></li>
                </ul>
            </div>

            <div class="box-content">
                <div class="box-content-header">
                    <h2 class="title">Selecione a categoria</h2>

                    <form class="form-inline">
                        <div class="form-group">
                            <label for="pesquisar">Pesquise por palavra-chave do produto</label>
                            <input type="text" class="form-control margin-left-20 busca" placeholder="Digite aqui">
                        </div>
                        <button type="button" class="btn margin-left-10 btn-pesquisa-categorias" data-url="{{route('sistema.dash.vendedor.produtos.novo.pesquisa')}}">Ok</button>
                    </form>
                </div>
                
                <div class="box-content-body lista-categorias relative">
                  <div class="col-12 pesquisadas">

                  </div>
                    <div class="row organicas">
                        <div class="box-category col-lg-4">
                            <div class="inner">
                                <div class="scroll">
                                    <ul class="categorias" data-url="{{route('sistema.dash.vendedor.produtos.get-sub')}}">
                                      @foreach( $categorias as $categoria )
                                        <li data-id="{{$categoria->id}}">{{$categoria->nome}}</li>
                                      @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="box-category col-lg-4">
                            <div class="inner">
                                <div class="scroll">
                                    <ul class="subs" data-url="{{route('sistema.dash.vendedor.produtos.get-grupo')}}">
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="box-category col-lg-4 box-grupos not-show">
                            <div class="inner">
                                <div class="scroll">
                                    <ul class="grupos">
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box-categorias-selecionadas">
                        <h3>Categorias selecionadas</h3>
                        <ul class="trail">
                        </ul>
                    </div>
                </div>
            </div>

            <div class="box-terms">
                <label>
                    <input type="checkbox" name="termos" class="termos">
                    <span class="">Concordo com os <a href="#">termos de uso e política de privacidade</a> do 88 Markets</span>
                </label>
            </div>

            <div class="box-button margin-top-40">
                <button class="button proximo" data-url="{{route('sistema.dash.vendedor.produtos.novo.dados')}}">Próximo Passo</button>
            </div>
            <div class="row margin-top-20 horizontal-center">
              Não encontrou sua categoria? Clique &nbsp;<a data-fancybox data-type="iframe" data-src="{{route('sistema.dash.vendedor.produtos.categorias.mensagem')}}" href="javascript:;"> AQUI </a> &nbsp; e nos envie uma mensagem!
            </div>
        </div>
        <!-- GRID PANEL -->
    </main>
</section>
@endsection
@section('scripts')
  <style>
    @media( min-width: 769px ){
      .fancybox-slide--iframe .fancybox-content {
        width  : auto;
        height : auto;
        max-width  : 40%;
        max-height : 100%;
        margin: 0;
        background: #191919;
      }
    }
  </style>
  <script src="{{assets('sistema/js/dash/vendedor/produtos.js')}}"></script>
  <link rel="stylesheet" href="{{assets('node_modules/sweetalert2/dist/sweetalert2.css')}}">
  <script src="{{assets('node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
  <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
@endsection