<div class="row margin-bottom-20">
    {!! Form::select('cidade_id', [null => '-- Filtre por Cidade --'] + $cidades, null, ['class' => 'form-control filtro-cidade']) !!}
</div>
@foreach($agencias as $agencia)
    <div class="row padding-bottom-25 agencia" data-cidade="@if( $agencia->cidades()->exists() ){{ $agencia->cidades->id }} @endif">
        <div class="col-lg-12">
            <h2>{{$agencia->empresa}}</h2>
            <h4>Associada desde: {{$agencia->desde}}</h4>
            <span><i class="fas fa-map-marker-alt padding-right-5 margin-top-5"></i>{{$agencia->endereco}}, {{$agencia->bairro}}</span><br/>
            <span class="padding-left-15">{{$agencia->cidadeCerta}} / {{$agencia->estado->Uf}}</span>
            <div class="row">
                <div class="col-12">
                    <p><i class="fas fa-phone-alt padding-right-5 margin-top-5"></i>
                        <b>{{$agencia->telefone1}}</b></p>
                </div>
            </div>
            <a href="{{$agencia->site}}" target="_blank">Acesse o site</a>
        </div>
    </div>
@endforeach


