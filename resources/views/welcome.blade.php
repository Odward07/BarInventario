@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Software para gestion de invetario del bar mi primera borrachera</title>
    <link rel="stylesheet" href="../css/welcome.css">
</head>
<body>
    <div class="welcome-container">
        <div class="welcome-content">
            <h1>¡Bienvenido a BarApp!</h1>
            <p>Tu experiencia única comienza aquí.</p>
            <button onclick="location.href='/login'" class="login-btn">Iniciar Sesión</button>
        </div>
    </div>
</body>
@endsection
