<div class="col-lg-{{$params->width}} form-group">
  <label for="nome">{{$params->title}}</label>
  <br>
  @php
    if( $params->src == 'array' ){
      $data = $params->data;
    }else{
      $data = $cms::getListToSelect($params->data, $params->show);
    }
  @endphp
  {!! Form::select($field, $data, null, ['multiple' => true, 'class' => 'form-control select2 multi']) !!}
</div>