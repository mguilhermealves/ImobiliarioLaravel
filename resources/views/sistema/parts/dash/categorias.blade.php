<div class="row pesquisadas">
  <div class="col-12 horizontal-right padding-bottom-20">
    <a href="#" class="btn btn-danger vertical-middle btn-fechar"><i class="fa fa-chevron-left padding-right-10"></i> Voltar para seleção</a>
  </div>
  <div class="box-category col-12">
      <div class="inner">
          <div class="scroll">
            @if( $grupos == null && $subs == null )
              <div class="alert alert-danger">Nenhum produto encontrado com os termos buscados!</div>
            @endif
              <ul class="categorias-pesquisadas">
                @if( $grupos != null )
                  @foreach( $grupos as $grupo )
                    <li data-categoria="{{$grupo->subcategoria->categoria->id}}" data-sub="{{$grupo->subcategoria->id}}" data-grupo="{{$grupo->id}}">{{$grupo->subcategoria->categoria->nome}} >> {{$grupo->subcategoria->nome}} >> {{$grupo->nome}}</li>
                  @endforeach
                @endif
                @if( $subs != null )
                  @foreach( $subs as $sub )
                    <li data-categoria="{{$sub->categoria->id}}" data-sub="{{$sub->id}}">{{$sub->categoria->nome}} >> {{$sub->nome}}</li>
                  @endforeach
                @endif
              </ul>
          </div>
      </div>
  </div>
</div>