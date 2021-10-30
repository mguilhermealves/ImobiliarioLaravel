@extends('sistema.layouts.default')
@section('content')

        <div class="container-fluid topo-internas">
            <div class="container">
                <div class="row padding-top-15 breadcrumbs">
                    <div class="col-lg-12">
                        <ul>
                            <li><a href="{{route('sistema.index')}}">home</a></li>
                            <li>/</li>                           
                            <li>notícias</li>
                        </ul>
                    </div>
                </div>

                <div class="row padding-top-15 padding-bottom-85 xs-padding-bottom-30">
                    <div class="col-lg-5 titulo-pagina">
                        <h1>Notícias<br/>                            
                            <b>assertem</b></h1>
                       
                            <div class="row margin-top-30 xs-margin-top-10">
                                <div class="col-lg-10">
                                    <p>{{$geral->subtitulo_noticias}}</p>
                                </div>
                            </div>  
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid padding-top-65 padding-bottom-60 xs-padding-top-30 bg-internas noticias-listagem">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            @foreach($noticias->take(1) as $noticia)
                            <div class="col-lg-12 noticia-destaque">
                                <a href="{{route('sistema.noticia',['slug'=>$noticia->slug])}}">
                                    <div class="row imagem">
                                        <img src="{{$noticia->imagem}}" />
                                    </div>
                                    <div class="row margin-top-negative-180">
                                        <div class="col-lg-10 center-block">
                                            <span>Publicado em 
                                                {{dateBdToApp($noticia->data)}} às {{timeBdToApp($noticia->data)}}</span>
                                            <h2>{{$noticia->titulo}}</h2>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                        <div class="row margin-top-130 xs-margin-top-100">  
                            @foreach($noticias->skip(1)->take(1) as $noticia)                          
                                <div class="col-lg-12 box-noticia-padrao"> 
                                                                
                                        <div class="row">
                                            <div class="col-lg-5">
                                                <a href="{{route('sistema.noticia',['slug'=>$noticia->slug])}}">
                                                <div class="imagem">                                                    
                                                    <img src="{{$noticia->imagem}}" />
                                                </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-7 padding-left-25">
                                                <a href="{{route('sistema.noticia',['slug'=>$noticia->slug])}}">
                                                    <span>Publicado em {{dateBdToApp($noticia->data)}} às {{timeBdToApp($noticia->data)}}</span>
                                                    <h2>{{$noticia->titulo}}</h2>
                                                    <p>{{$noticia->resumo}}</p>
                                                </a>
                                                <div class="row margin-top-20">
                                                    <div class="col-lg-12 padding-top-20 compartilhe">
                                                        <div class="row">
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
                                            </div>
                                        </div>  
                                                              
                                </div>
                            @endforeach
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 padding-left-30 xs-padding-left-0 xs-margin-top-25">
                        @include('sistema.parts.mais-lidas')
                    </div>
                </div>

                <div class="row margin-top-60">
                    <div class="col-lg-12 padding-left-80 padding-right-80 padding-top-40 padding-bottom-60 videos-noticias">
                        <h2>Vídeos</h2>
                        <div class="row margin-top-20 lista-videos">
                            @foreach($videos as $video)
                            <div class="col-lg-12 padding-left-15 padding-right-15">
                                {!!$video->iframe!!}
                            </div>
                            @endforeach                                                        
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8">                       
                        @foreach($noticias->skip(2)->all() as $noticia) 
                            <div class="row margin-top-75">                            
                                <div class="col-lg-12 box-noticia-padrao">                                                             
                                        <div class="row">
                                            <div class="col-lg-5">

                                                <a href="{{route('sistema.noticia',['slug'=>$noticia->slug])}}">
                                                    <div class="imagem">                                                    
                                                        <img src="{{$noticia->imagem}}" />
                                                    </div>
                                                    </a>
                                            </div>
                                            <div class="col-lg-7 padding-left-25">
                                                <a href="{{route('sistema.noticia',['slug'=>$noticia->slug])}}">
                                                    <span>Publicado em {{dateBdToApp($noticia->data)}} às {{timeBdToApp($noticia->data)}}</span>
                                                    <h2>{{$noticia->titulo}}</h2>
                                                    <p>{{$noticia->resumo}}</p>
                                                </a>
                                                <div class="row margin-top-20">
                                                    <div class="col-lg-12 padding-top-20 compartilhe">
                                                        <div class="row">
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
                                            </div>
                                        </div>                                                              
                                </div>                            
                            </div>
                        @endforeach
                        
                            <div class="row">
                                <div class="col-lg-12">
                                    {{$noticias->appends(request()->all())->links()}}
                                </div>
                            </div>
                    </div>
                    <div class="col-lg-4 padding-left-30">
                       {{-- <div class="row">
                           <div class="col-lg-12 margin-top-75 padding-bottom-30 newsletter">
                               <div class="row">
                                   <div class="col-lg-12 padding-left-45 padding-top-40 topo-newsletter">
                                        <h2>Newsletter</h2>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="col-lg-12 padding-left-35 padding-right-35 padding-top-30">
                                        <input type="text" name="nome" placeholder="Digite o seu nome" />
                                   </div>                                  
                               </div>
                               <div class="row">
                                    <div class="col-lg-12 padding-left-35 padding-right-35 padding-top-10">
                                        <input type="email" name="email" placeholder="Digite o seu nome" />
                                    </div>                                  
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 padding-left-35 padding-right-35 padding-top-15">
                                        <button>CADASTRAR AGORA <i class="fas fa-arrow-circle-right"></i></button>
                                    </div>                                  
                                </div>
                           </div>
                       </div> --}}

                       <div class="row margin-top-30">
                           <div class="col-lg-12 banner-vertical">
                            
                            @if($banners)
                               @foreach($banners as $banner)
                                @if($banner->nome == 'Vertical')
                                    <a href="{{$banner->link}}" target="{{$banner->target}}">
                                        <img src="{{$banner->imagem}}" />
                                    </a>
                                @endif
                               @endforeach
                            @endif
                                {{--  <img src="{{assets('site/images/banner-vertical.png')}}" />  --}}
                           </div>
                       </div>

                    </div>
                </div>

                <div class="row margin-top-35">
                    <div class="col-lg-12 banner-livre">
                        @if($banners)
                        @foreach($banners as $banner)
                         @if($banner->nome == 'Horizontal')
                             <a href="{{$banner->link}}" target="{{$banner->target}}">
                                 <img src="{{$banner->imagem}}" />
                             </a>
                         @endif
                        @endforeach
                     @endif
                    </div>
                </div>

            </div>
        </div>

     
    @endsection
  