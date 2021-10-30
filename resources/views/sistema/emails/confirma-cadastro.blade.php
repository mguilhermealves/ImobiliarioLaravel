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
  Obrigado por se cadastrar em nosso site.
  <br>
  Para completar seu cadastro, por favor, clique <a href="{{route('sistema.auth.confirmar', [$obj->id, $obj->confirmation_token])}}">aqui</a>
  <br>
  <br>
  Att;
  <br>
  Equipe 88 Markets

</body>
</html>