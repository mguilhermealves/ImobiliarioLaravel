@extends('sistema.layouts.default')
@section('content')

<div class="container-fluid topo-internas">
    <div class="container">
        <div class="row padding-top-15 breadcrumbs">
            <div class="col-lg-12">
                <ul>
                    <li><a href="{{route('sistema.index')}}">home</a></li>
                    <li>/</li>
                    <li>Login</li>
                </ul>
            </div>
        </div>

        <div class="row padding-top-15 padding-bottom-50">
            <div class="col-lg-12 titulo-pagina">
                <h1 class="xs-gone">Àrea                            
                    <b>Restrita</b></h1>
                    <h1 class="xs-only">Àrea   <br/>                         
                      <b>Restrita</b></h1>

                    <div class="row margin-top-30">
                        <div class="col-lg-10">
                            <p>Crie sua senha.</p>
                        </div>
                    </div>                            
            </div>
        </div>
    </div>
</div>



<form data-action="{{ route('sistema.auth.criar-senha', [$usuario, $token]) }}" class="form-normal formulario">


    <div class="container-fluid padding-top-50 padding-bottom-90  associe-agencia bg-internas">
        <div class="container">
            <div class="row formulario-padrao  content-quem-somos">                   
                <div class="col-lg-7 padding-right-20 center-block">
                     <form data-action="{{ route('sistema.auth.login') }}" class="form-normal formulario">
                      

                        <div class="row">
                            <div class="col-lg-12 margin-top-20 cpf">
                                <label>Senha</label>
                                <input type="password" id="senha" name="senha" class="form-control" required />
                            </div>                           
                        </div>

                        <div class="row">
                            <div class="col-lg-12 margin-top-20 cpf">
                                <label>Confirmar Nova Senha</label>
                                <input type="password" id="senha_confirmation" name="senha_confirmation" class="form-control" required />
                            </div>                           
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-12  margin-top-20 text-center">
                                <button type="submit"><i class="fas fa-chevron-circle-right margin-top-5 margin-right-5"></i> Alterar</button>
                            </div>
                        </div>
                      

                    </form>
                </div>

            </div>  
        
        </div>
    </div>

    {{-- <main id="login" class="page margin-bottom-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 form center-block">
                   
                        <div class="form-group">
                            <label for="senha" class="tajawal text-black text-20-pt bold">Nova Senha:</label>
                            <input type="password" id="senha" name="senha" class="form-control" required />
                        </div>
                        <div class="form-group margin-top-20">
                            <label for="senha_confirmation" class="tajawal text-black text-20-pt bold">Confirmar Nova Senha:</label>
                            <input type="password" id="senha_confirmation" name="senha_confirmation" class="form-control" required />
                        </div>

                        <div class="button horizontal-center margin-top-20">
                            <input type="submit" class="roboto text-white text-18-pt bold toupper button-yellow" value="alterar senha" />
                        </div> 
                  
                </div>
            </div>
        </div>
    </main> --}}


</form>

@stop

@section('scripts')
  <link href="{{ assets('sistema/css/auth/login.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="{{assets('node_modules/sweetalert2/dist/sweetalert2.css')}}">
  <script src="{{assets('plugins/js/mask.js')}}"></script>
  <script src="{{assets('plugins/js/masks.js')}}"></script>
  <script src="{{assets('node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
@endsection