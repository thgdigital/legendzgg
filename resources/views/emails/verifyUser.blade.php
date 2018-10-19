<!DOCTYPE html>
<html>
<head>
    <title>E-mail de boas vindas</title>
</head>
<body>
<h2>Bem vindo ao site {{$user['name']}}</h2>
<br/>
Seu e-mail registrado é {{$user['email']}} , Por favor, clique no link abaixo para verificar sua conta de e-mail
<br/>
<a href="{{url('jogador/verify', $user->verifyUser->token)}}">Verificar o e-mail</a>
</body>
</html>
