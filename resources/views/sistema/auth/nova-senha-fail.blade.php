@extends('sistema.layouts.interno')
@section('content')
    <main id="login" class="page margin-bottom-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 form center-block">
                    <form data-action="{{ route('sistema.auth.senha') }}" class="form-normal formulario">
                        <div class="form-group">
                            <label for="user" class="tajawal text-black text-20-pt bold">E-mail:</label>
                            <input type="email" id="user" name="email" class="form-control" required />
                        </div>

                        <div class="button horizontal-center margin-top-20">
                            <input type="submit" class="roboto text-white text-18-pt bold toupper button-yellow" value="recuperar senha" />
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </main>
@stop

@section('scripts')
  <link href="{{ assets('sistema/css/auth/login.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="{{assets('node_modules/sweetalert2/dist/sweetalert2.css')}}">
  <script src="{{assets('plugins/js/mask.js')}}"></script>
  <script src="{{assets('plugins/js/masks.js')}}"></script>
  <script src="{{assets('node_modules/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>
@endsection