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
                <h1 class="xs-only">Àrea                            
                  <b>Restrita</b></h1>

                  <div class="row margin-top-30">
                      <div class="col-lg-10">
                          <p>Editar dados da agência</p>
                      </div>
                  </div>                            
          </div>
      </div>
  </div>
</div>

<div class="container-fluid padding-top-65 padding-bottom-80 bg-internas">
  <div class="container">

      <div class="row">
          <div class="col-lg-3 padding-right-15">
              <div class="row padding-top-30 padding-bottom-30 padding-left-35 padding-right-35 menu-restrita">
                  <div class="col-lg-12">
                      <ul>
                          <li><a href="{{route('sistema.dash.inicio')}}"><img src="{{assets('site/images/seta-login.png')}}" /> Inicio</a></li>
                          <li><a href="{{route('sistema.dash.meus-dados')}}"><img src="{{assets('site/images/seta-login.png')}}" /> Meus dados</a></li>                         
                          <li><a href="{{route('sistema.sair')}}"><img src="{{assets('site/images/seta-login.png')}}" /> Sair</a></li>
                      </ul>
                  </div>
              </div>
          </div>
          <div class="col-lg-9 padding-left-15 painel">
              <div class="row interna-juridico">
                  <div class="col-lg-12">
                      <h2>Meus <b>Dados</b></h2>                      
                  </div>
              </div>

              <div class="row">
                <div class="col-lg-12 formulario-padrao">
                
  
                    <form data-action="{{ route('sistema.dash.alterarConta') }}" class="form-normal">
                        <input type="hidden" value="{{$usuario->email}}" name="email" />
                    <div class="row">
                        <div class="col-lg-12  padding-left-5 padding-right-5 margin-top-40">                        
                            <label>Seu nome</label>
                            <input type="text" name="nome" value="{{$usuario->nome}}" placeholder="Digite aqui..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 padding-left-5 padding-right-5 margin-top-20">
                            <label>Nome da empresa</label>
                            <input type="text" name="empresa" value="{{$usuario->empresa}}" placeholder="Digite aqui..." />
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12 padding-left-5 padding-right-5 margin-top-20 telefone">
                          <label>Telefone / WhatsApp</label>
                          <input type="tel" name="telefone" value="{{$usuario->telefone}}" placeholder="Digite aqui..." />
                      </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 padding-left-5 padding-right-5 margin-top-20 ">
                            <label>Senha atual</label>
                            <input type="password" name="senha_atual"  placeholder="Digite aqui..." />
                        </div>
                      </div>
                   
                    <div class="row">
                      <div class="col-lg-6 padding-left-5 padding-right-5 margin-top-20 cpf">
                          <label>Nova senha</label>
                          <input type="password" name="senha" placeholder="Digite aqui..." />
                      </div>
                      <div class="col-lg-6 padding-left-5 padding-right-5 margin-top-20 cpf">
                        <label>Confirmar senha</label>
                        <input type="password" name="senha_confirmation" placeholder="Digite aqui..." />
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 padding-left-5 padding-right-5 margin-top-20 cnpj">
                            <label>CPNJ</label>
                            <input type="text" name="cnpj" value="{{$usuario->cnpj}}"  placeholder="Digite aqui..." />
                        </div>
                    </div>
                           
                    <div class="row">
                        <div class="col-lg-12 padding-left-5 padding-right-5 margin-top-20 text-center">
                            <button type="submit"><i class="fas fa-chevron-circle-right margin-top-5 margin-right-5"></i> Enviar</button>
                        </div>
                    </div>
                  </form>
                </div>
            </div>
            
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