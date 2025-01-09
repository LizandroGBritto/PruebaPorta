<!DOCTYPE html>
<html>
<head>
    <title>¡Te extrañamos!</title>
</head>
<body>
    <h1>Hola, {{ $user->name }}</h1>
    <p>No has iniciado sesión en nuestra plataforma desde hace más de 30 días. ¡Te invitamos a regresar y explorar todo lo que tenemos para ti!</p>
    <p><a href="{{ url('/login') }}">Haz clic aquí para iniciar sesión</a></p>
    <p>Saludos,<br>El equipo de {{ config('app.name') }}</p>
</body>
</html>
