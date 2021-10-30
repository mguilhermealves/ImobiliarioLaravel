<div class="col-lg-2 produto-wrapper margin-top-20 margin-bottom-20" data-nome="{{$produto->nome}}">
  <div class="row">
    <div class="col-11 produto-dash center-block padding-10 relative padding-bottom-15">
      <div class="row imagem horizontal-center vertical-middle">
        <img src="{{$produto->principal}}" alt="">
      </div>
      <div class="row padding-15 horizontal-center text-center">
        <p class="roboto text-blue text-14-pt medium">{{$produto->nome}}</p>
      </div>
      <div class="row margin-top-10 vertical-middle">
        <input type="checkbox" class="form-control selecionar" value="{{$produto->id}}" name="vincular[]" id="seleciona_{{$produto->id}}">
        <label for="seleciona_{{$produto->id}}" class="text-gray text-12-pt semibold padding-left-10">Selecionar</label>
      </div>
    </div>
  </div>
</div>