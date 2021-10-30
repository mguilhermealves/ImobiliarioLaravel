<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  Olá <b>{{$obj->nome}}</b>!
  <br>  
  <br>
  Foi solicitada uma recuperação de senha para este usuário.
  <br>
  Para definir uma nova senha, por favor, clique <a href="{{route('sistema.auth.nova-senha', [$obj->id, $obj->reset_token])}}">aqui</a>
  <br>
  <br>
  Att;
  <br>
  Equipe 88 Market

</body>
</html>