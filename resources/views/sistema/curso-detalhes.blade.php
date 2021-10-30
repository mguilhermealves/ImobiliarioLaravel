@extends('sistema.layouts.default')
@section('content')

        <div class="container-fluid topo-internas">
            <div class="container">
                <div class="row padding-top-15 breadcrumbs">
                    <div class="col-lg-12">
                        <ul>
                            <li><a href="{{route('sistema.index')}}">home</a></li>
                            <li>/</li>
                            <li><a href="{{route('sistema.cursos-palestras')}}">cursos e palestras</a></li>
                            <li>/</li>
                            <li>{{$curso->titulo}}</li>
                        </ul>
                    </div>
                </div>
               
                <div class="row padding-top-15 padding-bottom-150">
                    <div class="col-lg-5 titulo-pagina">
                        <h1>cursos<br/>                            
                            <b>e palestras</b></h1>
                            <p>{{$geral->subtitulo_cursos_palestras}}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid padding-top-65 padding-bottom-60 bg-internas">
            <div class="container">

                <div class="row">
                    <div class="col-lg-12 margin-top-negative-180 detalhes-curso-top">
                        <div class="row">
                            <div class="col-lg-6 padding-left-90 padding-top-65 padding-bottom-65 xs-padding-30">
                                <h2>Informações</h2>
                                <div class="row margin-bottom-30 margin-top-30">
                                    <div class="col-1">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <div class="col-11">
                                        <p>{{$curso->data}}</p>
                                    </div>
                                </div>
                                <div class="row margin-bottom-30">
                                    <div class="col-1">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="col-11">
                                        <p>{{$curso->local}}</p>
                                    </div>
                                </div>
                                <div class="row margin-bottom-40">
                                    <div class="col-1">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                    <div class="col-11">
                                        <p>{{$curso->valor}}</p>
                                    </div>
                                </div>
                                <div class="row">                                   
                                    <div class="col-lg-12">
                                       <a href="#" id="queroInscrever"><i class="fas fa-chevron-circle-right margin-top-5 margin-right-5"></i> QUERO ME INSCREVER</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-12 padding-left-35 xs-padding-left-0 padding-top-15 padding-right-15 padding-bottom-15 imagem-curso-detalhe">
                                        <img src="{{$curso->imagem1}}" />
                                        <div class="row padding-right-20 padding-left-20">
                                            <div class="col-lg-12 padding-top-25 padding-left-30 padding-bottom-25 padding-right-30 carga-horaria">
                                                <div class="row">
                                                    <div class="col-6 text-left">
                                                        {{$curso->titulo_horas}}
                                                    </div>
                                                    <div class="col-6 text-right">
                                                        {{$curso->horas}}
                                                    </div>
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row margin-top-70">
                    <div class="col-lg-12 conteudo-curso">
                        <ul class="nav" id="myTab" role="tablist">
                            <li class="nav-item text-center">
                              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#descricao" role="tab" aria-controls="descricao" aria-selected="true">Descrição</a>
                            </li>
                            <li class="nav-item text-center">
                              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#programacao" role="tab" aria-controls="programacao" aria-selected="false">Programação</a>
                            </li>
                            <li class="nav-item text-center">
                              <a class="nav-link" id="contact-tab" data-toggle="tab" href="#conteudo" role="tab" aria-controls="conteudo" aria-selected="false">Conteúdo</a>
                            </li>
                            <li class="nav-item text-center">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#requisitos" role="tab" aria-controls="requisitos" aria-selected="false">Pré-Requisitos</a>
                              </li>
                          </ul>
                          <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="descricao" role="tabpanel" aria-labelledby="home-tab">
                                <p> {!!$curso->descricao!!}</p>
                            </div>
                            <div class="tab-pane fade" id="programacao" role="tabpanel" aria-labelledby="profile-tab">
                                <p>{!!$curso->programacao!!}</p>
                            </div>
                            <div class="tab-pane fade" id="conteudo" role="tabpanel" aria-labelledby="contact-tab">
                                <p>{!!$curso->conteudo!!}</p>
                            </div>
                            <div class="tab-pane fade" id="requisitos" role="tabpanel" aria-labelledby="contact-tab">
                               <p>{!!$curso->requisitos!!}</p>
                            </div>
                          </div>
                    </div>
                </div>


                <div class="row padding-top-60">
                    <div class="col-lg-12 padding-top-60 padding-bottom-60 form-inscricao">
                        <div class="row">
                            <div class="col-lg-10 center-block formulario-padrao">
                                <div class="row text-center">
                                    <div class="col-lg-12  padding-left-5 padding-right-5">
                                        <h2>Faça sua inscrição neste curso!</h2>
                                        <br/>
                                       <h3>Preencha o formulário abaixo</h3>
                                    </div>
                                </div>

                                
                                <form class="form-normal" data-action="{{route('sistema.salvar-inscricao')}}">
                                    <input type="hidden" name="cursos_palestras_id" value="{{$curso->id}}" />
                                <div class="row">
                                    <div class="col-lg-6  padding-left-5 padding-right-5 margin-top-40">
                                        <label>Nome completo</label>
                                        <input type="text" name="nome" placeholder="Digite aqui..." required="required" />
                                    </div>
                                    <div class="col-lg-6 padding-left-5 padding-right-5 margin-top-40">
                                        <label>E-mail</label>
                                        <input type="email" name="email" placeholder="Digite aqui..." required="email" />
                                    </div>
                                </div>                              
                                <div class="row">
                                    <div class="col-lg-6 padding-left-5 padding-right-5 margin-top-20">
                                        <label>Assunto</label>
                                        <input type="text" name="assunto" placeholder="Digite aqui..." />
                                    </div>
                                    <div class="col-lg-6 padding-left-5 padding-right-5 margin-top-20 telefone">
                                        <label>Telefone / WhatsApp</label>
                                        <input type="tel" name="telefone" placeholder="Digite aqui..." required="required" />
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
@endsection

@section('scripts')
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