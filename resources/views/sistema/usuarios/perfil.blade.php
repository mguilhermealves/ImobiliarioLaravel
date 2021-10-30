@extends('sistema.layouts.interno')
@section('content')
<link rel="stylesheet" href="{{assets('sistema/css/painel/perfil.css')}}">

<section class="meu-perfil">

  <section class="informacoes">
    <div class="container">
      <div class="row">
        <div class="col-10">
          <div class="row">
            <h3 class="tajawal text-black text-26-pt bold">Informações do usuário</h3>
          </div>
        </div>
      </div>
      <div class="row divisor"></div>
        <div class="row margin-top-30">
          <div class="col-2">
            <div class="row imagem vertical-middle horizontal-center">
                <img class="img-editor imagem" src="{{ $user->imagem ?? assets('sistema/images/avatar.png')}}" alt="Imagem"/>
            </div>
          </div>
          <div class="col-10 padding-left-25">
            <div class="row margin-top-10">
              <h3 class="text-blue text-24-pt medium">{{$user->nome}} {{$user->sobrenome}}</h3>
            </div>
            <div class="row margin-top-10" style="background-color: #e6e5e6; height: 1px"></div>
            <div class="row margin-top-25 text-gray text-16-pt regular">
              <div class="col-lg-6">
                <div class="row">
                  <span class="bold padding-right-10">Entrou em:</span>
                  {{$user->created_at->format('Y')}}
                </div>
              </div>
              <div class="col-lg-6">
                <div class="row horizontal-right">
                  <span class="bold padding-right-10">Telefone:</span>
                  {{$user->telefone}}
                </div>
              </div>
            </div>
            <div class="row margin-top-25 text-gray text-16-pt regular">
              <div class="col-lg-6">
                <div class="row">
                  <span class="bold padding-right-10">E-mail:</span>
                  {{$user->email}}
                </div>
              </div>
              <div class="col-lg-6">
                <div class="row horizontal-right">
                  <span class="bold padding-right-10">Celular:</span>
                  {{$user->celular}}
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </section>

  <section class="informacoes-empresa margin-top-100 padding-bottom-100">
    <div class="container">
      <div class="row">
        <div class="col-10">
          <div class="row">
            <h3 class="tajawal text-black text-26-pt bold">Informações da empresa</h3>
          </div>
        </div>
      </div>
      <div class="row divisor"></div>
        <div class="row margin-top-40 formulario flex-column">
          <div class="row">
            <div class="col-12">
              <label for="" class="tajawal text-black text-20-pt bold">Nome da empresa</label>
              <h6 class="text-navy">{{$user->empresa->nome}}</h6>
            </div>
          </div>
          <div class="row margin-top-20">
            <div class="col-3">
              <label for="" class="tajawal text-black text-20-pt bold">CNPJ</label>
              <h6 class="text-navy">{{$user->empresa->cnpj}}</h6>
            </div>
            <div class="col-3">
              <label for="" class="tajawal text-black text-20-pt bold">Telefone</label>
              <h6 class="text-navy">{{$user->empresa->telefone}}</h6>
            </div>
            <div class="col-3">
              <label for="" class="tajawal text-black text-20-pt bold">E-mail</label>
              <h6 class="text-navy">{{$user->empresa->email}}</h6>
            </div>
            <div class="col-3">
              <label for="" class="tajawal text-black text-20-pt bold">Tipo de empresa</label>
              <h6 class="text-navy">{{$user->empresa->tipoTag}}</h6>
            </div>
          </div>
          <div class="row margin-top-20">
            <div class="col-3">
              <label for="" class="tajawal text-black text-20-pt bold">Website</label>
              <h6 class="text-navy">{{$user->empresa->site}}</h6>
            </div>
          </div>
          <div class="row padding-top-30 endereco">
            <div class="col-lg-2 padding-right-10">
              <label class="tajawal text-black text-20-pt bold">CEP:</label>
              <h6 class="text-navy">{{$user->empresa->cep}}</h6>
            </div>
            <div class="col-lg-8 padding-right-10">
              <label class="tajawal text-black text-20-pt bold">Logradouro:</label>
              <h6 class="text-navy">{{$user->empresa->logradouro}}</h6>
            </div>
            <div class="col-lg-2">
              <label class="tajawal text-black text-20-pt bold">Número:</label>
              <h6 class="text-navy">{{$user->empresa->numero}}</h6>
            </div>
            <div class="col-lg-3 padding-top-30 padding-right-10">
              <label class="tajawal text-black text-20-pt bold">Complemento:</label>
              <h6 class="text-navy">{{$user->empresa->complemento}}</h6>
            </div>
            <div class="col-lg-4 padding-top-30 padding-right-10">
              <label class="tajawal text-black text-20-pt bold">Bairro:</label>
              <h6 class="text-navy">{{$user->empresa->bairro}}</h6>
            </div>
            <div class="col-lg-3 padding-top-30 padding-right-10">
              <label class="tajawal text-black text-20-pt bold">Cidade:</label>
              <h6 class="text-navy">{{$user->empresa->cidade}}</h6>
            </div>
            <div class="col-lg-2 padding-top-30">
              <label class="tajawal text-black text-20-pt bold">UF:</label>
              <h6 class="text-navy">{{ $user->empresa->uf }}</h6>
            </div>
          </div>
          <div class="row margin-top-30" style="background-color: #e6e5e6; height: 1px"></div>
          <div class="row margin-top-30">
            <label for="" class="tajawal text-black text-20-pt bold">Produtos</label>
          </div>
          <div class="row">
            <div class="col-3 padding-right-5">
              <h6 class="text-navy">{{$user->empresa->produto1}}</h6>
            </div>
            <div class="col-3 padding-right-5 padding-left-5">
              <h6 class="text-navy">{{$user->empresa->produto2}}</h6>
            </div>
            <div class="col-3 padding-right-5 padding-left-5">
              <h6 class="text-navy"> {{$user->empresa->produto3}}</h6>
            </div>
            <div class="col-3 padding-left-5">
              <h6 class="text-navy">{{$user->empresa->produto4}}</h6>
            </div>
          </div>
        </div>
    </div>
  </section>

</section>

@endsection

@section('scripts')
@endsection