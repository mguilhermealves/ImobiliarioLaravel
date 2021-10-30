<div class="container-fluid padding-top-70 padding-bottom-90 cursos-palestras">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Cursos e <b>palestras</b></h2>
            </div>
        </div>
        <div class="row margin-top-30 cursos-palestras-listagem lista-palestras">
            @foreach($palestras as $palestra)
                <div class="col-lg-12 padding-left-10 padding-right-10 ">
                    <div class="row">
                        <div class="row box-palestra-listagem">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-12 imagem">
                                        <img src="{{$palestra->imagem1}}" />
                                    </div>
                                </div>
                                <div class="row title-box">
                                    <div class="col-lg-12 padding-left-25 padding-right-25">
                                        <span>{{ $palestra->tipo == 0 ? "Curso" : "Palestra" }}</span>
                                        <br/><br/>
                                        <h2>{{$palestra->titulo}}</h2>
                                    </div>
                                </div>
                                <div class="row margin-top-75 padding-bottom-40 text-box">
                                    <div class="col-lg-12 padding-left-35 padding-right-35">
                                        <p>{!!$palestra->resumo!!}</p>
                                        <br/><br/>
                                        <a href="{{route('sistema.cursos-detalhes',['slug'=>$palestra->slug])}}"><img src="{{assets('site/images/icon-leia-mais.png')}}" class="margin-right-10"> Leia mais</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-lg-12 box-palestra">
                            <span>27<br/>
                                <b>AGO</b></span>
                            <div class="row">
                                <div class="col-lg-12 imagem-palestra">
                                    <div class="col-lg-12 imagem">
                                        <img src="{{$palestra->imagem1}}" />
                                    </div>
                                </div>
                            </div>                        
                            <div class="row">
                                <div class="col-lg-12 padding-top-30 padding-bottom-45 padding-left-30 padding-right-30">
                                    <h3>{{$palestra->titulo}}</h3>
                                    {!!$palestra->resumo!!}
                                        <a href="{{route('sistema.cursos-detalhes',['slug'=>$palestra->slug])}}"><img src="{{assets('site/images/icon-leia-mais.png')}}" class="margin-right-10"> Leia mais</a>
                                </div>
                            </div>
                        </div> --}}
                    </div>                      
                </div>
            @endforeach                        
        </div>
    </div>
</div>