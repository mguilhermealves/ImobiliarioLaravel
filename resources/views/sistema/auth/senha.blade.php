@extends('sistema.layouts.default')
@section('content')

<div class="container-fluid topo-internas">
    <div class="container">
        <div class="row padding-top-15 breadcrumbs">
            <div class="col-lg-12">
                <ul>
                    <li><a href="{{route('sistema.index')}}">home</a></li>
                    <li>/</li>
                    <li>Esqueci minha senha</li>
                </ul>
            </div>
        </div>

        <div class="row padding-top-15 padding-bottom-50">
            <div class="col-lg-12 titulo-pagina">
                <h1 class="xs-gone">Esqueci                            
                    <b>Minha senha</b></h1>
                    <h1 class="xs-only">Esqueci                            
                      <b>Minha senha</b></h1>

                    <div class="row margin-top-30">
                        <div class="col-lg-10">
                            <p>Será enviado para o seu e-mail instruções de como gerar uma nova senha.</p>
                        </div>
                    </div>                            
            </div>
        </div>
    </div>
</div>


<div class="container-fluid padding-top-50 padding-bottom-90  associe-agencia bg-internas">
    <div class="container">
        <div class="row formulario-padrao  content-quem-somos">                   
            <div class="col-lg-7 padding-right-20">

                <form data-action="{{ route('sistema.auth.senha') }}" class="form-normal formulario">
                    <div class="row">
                        <div class="col-lg-12 margin-top-20">
                            <label>E-mail</label>
                            <input type="email" name="email" placeholder="Digite aqui..." />      
                        </div>                         
                    </div>
                
                    <div class="row">
                        <div class="col-lg-12  margin-top-20 text-center">
                            <button type="submit"><i class="fas fa-chevron-circle-right margin-top-5 margin-right-5"></i> Acessar</button>
                        </div>
                    </div>
                    
                </form>


            </div>
        </div>

    </div>
</div>





@stop

@section('scripts')
  <link href="{{ assets('sistema/css/auth/login.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="{{assets('node_modules/sweetalert2/dist/sweetalert2.css')}}">
  <script src="{{assets('plugins/js/mask.js')}}"></script>
  <script src="{{assets('plugins/js/masks.js')}}"></script>
  <script src="{{assets('node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
@endsection