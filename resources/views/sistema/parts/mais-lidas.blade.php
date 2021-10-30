<div class="row">
    <div class="col-lg-12 topo-mais-lidas">
        <img src="{{assets('site/images/oab-image.png')}}" />
        <h3>+<br/>Mais lidas</h3>
    </div>
</div>


@foreach($maislidas as $maislida)
<div class="row margin-top-60 xs-margin-top-30 box-mais-lida padding-left-30 xs-padding-left-0 box-mais-lida">
    <div class="col-lg-5 padding-top-10 padding-right-10">
        <div class="imagem">
            <img src="{{$maislida->imagem}}" />
        </div>       
    </div>
    <div class="col-lg-7 padding-top-5">
        <a href="{{route('sistema.noticia',['slug'=>$maislida->slug])}}">
            <span>  {{dateBdToApp($noticia->data)}} às {{timeBdToApp($noticia->data)}} </span>
            <h4>{{$maislida->titulo}}</h4>
        </a>
    </div>
</div>
@endforeach


<div class="row margin-top-25">
    <div class="col-lg-12 text-center">
        <a href="{{route('sistema.noticias')}}" class="mais-publi">Mais publicações</a>
    </div>
</div>