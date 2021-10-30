@extends('sistema.layouts.default')
@section('content')

        <div class="container-fluid topo-internas">
            <div class="container">
                <div class="row padding-top-15 breadcrumbs">
                    <div class="col-lg-12">
                        <ul>
                            <li><a href="">home</a></li>
                            <li>/</li>                           
                            <li><a href="{{route('sistema.noticias')}}">notícias</a></li>
                            <li>noticia</li>
                        </ul>
                    </div>
                </div>

                <div class="row padding-top-15 padding-bottom-85">
                    <div class="col-lg-5 titulo-pagina">
                        <h1>Notícias<br/>                            
                            <b>assertem</b></h1>
                       
                            <div class="row margin-top-30">
                                <div class="col-lg-10">
                                    <p>{{$geral->subtitulo_noticias}}</p>
                                </div>
                            </div>  
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid padding-top-65 padding-bottom-60 bg-internas noticias-listagem">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 noticias-detalhes">
                        
                        <div class="row data-share">
                            <div class="col-lg-6 text-left">
                                <span class="data"> {{dateBdToApp($noticia->data)}}</span>
                            </div>
                            <div class="col-lg-6 text-right">
                                <div class="row compartilhe">
                                    <div class="col-lg-3">
                                        COMPARTILHE
                                    </div>
                                    <div class="col-lg-9 padding-left-20">
                                        <!-- AddToAny BEGIN -->
                                            <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                                <a class="a2a_dd" href="{{route('sistema.noticia',['slug'=>$noticia->slug])}}"></a>
                                                <a class="a2a_button_facebook"></a>
                                                <a class="a2a_button_twitter"></a>
                                                <a class="a2a_button_whatsapp"></a>
                                                </div>
                                                <script async src="https://static.addtoany.com/menu/page.js"></script>
                                                <!-- AddToAny END -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 margin-top-25 texto">
                                {!!$noticia->conteudo!!}                                
                            </div>
                        </div>
                       
                    </div>

                    <div class="col-lg-4 padding-left-30 xs-padding-left-0">
                        @include('sistema.parts.mais-lidas')
 
                        <div class="row margin-top-30">
                            <div class="col-lg-12 banner-vertical">
                                 {{--  <img src="{{assets('site/images/banner-vertical.png')}}" />  --}}
                            </div>
                        </div>
                    </div>

                </div>

        
            </div>
        </div>

     

@endsection