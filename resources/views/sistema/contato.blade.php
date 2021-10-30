@extends('sistema.layouts.default')
@section('content')

        <div class="container-fluid topo-internas">
            <div class="container">
                <div class="row padding-top-15 breadcrumbs">
                    <div class="col-lg-12">
                        <ul>
                            <li><a href="">home</a></li>
                            <li>/</li>
                            <li>contato</li>
                        </ul>
                    </div>
                </div>

                <div class="row padding-top-15 padding-bottom-100 xs-padding-bottom-20">
                    <div class="col-lg-6 titulo-pagina">
                        <h1>Dúvidas?<br/>                            
                            <b>fale conosco</b></h1>

                            <div class="row margin-top-30 xs-margin-top-10">
                                <div class="col-lg-10">
                                    <p>{{$geral->subtitulo_contato}}</p>
                                </div>
                            </div>                            
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid padding-top-65 padding-bottom-60 xs-padding-top-30 bg-internas">
            <div class="container">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12 padding-60 xs-padding-30 box-contatos">
                                <h3>Entre em contato com a Assertem </h3>
                                <div class="row margin-top-25">
                                    <div class="col-2">
                                        <img src="{{assets('site/images/icon-tel-interna.png')}}" />
                                    </div>
                                    <div class="col-10 padding-left-20">
                                        <p>ATENDIMENTO<br/>
                                        <a href="tel:{{$geral->atendimento}}">{{$geral->atendimento}}</a>
                                        <br><a href="https://wa.me/55{{preg_replace(array('/\(/', '/\)/', '/\-/','/[ -]+/'), '',$geral->whatsapp)}}" target="_blank">WhatsApp: {{$geral->whatsapp}}</a></p>
                                    </div>
                                </div>
                                <div class="row margin-top-25">
                                    <div class="col-2">
                                        <img src="{{assets('site/images/icon-email-interna.png')}}" />
                                    </div>
                                    <div class="col-10 padding-left-20">
                                        <p>ENVIE UM E-MAIL<br/>
                                           
                                        @foreach($emailsgeral as $mail)
                                        @foreach($mail as $k=>$v)
                                            <a href="mailto:{{$v['email']}} ">{{$v['email']}} </a><br/>                                              
                                        @endforeach 
                                       @endforeach                                        
                                    </div>
                                </div>
                                <div class="row margin-top-25">
                                    <div class="col-2">
                                        <img src="{{assets('site/images/icon-location-interna.png')}}" />
                                    </div>
                                    <div class="col-10 padding-left-20">
                                        <p>ONDE ESTAMOS<br/>
                                        <a href="">{{$geral->onde_estamos}}</a></p>
                                            <br/><br/>
                                        <a href="{{$geral->como_chegar}}" class="como-chegar" target="_blank"><img src="{{assets('site/images/icon-chegar.png')}}" class="margin-right-10" />Como chegar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 padding-left-20 xs-padding-left-0 xs-padding-top-35">
                        <div class="row">
                            <div class="col-lg-12 center-block formulario-padrao">
                                <div class="row text-left">
                                    <div class="col-lg-12  padding-left-5 padding-right-5">
                                        <h2>Formulário de <b>contato</b></h2>
                                        <br/>
                                       <h3>Envie sua dúvida</h3>
                                    </div>
                                </div>

                                <form data-action="{{route('sistema.contato.enviar')}}" class="formulario form-normal">
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
                                    <div class="col-lg-7 padding-left-5 padding-right-5 margin-top-20">
                                        <label>E-mail</label>
                                        <input type="email" name="email" placeholder="Digite aqui..." />
        
                                    </div>
                                    <div class="col-lg-5 padding-left-5 padding-right-5 margin-top-20 telefone">
                                        <label>Telefone / WhatsApp</label>
                                        <input type="tel" name="telefone" placeholder="Digite aqui..." />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 padding-left-5 padding-right-5 margin-top-20 ">
                                        <label>Assunto</label>
                                        <input type="text" name="assunto" placeholder="Digite aqui..." />
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-lg-12 padding-left-5 padding-right-5 margin-top-20 cpf">
                                        <label>Mensagem</label>
                                        <textarea name="mensagem" placeholder="Digite aqui..."></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 padding-left-5 padding-right-5 margin-top-20 text-center">
                                        <button><i class="fas fa-chevron-circle-right margin-top-5 margin-right-5"></i> Enviar</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>


        <div class="container-fluid margin-top-50 mapa-contato">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3657.608622539856!2d-46.64385338292676!3d-23.546575098424906!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce584dc1afd8fd%3A0xec4ea7c812297577!2sAsserttem%20-%20Associa%C3%A7%C3%A3o%20Brasileira%20do%20Trabalho%20Tempor%C3%A1rio!5e0!3m2!1spt-BR!2sbr!4v1590639575866!5m2!1spt-BR!2sbr" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
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

@endsection

