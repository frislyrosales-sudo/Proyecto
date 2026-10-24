<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediTurnos - Gestión de Citas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">MediTurnos</a>
            <div class="navbar-nav">
                <a class="nav-link" href="{{ route('citas.index') }}">Citas</a>
                <a class="nav-link" href="{{ route('pacientes.index') }}">Pacientes</a>
                <a class="nav-link" href="{{ route('medicos.index') }}">Médicos</a>
                <a class="nav-link" href="{{ route('especialidades.index') }}">Especialidades</a>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('ok'))
            <div class="alert alert-success">{{ session('ok') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger fw-bold">
                Error, debe de completar todas las casillas.
            </div>
        @endif

        @yield('contenido')
    </div>
</body>
</html>

