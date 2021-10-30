@extends('sistema.layouts.dash')
@section('content')
<link rel="stylesheet" href="{{assets('sistema/css/dash/website.css')}}">

<section class="meu-website">
  
  <div class="row">     
    
    <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 padding-bottom-50">
      <div class="row padding-left-30 padding-top-20  padding-bottom-20 titulo-fundo-cinza">
        <h2>Meu Website</h2>
      </div>
      
      
      <div class="row padding-left-30 padding-right-30 padding-top-20">                              
        <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12 formulario-empresa">
          <div class="row">                                    
            <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12">
              <h3>Edite seu website</h3>
            </div>                                                                        
          </div>
          <div class="row margin-top-20 text-gray text-16-pt">
              <p class="light">Personalize abaixo as informações que irão aparecer no Website da sua empresa que será vinculado ao 88 Markets de acordo com o seu plano de anúncio escolhido.</p>                                    
          </div>
          <div class="row padding-top-30">                                    
            <div class="col-xs-3 col-sm-3 col-lg-3 col-lg-3">
              <label>Banner principal</label>
            </div>                                    
          </div>
          <div class="row margin-top-5">
            <a href="#p" class="text-10-pt banner-padrao" data-src="{{assets('sistema/images/dash/banner-padrao.png')}}">(Usar banner padrão)</a>
          </div>
          <form data-action="{{route('sistema.dash.vendedor.website.salvar')}}" class="form-normal">
            <div class="row padding-top-30">                                    
              <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12">
                <h3>PREVIEW DO BANNER (1200x235)</h3>
                <div class="banner-preview">
                  <img class="img-editor imagem fr-fil fr-dib" src="{{ optional($website)->banner ?? assets('sistema/images/dash/banner-padrao.png')}}" alt="Imagem"/>
                  <input type="hidden" name="banner" value="{{optional($website)->banner ?? assets('sistema/images/dash/banner-padrao.png')}}" class="url-imagem" id="banner">
                </div>
              </div>                                                                        
            </div>
            
            <div class="row padding-top-30">                                    
              <div class="col-xs-12 col-sm-12 col-lg-12 col-lg-12">
                <h3>Grupos em destaque</h3>    
              </div>                                                                                                  
            </div>
            
            <div class="row padding-top-30">                                                                    
              <div class="col-xs-3 col-sm-3 col-lg-3 col-lg-3 padding-right-10">
                <label>Grupo em destaque 1</label>
              </div>                                      
              <div class="col-xs-3 col-sm-3 col-lg-3 col-lg-3">
                {!! Form::select('grupo1', [null => 'Selecione'] + $grupos, $website->grupo1 ?? null, ['class' => 'form-control select2 grupo1']) !!}
              </div>                                                                                                                                                                           
            </div>
            
            <div class="row padding-top-30">                                                                    
              <div class="col-xs-3 col-sm-3 col-lg-3 col-lg-3 padding-right-10">
                <label>Grupo em destaque 2</label>
              </div>                                      
              <div class="col-xs-3 col-sm-3 col-lg-3 col-lg-3">
                {!! Form::select('grupo2', [null => 'Selecione'] + $grupos, $website->grupo2 ?? null, ['class' => 'form-control select2 grupo2']) !!}
              </div>                                                                                                                                                                           
            </div>
            
            <div class="row padding-top-30">                                                                    
              <div class="col-xs-3 col-sm-3 col-lg-3 col-lg-3 padding-right-10">
                <label>Grupo em destaque 3</label>
              </div>                                      
              <div class="col-xs-3 col-sm-3 col-lg-3 col-lg-3">
                {!! Form::select('grupo3', [null => 'Selecione'] + $grupos, $website->grupo3 ?? null, ['class' => 'form-control select2 grupo3']) !!}
              </div>                                                                                                                                                                           
            </div>
            
            <div class="row padding-top-30">                                                                    
              <div class="col-xs-3 col-sm-3 col-lg-3 col-lg-3 padding-right-10">
                <label>Grupo em destaque 4</label>
              </div>                                      
              <div class="col-xs-3 col-sm-3 col-lg-3 col-lg-3">
                {!! Form::select('grupo4', [null => 'Selecione'] + $grupos, $website->grupo4 ?? null, ['class' => 'form-control select2 grupo4']) !!}
              </div>                                                                                                                                                                           
            </div>
            
            <div class="row padding-top-30">                                                                    
              <div class="col-xs-3 col-sm-3 col-lg-3 col-lg-3 padding-right-10">
                <label>Grupo em destaque 5</label>
              </div>                                      
              <div class="col-xs-3 col-sm-3 col-lg-3 col-lg-3">
                {!! Form::select('grupo5', [null => 'Selecione'] + $grupos, $website->grupo5 ?? null, ['class' => 'form-control select2 grupo5']) !!}
              </div>                                                                                                                                                                           
            </div>
            
            <div class="row padding-top-30">                                    
              <div class="col-lg-6">
                <button type="submit" class="roboto text-white text-18-pt bold toupper button-yellow">Salvar</button>
              </div>
              <div class="col-lg-6 horizontal-right vertical-middle">
                <a href="{{route('sistema.fornecedor', $website->empresa->slug)}}" target="_new" class="roboto text-white text-18-pt bold toupper button-yellow">Ver o Site</a>
              </div>
            </div>
          </form>
        </div>                                
      </div>
      
    </div>
  </div>
  
</section>

@endsection

@section('scripts')
  <script type="text/javascript" src="{{assets('backend/plugins/froala/js/froala_editor.pkgd.min.js')}}"></script>
  <script type="text/javascript" src="{{assets('backend/plugins/froala/js/languages/pt_br.js')}}"></script>
  <link href="{{assets('backend/plugins/froala/css/froala_editor.pkgd.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{assets('backend/plugins/froala/css/froala_style.min.css')}}" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="{{assets('node_modules/sweetalert2/dist/sweetalert2.css')}}">
  <script src="{{assets('node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
  <script src="{{assets('sistema/js/dash/vendedor/empresa.js')}}"></script>
@endsection