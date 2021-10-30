<div class="col-lg-{{$params->width}} form-group">
  <label for="nome">{{$params->title}}</label>
  <br>
  @php
    if( $params->src == 'array' ){
      $data = $params->data;
    }else{
      $data = $cms::getListToSelect($params->data, $params->show);
    }
    $class = '';
    if( $params->city && $params->city == true){
      $class = 'city';
    }
  @endphp
  {!! Form::select($field, [null => 'Selecione uma opção'] + $data, '', ['class' => 'form-control select2 ' . $class, 'data-model' => $params->model?? '' ]) !!}
</div>