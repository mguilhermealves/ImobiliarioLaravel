<header class="menu-site padding-bottom-20">
  <div class="container-fluid  xs-gone">    
      <div class="row padding-top-25">
          
          <div class="col-xs-3 col-sm-3 col-lg-3 col-lg-3 text-center logo-site">
              <figure><a href="{{route('sistema.index')}}" target="_blank"><img src="{{assets('sistema/images')}}/logo.png" /></a></figure>
          </div>

          
          <div class="col-xs-9 col-sm-9 col-lg-9 col-lg-9 header-meio">
              <div class="row vertical-middle">                        
                  <div class="col-xs-7 col-sm-7 col-lg-7 col-lg-7 infos-empresa">
                      <div class="row">
                          <div class="col-xs-4 col-sm-4 col-lg-4 col-lg-3 logo-empresa">
                            <div class="row horizontal-center">
                              <img src="{{$usuario->imagem ?? assets('sistema/images/avatar.png')}}" />
                            </div>
                          </div>

                          <div class="col-xs-7 col-sm-7 col-lg-7 col-lg-7 padding-left-5">
                              <div class="row">                                        
                                  <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 avaliacao-empresa">
                                    <input value="{{$usuario->empresa->avaliacao}}" class="avaliacao rating-loading">
                                  </div>                                        
                              </div>
                              <div class="row">                                        
                                <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 nome-empresa">
                                    <h4>Olá, {{$usuario->nome}}</h4>
                                </div>                                        
                              </div>
                          </div>                                
                      </div>                                
                  </div>  
                  
                  
                  <div class="col-xs-5 col-sm-5 col-lg-5 col-lg-5 panel-options">
                      <div class="row vertical-middle">
                          <div class="col-lg-2 medalha">
                            <div class="row vertical-middle">
                              <img src="{{$usuario->empresa->plano->icone}}" width="25px" />
                              <span class="text-navy text-12-pt padding-left-5 semibold">{{$usuario->empresa->plano->nome}}</span>
                            </div>
                          </div>
                          <div class="col-xs-3 col-sm-3 col-lg-3 col-lg-3 text-center">
                              <a href="{{route('sistema.painel.perfil')}}" class="vertical-middle"><img src="{{assets('sistema/images/dash')}}/icons/perfil.png" class="padding-right-10" /> Meu Perfil</a>
                          </div>
                          <div class="col-xs-4 col-sm-4 col-lg-4 col-lg-4 padding-right-20">
                              <button class="log-off" onclick="window.location.href='{{route('sistema.sair')}}'">SAIR</button>
                          </div>
                      </div>
                  </div>
                  

              </div>
          </div>
          
          
      </div>    
  </div>
</header>

<section class="header mobile xs-only relative mobile-menu-dash">
  <div class="gradiente"></div>
  <section class="header-cima padding-bottom-10">
    <div class="container-fluid limit relative">
      <div class="row margin-top-55 vertical-middle xs-margin-top-10">
        <div class="col-lg-4 col-10">
          <div class="row logo">
            <a href="{{route('sistema.index')}}">
              <img src="{{assets('sistema/images/logo.png')}}" alt="">
            </a>
          </div>
        </div>
        <div class="col-2">
          <div class="row">
            <button class="hamburguer text-black text-24-pt bold">
              <i class="fas fa-bars"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="col-10 menu-mobile padding-10">
    <div class="fechar">
      <i class="fas fa-times"></i>
    </div>



    <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 header-meio">
      <div class="row vertical-middle">                        
          <div class="col-xs-7 col-sm-7 col-lg-7 col-lg-7 text-center infos-empresa">
              <div class="row">
                  <div class="col-xs-4 col-sm-4 col-lg-4 col-lg-3 logo-empresa">
                    <div class="row horizontal-center">
                      <img src="{{$usuario->imagem ?? assets('sistema/images/avatar.png')}}" />
                    </div>
                  </div>

                  <div class="col-xs-7 col-sm-7 col-lg-7 col-lg-7 padding-left-5">
                      <div class="row">                                        
                          <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 avaliacao-empresa">
                            <input value="{{$usuario->empresa->avaliacao}}" class="avaliacao rating-loading">
                          </div>                                        
                      </div>
                      <div class="row padding-top-10">                                        
                        <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 nome-empresa">
                            <h4>Olá, {{$usuario->nome}}</h4>
                        </div>                                        
                      </div>
                  </div>                                
              </div>                                
          </div>  
          
          
          <div class="col-xs-5 col-sm-5 col-lg-5 col-lg-5 panel-options">
              <div class="row vertical-middle">
                  <div class="col-lg-2 medalha">
                    <div class="row vertical-middle">                     
                        <div class="col-lg-12 padding-top-10  text-center">                          
                          <img src="{{$usuario->empresa->plano->icone}}" width="25px" />
                          <span class="text-navy text-20-pt padding-left-5 semibold">{{$usuario->empresa->plano->nome}}</span>
                        </div>                      
                    </div>
                  </div>
                  <div class="col-6 xs-padding-top-20 padding-left-30">
                      <a href="{{route('sistema.painel.perfil')}}" class="vertical-middle">
                        <img src="{{assets('sistema/images/dash')}}/icons/perfil.png" class="padding-right-5" />Meu Perfil</a>
                  </div>
                  <div class="col-6 xs-padding-top-20 padding-right-30">
                      <button class="log-off" onclick="window.location.href='{{route('sistema.sair')}}'">SAIR</button>
                  </div>
              </div>

              @include('sistema/parts/dash/menu')

          </div>
          

      </div>
  </div>



  </div>
</section>