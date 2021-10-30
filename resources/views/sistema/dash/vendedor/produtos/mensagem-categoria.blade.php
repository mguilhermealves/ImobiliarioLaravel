@extends('sistema.layouts.vazio')
@section('content')
<div class="padding-20">
  <div class="col-12">
    <div class="row horizontal-center roboto text-blue text-16-pt regular text-center">
        Conte-nos quais categorias estão faltando para que você possa fazer seu cadastro corretamente...
    </div>
  </div>
    <div class="row margin-top-20">
        <form data-action="{{route('sistema.dash.vendedor.produtos.categorias.mensagem.enviar')}}" class="form-normal formulario">
          <div class="row">
            <div class="col-12">
              <input type="text" class="form-control" name="nome" placeholder="Qual o seu nome?" value="{{$usuario->nome}}">
            </div>
            <div class="col-12 margin-top-30">
              <input type="email" class="form-control" name="email" placeholder="Qual o seu e-mail?" value="{{$usuario->email}}">
            </div>
            <div class="col-lg-6 col-12 margin-top-30">
              <input type="text" class="form-control telefone-input-mask" name="celular" placeholder="Qual seu celular?" value="{{$usuario->celular}}">
            </div>
            <div class="col-12 margin-top-30">
              <textarea name="mensagem" id="" cols="30" rows="10" placeholder="Qual a sua mensagem?"></textarea>
            </div>
          </div>
          <div class="row horizontal-center margin-top-20">
            <button type="submit" class="roboto text-white text-18-pt bold toupper button-yellow">Enviar mensagem</button>
          </div>
        </form>
    </div>
  </div>
@endsection

@section('scripts')
<style>
  @media( max-width: 450px ){
    .form-wrapper{
      padding: 15px !important;
    }
  }
  </style>
<script type="text/javascript">

  $(document).ready(function(){
    $('.tel-input-mask').mask("(99) 9999-99999");
  });
  </script>
  <script src="{{assets('plugins/js/mask.js')}}"></script>
  <script src="{{assets('plugins/js/masks.js')}}"></script>
@endsection