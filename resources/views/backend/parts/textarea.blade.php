<div class="col-lg-{{$params->width}} form-group">
  <label for="nome">{{$params->title}}</label>
  <textarea class="form-control @if( $params->editor == true ) editor @endif" placeholder="Escreva aqui..." name="{{$field}}">{{$value}}</textarea>
</div>