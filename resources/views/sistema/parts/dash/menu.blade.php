<aside class="menu-painel padding-top-35 padding-right-25 padding-left-5 relative xs-gone">
  <div class="row chave-vendedor-comprador">       
    <div class="col-xs-6 col-sm-6 col-lg-6 col-lg-6">
      <a href="{{route('sistema.dash.vendedor')}}"  @if( request()->is('dash/vendedor*') ) class="ativo" @endif>
        Vendedor
        @if( request()->is('dash/vendedor*') && ((int)$nmensagensV > 0 || (int)$ncotacoesV > 0) || $novaMsgRfqPanelVendedor)
          <i class="fas fa-circle text-red"></i>
        @endif
      </a>
      </div>             
      <div class="col-xs-6 col-sm-6 col-lg-6 col-lg-6">
          <a href="{{route('sistema.dash.comprador')}}"  @if( !request()->is('dash/vendedor*') ) class="ativo" @endif>
            Comprador
            @if( request()->is('dash/comprador*') && ((int)$nmensagensC > 0 || (int)$ncotacoesC > 0)  || $novaMsgRfqPanelComprador )
              <i class="fas fa-circle text-red"></i>
            @endif
          </a>
      </div>
  </div>

  <div class="row padding-top-40 padding-bottom-40">                    
      <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 menu-lateral-panel">
        @if( request()->is('dash/vendedor*') )
       
          <nav>
            <ul class="menu">                            
                <li class="@if( request()->is('dash/vendedor') )active @endif"><a href="{{route('sistema.dash.vendedor')}}"><div class="icon-menu"><i class="fas fa-tachometer-alt"></i></div> Dash</a></li>
                <li class="@if( request()->is('dash/mensagens*') )active @endif">
                  <a href="{{route('sistema.dash.vendedor.mensagens')}}">
                    <div class="icon-menu">
                      <i class="fas fa-comments"></i>
                    </div> Mensagem                     
                   @if( $nmensagens > 0 ) <span class="badge badge-danger">{{$nmensagens}}</span> @endif
                  </a>
                </li>
                <li class="@if( request()->is('dash/vendedor/meu-88market*') )active @endif"><a href="{{route('sistema.dash.vendedor.rfqs')}}"><div class="icon-menu"><i class="fas fa-bullhorn"></i></i></div>                     
                  Meu 88 Market                
                 @if($novaMsgRfqPanelVendedor)
                  <i class="fas fa-circle text-red"></i>
                 @endif
               
                </a></li>
                <li class="@if( request()->is('dash/vendedor/cotacoes*') )active @endif">
                  <a href="{{route('sistema.dash.vendedor.cotacoes')}}">
                    <div class="icon-menu">
                      <i class="fas fa-dollar-sign"></i>
                    </div> Cotações @if( $ncotacoes > 0 ) <span class="badge badge-danger">{{$ncotacoes}}</span> @endif
                  </a>
                </li>
                <li class="@if( request()->is('dash/vendedor/contatos*') )active @endif"><a href="{{route('sistema.dash.vendedor.contatos')}}"><div class="icon-menu"><i class="fas fa-envelope"></i></div> Contatos</a></li>
                <li class="@if( request()->is('dash/vendedor/produto*') ||  request()->is('dash/vendedor/grupos*') ) active @endif">
                  <a href="{{route('sistema.dash.vendedor.produtos')}}"><div class="icon-menu"><i class="fas fa-th-list"></i></div> Meus produtos</a>
                  <ul class="sub">
                    <li>
                      <div class="coluna-sub-produtos">
                        <h3 class="text-center padding-bottom-15 padding-top-15">Meus produtos</h3>
                        <div class="row padding-left-15 padding-top-35">
                          <nav>
                            <ul>
                              <li><a href="{{route('sistema.dash.vendedor.produtos.novo')}}">Novo produto</a></li>
                              <li><a href="{{route('sistema.dash.vendedor.produtos')}}">Gerenciar produtos</a></li>
                              <li><a href="{{route('sistema.dash.vendedor.produtos.banco')}}">Banco de fotos</a></li>
                              <li><a href="{{route('sistema.dash.vendedor.produtos.grupos')}}">Personalizar grupo</a></li>
                            </ul>
                          </nav>
                        </div>
                      </div>
                    </li>
                  </ul>
                </li>
                <li  class="@if( request()->is('dash/vendedor/empresa*') ||  request()->is('dash/vendedor/website*') ||  request()->is('dash/vendedor/vitrine*') ) active @endif">
                  <a href="{{route('sistema.dash.vendedor.empresa')}}"><div class="icon-menu"><i class="fas fa-globe"></i></div> Empresa / Minisite</a>
                  <ul class="sub">
                    <li>
                      <div class="coluna-sub-produtos">
                        <h3 class="text-center padding-bottom-15 padding-top-15">Empresa / Minisite</h3>
                        <div class="row padding-left-15 padding-top-35">
                          <nav>
                            <ul>
                              <li><a href="{{route('sistema.dash.vendedor.empresa')}}">Informações da empresa</a></li>
                              <li><a href="{{route('sistema.dash.vendedor.website')}}">Meu Website</a></li>
                              <li><a @if( $usuario->empresa->plano->vitrine > 0 ) href="{{route('sistema.dash.vendedor.vitrine')}}" @else href="#" @endif>Vitrine</a></li>
                            </ul>
                          </nav>
                        </div>
                      </div>
                    </li>
                  </ul>
                </li>
            </ul>
          </nav>
        @else
          <nav>
            <ul class="menu">                            
                <li class="@if( request()->is('dash') )active @endif"><a href="{{route('sistema.dash.comprador')}}"><div class="icon-menu"><i class="fas fa-tachometer-alt"></i></div> Dash</a></li>
                <li class="@if( request()->is('dash/comprador/mensagens*') )active @endif">
                  <a href="{{route('sistema.dash.comprador.mensagens')}}">
                    <div class="icon-menu">
                      <i class="fas fa-comments"></i>
                    </div> Mensagem                   
                    @if( $nmensagens > 0 ) <span class="badge badge-danger">{{$nmensagens}}</span> @endif
                  </a>
                </li>
                <li class="@if( request()->is('dash/comprador/meu-88market*') )active @endif">
                  <a href="{{route('sistema.dash.comprador.rfqs')}}"><div class="icon-menu"><i class="fas fa-bullhorn"></i></i></div> 
                    Meu 88 Market

                    @if($novaMsgRfqPanelComprador)
                  <i class="fas fa-circle text-red"></i>
                 @endif

                  </a>
                  </li>
                <li class="@if( request()->is('dash/comprador/cotacoes*') )active @endif">
                  <a href="{{route('sistema.dash.comprador.cotacoes')}}">
                    <div class="icon-menu">
                      <i class="fas fa-dollar-sign"></i>
                    </div> Cotações @if( $ncotacoes > 0 ) <span class="badge badge-danger">{{$ncotacoes}}</span> @endif
                  </a>
                </li>
                <li class="@if( request()->is('dash/contatos*') )active @endif"><a href="{{route('sistema.dash.contatos')}}"><div class="icon-menu"><i class="fas fa-envelope"></i></div> Contatos</a></li>
                <li class="@if( request()->is('dash/comprador/interesses*') )active @endif"><a href="{{route('sistema.dash.interesses')}}"><div class="icon-menu"><i class="fas fa-th-list"></i></div> Lista de interesse</a></li>                                
            </ul>
          </nav>
        @endif
      </div>                    
  </div>
  @if($usuario->empresa->plano->valor == 0 )
    <div class="row">                   
      <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12">
          <a href="{{route('sistema.painel.plano')}}" class="link-upgrade-plano">Faça um upgrade<br/>do seu plano</a>
      </div>                    
    </div>
  @endif
  
</aside>           

<aside class="menu-painel margin-top-20 padding-top-15 padding-right-25 padding-left-25 relative xs-only">
  <div class="row margin-bottom-20 chave-vendedor-comprador">       
    <div class="col-6">
      <a href="{{route('sistema.dash.vendedor')}}"  @if( request()->is('dash/vendedor*') ) class="ativo" @endif>
        Vendedor
        @if( request()->is('dash/vendedor*') && ((int)$nmensagensV > 0 || (int)$ncotacoesV > 0) || $novaMsgRfqPanelVendedor)
          <i class="fas fa-circle text-red"></i>
        @endif
      </a>
      </div>             
      <div class="col-6">
          <a href="{{route('sistema.dash.comprador')}}"  @if( !request()->is('dash/vendedor*') ) class="ativo" @endif>
            Comprador
            @if( request()->is('dash/comprador*') && ((int)$nmensagensC > 0 || (int)$ncotacoesC > 0)  || $novaMsgRfqPanelComprador )
              <i class="fas fa-circle text-red"></i>
            @endif
          </a>
      </div>
  </div>

  <div class="row padding-bottom-20">                    
      <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 menu-lateral-panel">
        @if( request()->is('dash/vendedor*') )
       
          <nav>
            <ul class="menu">                            
                <li class="@if( request()->is('dash/vendedor') )active @endif"><a href="{{route('sistema.dash.vendedor')}}"><div class="icon-menu"><i class="fas fa-tachometer-alt"></i></div> Dash</a></li>
                <li class="@if( request()->is('dash/mensagens*') )active @endif">
                  <a href="{{route('sistema.dash.vendedor.mensagens')}}">
                    <div class="icon-menu">
                      <i class="fas fa-comments"></i>
                    </div> Mensagem                     
                   @if( $nmensagens > 0 ) <span class="badge badge-danger">{{$nmensagens}}</span> @endif
                  </a>
                </li>
                <li class="@if( request()->is('dash/vendedor/meu-88market*') )active @endif"><a href="{{route('sistema.dash.vendedor.rfqs')}}"><div class="icon-menu"><i class="fas fa-bullhorn"></i></i></div>                     
                  Meu 88 Market                
                 @if($novaMsgRfqPanelVendedor)
                  <i class="fas fa-circle text-red"></i>
                 @endif
               
                </a></li>
                <li class="@if( request()->is('dash/vendedor/cotacoes*') )active @endif">
                  <a href="{{route('sistema.dash.vendedor.cotacoes')}}">
                    <div class="icon-menu">
                      <i class="fas fa-dollar-sign"></i>
                    </div> Cotações @if( $ncotacoes > 0 ) <span class="badge badge-danger">{{$ncotacoes}}</span> @endif
                  </a>
                </li>
                <li class="@if( request()->is('dash/vendedor/contatos*') )active @endif"><a href="{{route('sistema.dash.vendedor.contatos')}}"><div class="icon-menu"><i class="fas fa-envelope"></i></div> Contatos</a></li>
                <li class="@if( request()->is('dash/vendedor/produto*') ||  request()->is('dash/vendedor/grupos*') ) active @endif">
                  <a href="{{route('sistema.dash.vendedor.produtos')}}"><div class="icon-menu"><i class="fas fa-th-list"></i></div> Meus produtos</a>
                  <ul class="sub">
                    <li>
                      <div class="coluna-sub-produtos">
                        <h3 class="text-center padding-bottom-15 padding-top-15">Meus produtos</h3>
                        <div class="row padding-left-15 padding-top-35">
                          <nav>
                            <ul>
                              <li><a href="{{route('sistema.dash.vendedor.produtos.novo')}}">Novo produto</a></li>
                              <li><a href="{{route('sistema.dash.vendedor.produtos')}}">Gerenciar produtos</a></li>
                              <li><a href="{{route('sistema.dash.vendedor.produtos.banco')}}">Banco de fotos</a></li>
                              <li><a href="{{route('sistema.dash.vendedor.produtos.grupos')}}">Personalizar grupo</a></li>
                            </ul>
                          </nav>
                        </div>
                      </div>
                    </li>
                  </ul>
                </li>
                <li  class="@if( request()->is('dash/vendedor/empresa*') ||  request()->is('dash/vendedor/website*') ||  request()->is('dash/vendedor/vitrine*') ) active @endif">
                  <a href="{{route('sistema.dash.vendedor.empresa')}}"><div class="icon-menu"><i class="fas fa-globe"></i></div> Empresa / Minisite</a>
                  <ul class="sub">
                    <li>
                      <div class="coluna-sub-produtos">
                        <h3 class="text-center padding-bottom-15 padding-top-15">Empresa / Minisite</h3>
                        <div class="row padding-left-15 padding-top-35">
                          <nav>
                            <ul>
                              <li><a href="{{route('sistema.dash.vendedor.empresa')}}">Informações da empresa</a></li>
                              <li><a href="{{route('sistema.dash.vendedor.website')}}">Meu Website</a></li>
                              <li><a @if( $usuario->empresa->plano->vitrine > 0 ) href="{{route('sistema.dash.vendedor.vitrine')}}" @else href="#" @endif>Vitrine</a></li>
                            </ul>
                          </nav>
                        </div>
                      </div>
                    </li>
                  </ul>
                </li>
            </ul>
          </nav>
        @else
          <nav>
            <ul class="menu">                            
                <li class="@if( request()->is('dash') )active @endif"><a href="{{route('sistema.dash.comprador')}}"><div class="icon-menu"><i class="fas fa-tachometer-alt"></i></div> Dash</a></li>
                <li class="@if( request()->is('dash/comprador/mensagens*') )active @endif">
                  <a href="{{route('sistema.dash.comprador.mensagens')}}">
                    <div class="icon-menu">
                      <i class="fas fa-comments"></i>
                    </div> Mensagem                   
                    @if( $nmensagens > 0 ) <span class="badge badge-danger">{{$nmensagens}}</span> @endif
                  </a>
                </li>
                <li class="@if( request()->is('dash/comprador/meu-88market*') )active @endif">
                  <a href="{{route('sistema.dash.comprador.rfqs')}}"><div class="icon-menu"><i class="fas fa-bullhorn"></i></i></div> 
                    Meu 88 Market

                    @if($novaMsgRfqPanelComprador)
                  <i class="fas fa-circle text-red"></i>
                 @endif

                  </a>
                  </li>
                <li class="@if( request()->is('dash/comprador/cotacoes*') )active @endif">
                  <a href="{{route('sistema.dash.comprador.cotacoes')}}">
                    <div class="icon-menu">
                      <i class="fas fa-dollar-sign"></i>
                    </div> Cotações @if( $ncotacoes > 0 ) <span class="badge badge-danger">{{$ncotacoes}}</span> @endif
                  </a>
                </li>
                <li class="@if( request()->is('dash/contatos*') )active @endif"><a href="{{route('sistema.dash.contatos')}}"><div class="icon-menu"><i class="fas fa-envelope"></i></div> Contatos</a></li>
                <li class="@if( request()->is('dash/comprador/interesses*') )active @endif"><a href="{{route('sistema.dash.interesses')}}"><div class="icon-menu"><i class="fas fa-th-list"></i></div> Lista de interesse</a></li>                                
            </ul>
          </nav>
        @endif
      </div>                    
  </div>
  @if($usuario->empresa->plano->valor == 0 )
    <div class="row">                   
      <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12">
          <a href="{{route('sistema.painel.plano')}}" class="link-upgrade-plano">Faça um upgrade<br/>do seu plano</a>
      </div>                    
    </div>
  @endif
  
</aside>  