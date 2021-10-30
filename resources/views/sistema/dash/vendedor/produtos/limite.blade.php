@extends('sistema.layouts.dash')
@section('content')
<link rel="stylesheet" href="{{assets('sistema/css/painel/perfil.css')}}">

<section class="novo-produto">

  <div class="row horizontal-center margin-top-50">
    <h3 class="text-orange text-20-pt bold">Você atingiu o limite de produtos do seu plano! Para cadastrar mais produtos, por favor, faça um upgrade.</h3>
  </div>
  <div class="row margin-top-20 horizontal-center">
    <a class="text-white text-14-pt regular toupper button-blue" href="{{route('sistema.planos')}}">ver planos</a>
  </div>
</section>
@endsection