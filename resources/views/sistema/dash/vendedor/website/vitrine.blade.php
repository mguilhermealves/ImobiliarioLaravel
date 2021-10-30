@extends('sistema.layouts.dash')
@section('content')
<link rel="stylesheet" href="{{assets('sistema/css/dash/vitrine.css')}}">

<section class="vitrine">
  
  <div class="row">     
        
        <div class="col-12 padding-bottom-50">
          <div class="row padding-left-30 padding-top-20  padding-bottom-20 titulo-fundo-cinza">
            <h2>Vitrine</h2>
          </div>
          
          <div class="row padding-left-30 padding-right-30 padding-top-20">                              
            <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 formulario-empresa">
              <div class="row">                                    
                <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12">
                  <h3>Produtos na Vitrine ({{$vitrine->count()}})</h3>
                </div>                                                                        
              </div>
              
              <div class="row">                                    
                <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 lista-vitrine">
                  <ul>
                    @forelse( $vitrine as $produto )
                      <li class="item-vitrine">
                        <div class="imagem-produto"><img src="{{$produto->principal}}" alt=""></div>
                        <h4>{{$produto->nome}}</h4>
                        <a href="#" class="btn-apagar" data-url="{{route('sistema.dash.vendedor.vitrine.produtos.remover', [$usuario->empresa->id, $produto->id])}}" data-id="{{$produto->id}}">Remover da Vitrine</a>
                      </li>
                    @empty
                    @endforelse
                  </ul>
                </div>                                    
              </div>
              
              <div class="row padding-top-30">                                    
                <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12">
                  <a href="javascript:;" data-fancybox data-type="iframe" data-src="{{route('sistema.dash.vendedor.vitrine.produtos', [$usuario->empresa->id])}}"  class="roboto text-white text-18-pt bold toupper button-yellow"> 
                    selecionar produtos
                  </a>
                </div>                                    
              </div>
            </div>                                
          </div>                        
        </div>
      </div>                                                                                      
    
  
</section>

@endsection

@section('scripts')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
  <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
  <link rel="stylesheet" href="{{assets('node_modules/sweetalert2/dist/sweetalert2.css')}}">
  <script src="{{assets('node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
  <script>
    $(document).ready(function(){
      $(document).on('beforeClose.fb', function( e, instance, slide ) {
        window.location.reload();
      });
    })
  </script>
  <style>
    @media( min-width: 769px ){
      .fancybox-slide--iframe .fancybox-content {
        width  : auto;
        height : auto;
        max-width  : 80%;
        max-height : 100%;
        margin: 0;
        background: #191919;
      }
    }
  </style>
@endsection