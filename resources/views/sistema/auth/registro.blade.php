@extends('sistema.layouts.default')
@section('content')


  <div class="container-fluid topo-internas">
      <div class="container">
          <div class="row padding-top-15 breadcrumbs">
              <div class="col-lg-12">
                  <ul>
                      <li><a href="{{route('sistema.index')}}">home</a></li>
                      <li>/</li>
                      <li>quero me associar</li>
                  </ul>
              </div>
          </div>

          <div class="row padding-top-15 padding-bottom-50">
              <div class="col-lg-12 titulo-pagina">
                  <h1 class="xs-gone">quero                            
                      <b>me associar</b></h1>
                      <h1 class="xs-only">quero <br/>                           
                        <b>me associar</b></h1>

                      <div class="row margin-top-30">
                          <div class="col-lg-10">
                              <p>{{$geral->subtitulo_quero_associar}}</p>
                          </div>
                      </div>                            
              </div>
          </div>
      </div>
  </div>

  <div class="container-fluid padding-top-65 padding-bottom-80 bg-internas">
      <div class="container">
        <div class="row">
            <div class="col-lg-12 interna-trabalho">
                {!!$geral->conteudo_associar!!}
            </div>
        </div>


          <div class="row padding-top-30">
              <div class="col-lg-6 center-block formulario-padrao">
                  <div class="row text-center">
                      <div class="col-lg-12  padding-left-5 padding-right-5">
                          <h2>Preencha o <b>formulário</b></h2>
                          <br/>
                         <h3>Solicite sua associação</h3>
                      </div>
                  </div>

                  <form data-action="{{ route('sistema.auth.cadastrar') }}" class="form-normal">
                    <input type="hidden" name="assunto" value="Cadastro Associado" />
                  <div class="row">
                      <div class="col-lg-12  padding-left-5 padding-right-5 margin-top-40">                        
                          <label>Seu nome</label>
                          <input type="text" name="nome" placeholder="Digite aqui..." />
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-12 padding-left-5 padding-right-5 margin-top-20">
                          <label>Nome da empresa</label>
                          <input type="text" name="empresa" placeholder="Digite aqui..." />
                      </div>
                  </div>                
                  <div class="row">
                      <div class="col-lg-6 padding-left-5 padding-right-5 margin-top-20">
                          <label>E-mail</label>
                          <input type="email" name="email" placeholder="Digite aqui..." />

                      </div>
                      <div class="col-lg-6 padding-left-5 padding-right-5 margin-top-20 telefone">
                        <label>Telefone / WhatsApp</label>
                        <input type="tel" name="telefone" placeholder="Digite aqui..." />
                      </div>
                  </div>                  
                  <div class="row">
                      <div class="col-lg-12 padding-left-5 padding-right-5 margin-top-20 cnpj">
                          <label>CPNJ</label>
                          <input type="text" name="cnpj" placeholder="Digite aqui..." />
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12 padding-left-5 padding-right-5 margin-top-20 cpf">
                        <label>Mensagem</label>
                        <textarea name="mensagem"></textarea>
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


@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/flat/blue.css">
<script src="{{assets('backend/plugins/iCheck/icheck.min.js')}}"></script>
  <script src="{{assets('plugins/js/mask.js')}}"></script>
  <script src="{{assets('plugins/js/masks.js')}}"></script>
  <link rel="stylesheet" href="{{assets('node_modules/sweetalert2/dist/sweetalert2.css')}}">
  <script src="{{assets('node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
  <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
  <script>
 
   jQuery.validate({
     lang: 'pt',
     modules : 'logic, html5, security'
 });
 </script>
  <script>
    $(document).ready(function(){
      $('.termos').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
      });         
    })
  </script>
@endsection