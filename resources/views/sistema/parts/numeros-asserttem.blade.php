<div class="container-fluid padding-bottom-50 padding-top-40 secao-numeros">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Números <b>Asserttem</b></h2>
            </div>
        </div>

        <div class="row xs-gone">
          @foreach($numeros as $num)
              @foreach($num as $k=>$v)
                  <div class="col-lg-3 padding-10">
                      <div class="row">
                          <div class="col-lg-12 text-center padding-right-40 padding-left-40 padding-top-20 padding-bottom-20 box-numeros">
                             <span>{{$v['numero']}}</span>
                              <br/><br/>
                              <p>{!!$v['texto']!!}</p>
                          </div>
                      </div>                        
                  </div>
          @endforeach 
         @endforeach  
        </div>

        <div class="row lista-numeros xs-only">
            @foreach($numeros as $num)
                @foreach($num as $k=>$v)
                    <div class="col-lg-12 padding-10">
                        <div class="row">
                            <div class="col-lg-12 text-center padding-right-40 padding-left-40 padding-top-20 padding-bottom-20 box-numeros">
                               <span>{{$v['numero']}}</span>
                                <br/><br/>
                                <p>{!!$v['texto']!!}</p>
                            </div>
                        </div>                        
                    </div>
            @endforeach 
           @endforeach  
          </div>

    </div>
</div>