<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  Olá!
  <br>  
  <br>
  Alguém solicitou uma <b>inclusão de categorias</b> em nosso sistema.
  <br>
  Abaixo, seguem os dados:
  <br>
  <br>
  <b>Nome:</b> {{$obj->nome}}
  <br>
  <b>E-mail:</b> {{$obj->email}}
  <br>
  <b>Celular:</b> {{$obj->celular}}
  <br>
  <b>Mensagem:</b> 
  <br>
  {!! $obj->mensagem !!}
  <br>
  <br>
  Att;
  <br>
  Sistema 88 Market

</body>
</html>