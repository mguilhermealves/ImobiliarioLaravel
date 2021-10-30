@forelse( $grupos as $grupo )
  <tr class="text-16-pt grupo" data-grupo="{{$grupo->nome}}">
      <td>
          <div class="md-checkbox">
            <div class="row vertical-middle">
              <input data-url="{{route('sistema.dash.vendedor.produtos.grupos.exibir', [$usuario->empresa->id, $grupo->id])}}" id="exibe-{{ $grupo->id }}" class="exibe-site" data-id="{{$grupo->id}}" type="checkbox" @if( $grupo->exibir == 1 ) checked @endif />
              <label for="exibe-{{ $grupo->id }}" class="text-navy padding-left-10 medium">Exibir?</label>
            </div>
          </div>
      </td>

      <td>
          <a href="#s" class="subs" data-id="{{$grupo->id}}"> @if( $grupo->subs->count() > 0 ) <i class="fas fa-arrow-down"></i> @endif {{$grupo->nome}} ({{$grupo->produtos->count()}})</a>
      </td>

      <td>
          <a href="#b" class="btn-sub" data-id="{{$grupo->id}}" data-grupo="{{$grupo->nome}}" data-post="{{route('sistema.dash.vendedor.produtos.grupo.sub.adicionar', [$usuario->empresa->id, $grupo->id])}}" data-put="{{route('sistema.dash.vendedor.produtos.grupo.sub.salvar', [$usuario->empresa->id, $grupo->id])}}">Adicionar subgrupo ({{$grupo->subs->count()}})</a>
      </td>

      <td class="center">
          <a href="#" data-url="{{route('sistema.dash.vendedor.produtos.grupo', $grupo->id)}}" data-titulo="Editar grupo {{$grupo->nome}}"  data-nome="{{$grupo->nome}}"  data-post="{{route('sistema.dash.vendedor.produtos.grupos.adicionar', $usuario->empresa->id)}}" data-put="{{route('sistema.dash.vendedor.produtos.grupos.salvar', $usuario->empresa->id)}}" class="edit btn-editar">
              <i class="fas fa-edit text-gray"></i>
          </a>

           <a href="#" class="delete btn-apagar" data-url="{{route('sistema.dash.vendedor.produtos.grupos.apagar', [$usuario->empresa->id, $grupo->id])}}"> 
              <i class="far fa-trash-alt text-red"></i>
           </a> 
      </td>

      <td class="center">
          <a href="javascript:;" data-fancybox data-type="iframe" data-src="{{route('sistema.dash.vendedor.produtos.grupo.vinculados', [$usuario->empresa->id, $grupo->id])}}"  class="btn-gerenciar-produtos">
              <i class="fas fa-edit text-gray"></i>
          </a>
      </td>

      <td class="center">
         <a href="javascript:;" data-fancybox data-type="iframe" data-src="{{route('sistema.dash.vendedor.produtos.grupo.destacados', [$usuario->empresa->id, $grupo->id])}}"  class="btn-gerenciar-destaques"> 
            <i class="fas fa-edit text-gray"></i>
          </a> 
      </td>
  </tr>
    @forelse( $grupo->subs as $sub )
      <tr class="sub_{{$grupo->id}} hidden text-14-pt">
        <td class="center"></td>
        <td class="center text-12-pt text-yellow bold">{{$sub->nome}} ({{$sub->produtos->count()}})</td>
        <td class="center">
        </td>
        <td class="center">
          <a href="#" data-url="{{route('sistema.dash.vendedor.produtos.subgrupo', [$usuario->empresa->id, $sub->id])}}" data-nome="{{$sub->nome}}" data-titulo="Editar Subgrupo" data-post="" data-put="{{route('sistema.dash.vendedor.produtos.subgrupos.salvar', [$usuario->empresa->id, $sub->id])}}" class="edit btn-editar">
            <i class="fas fa-edit text-gray"></i>
          </a>
           <a href="#" class="delete btn-apagar" data-url="{{route('sistema.dash.vendedor.produtos.grupos.apagar', [$usuario->empresa->id, $grupo->id, $sub->id])}}"> 
              <i class="far fa-trash-alt text-red"></i>
           </a> 
        </td>
        <td class="center">
          <a href="javascript:;" data-fancybox data-type="iframe" data-src="{{route('sistema.dash.vendedor.produtos.grupo.vinculados', [$usuario->empresa->id, $grupo->id, $sub->id])}}" class="btn-gerenciar-produtos">
            <i class="fas fa-edit text-gray"></i>
          </a>
        </td>
      </tr>
    @empty
    @endforelse
@empty
@endforelse
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/flat/blue.css">
  <script src="{{assets('backend/plugins/iCheck/icheck.min.js')}}"></script>
  <script>
    $(document).ready(function(){
      $('input').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
      });
    })
  </script>