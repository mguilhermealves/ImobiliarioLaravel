<header id="topopage">


    <div class="container-fluid mobile-nav xs-only">
        <div class="row">
            <div class="col-12 padding-left-35 padding-top-35 painel-menu-usuario">
                <nav>
                    <ul>                       
                            <li><a href="{{route('sistema.asserttem')}}">ASSERTTEM</a></li>
                            <li><a href="{{route('sistema.trabalho-temporario')}}">TRABALHO TEMPORÁRIO</a></li>
                            <li><a href="{{route('sistema.agencias-associadas')}}">AGÊNCIAS ASSOCIADAS</a></li>
                            <li><a href="{{route('sistema.juridico')}}">jurídico</a></li>
                            <li><a href="{{route('sistema.cursos-palestras')}}">cursos e palestras</a></li>
                            <li><a href="{{route('sistema.noticias')}}">Notícias</a></li>
                            <li><a href="{{route('sistema.duvidas-frequentes')}}">dúvidas frequentes</a></li>
                            <li><a href="{{route('sistema.contato')}}">contato</a></li>
                        <li><a href="{{route('sistema.auth.cadastro')}}"><i class="fas fa-handshake"></i> Quero me associar</a>  </li>
                        <li>
                            @guest('sistema')                            
                                <a href="{{route('sistema.auth.login')}}"><i class="fas fa-lock"></i> ÁREA RESTRITA</a>                            
                            @endguest
                            @auth('sistema')                              
                                    <a href="{{route('sistema.dash.inicio')}}">Olá, {{Str::limit($usuario->nome, 10)}}! <i class="fas fa-user margin-left-5"></i></a>                                
                            @endauth
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-10 logo">
                        <a href="{{route('sistema.index')}}">
                            <img src="{{assets('site/images/logo.png')}}" />
                        </a>
                    </div>
                    <div class="col-2">
                        <button type="menu" class="menu-toogle"><i class="fas fa-bars"></i></button>
                    </div>
                </div>                
            </div>
        </div>
    </div>



  <div class="container-fluid topo-inicial xs-gone">
      <div class="container">
          <div class="row">
              <div class="col-lg-2 logo-site">
                  <a href="{{route('sistema.index')}}">
                      <img src="{{assets('site/images/logo.png')}}" />
                  </a>
              </div>
              <div class="col-lg-5 text-right padding-right-45 redes-sociais-topo">
               
              </div>
              <div class="col-lg-3 padding-top-30 botao-associar">
                  <div class="row">
                      <div class="col-lg-12 padding-left-10">
                          <a href="{{route('sistema.auth.cadastro')}}"><i class="fas fa-handshake"></i> Quero me associar</a>  
                      </div>
                  </div>                        
              </div>
              <div class="col-lg-2 padding-top-30 padding-left-10 area-restrita">
                  <div class="row">

                    @guest('sistema')
                      <div class="col-lg-12">
                          <a href="{{route('sistema.auth.login')}}"><i class="fas fa-lock"></i> ÁREA RESTRITA</a>
                      </div>
                    @endguest
                    @auth('sistema')
                        <div class="col-lg-12 logado">
                            <a href="{{route('sistema.dash.inicio')}}">Olá, {{Str::limit($usuario->nome, 10)}}! <i class="fas fa-user margin-left-5"></i></a>
                        </div>
                    @endauth
                  </div>                        
              </div>
          </div>
      </div>
  </div>  
                                                   
  <div class="container-fluid menu-topo xs-gone">
      <div class="container">
          <div class="row">
              <div class="col-lg-12 padding-top-20 padding-bottom-20">
                  <ul>
                      {{-- <li><a href="{{route('sistema.asserttem')}}">ASSERTTEM</a></li>
                      <li><a href="{{route('sistema.trabalho-temporario')}}">TRABALHO TEMPORÁRIO</a></li>
                      <li><a href="{{route('sistema.agencias-associadas')}}">AGÊNCIAS ASSOCIADAS</a></li>
                      <li><a href="{{route('sistema.juridico')}}">jurídico</a></li>
                      <li><a href="{{route('sistema.cursos-palestras')}}">cursos e palestras</a></li>
                      <li><a href="{{route('sistema.noticias')}}">Notícias</a></li>
                      <li><a href="{{route('sistema.duvidas-frequentes')}}">dúvidas frequentes</a></li>
                      <li><a href="{{route('sistema.contato')}}">contato</a></li> --}}
                  </ul>
              </div>
          </div>
      </div>    
  </div>  
  
</header>