<div class="col-lg-{{$params->width}} form-group">
  <label for="nome">{{$params->title}}</label>
  @php
    $class = '';
    $model = '';
    if( $params->state && $params->state == true){
      $class = 'state';
    }
  @endphp
  {!! Form::select($field, [null => 'Selecione uma opção'] + $cms::getListToSelect($params->model, $params->show), null, ['class' => 'form-control select2 ' . $class, 'data-src' => $params->src ?? '', 'data-model' => $params->model ?? '', 'data-url' => $params->url ?? '' ]) !!}
</div>