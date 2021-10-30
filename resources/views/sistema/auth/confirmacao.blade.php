@extends('sistema.layouts.default')
@section('content')


<div class="container-fluid topo-internas">
  <div class="container">
      <div class="row padding-top-15 breadcrumbs">
          <div class="col-lg-12">
              <ul>
                  <li><a href="{{route('sistema.index')}}">home</a></li>
                  <li>/</li>
                  <li>Confirmar cadastro</li>
              </ul>
          </div>
      </div>

      <div class="row padding-top-15 padding-bottom-50">
          <div class="col-lg-12 titulo-pagina">
              <h1>Cadastro                            
                  <b>Confirmado</b></h1>

                  <div class="row margin-top-30">
                      <div class="col-lg-10">
                          <p>Acesse sua conta clicando no botão abaixo</p>
                      </div>
                  </div>                            
          </div>
      </div>
  </div>
</div>

<div class="container-fluid padding-top-50 padding-bottom-90  associe-agencia bg-internas">
  <div class="container">
      <div class="row formulario-padrao content-quem-somos">                   
          <div class="col-lg-4 center-block  padding-right-20 area-restrita">
            <a href="{{route('sistema.auth.login')}}" class="padding-top-20 padding-bottom-20"><i class="fas fa-lock"></i>ÁREA RESTRITA</a>
          </div>
      </div>
  </div>
</div>


@endsection

@section('scripts')
  <link href="{{ assets('sistema/css/auth/register.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="{{assets('node_modules/sweetalert2/dist/sweetalert2.css')}}">
  <script src="{{assets('plugins/js/mask.js')}}"></script>
  <script src="{{assets('plugins/js/masks.js')}}"></script>
  <script src="{{assets('node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
@endsection