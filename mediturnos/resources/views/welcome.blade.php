<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediTurnos - Tu Salud al Alcance</title>
    <style>
        /* Variables de colores para mantener un diseño coherente */
        :root {
            --primary-color: #2563eb;
            --secondary-color: #dbeafe;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --white: #ffffff;
        }

        /* Estilos generales */
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8fafc;
            color: var(--text-dark);
        }

        /* Barra de navegación */
        header {
            background-color: var(--white);
            padding: 1rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--primary-color);
            text-decoration: none;
            letter-spacing: -0.5px;
        }

        .btn-login {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 14px 0 rgba(37, 99, 235, 0.39);
        }

        .btn-login:hover {
            background-color: #1d4ed8;
            transform: translateY(-2px);
        }

        /* Sección de Introducción (Hero) */
        .hero {
            text-align: center;
            padding: 5rem 2rem;
            background: linear-gradient(135deg, #eff6ff 0%, #bfdbfe 100%);
            border-bottom: 1px solid #e2e8f0;
        }

        .hero h1 {
            font-size: 3rem;
            color: #1e3a8a;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.2rem;
            color: #334155;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* Sección Quiénes Somos */
        .about-section {
            padding: 4rem 5%;
            display: flex;
            justify-content: center;
        }

        .about-card {
            background: var(--white);
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
            max-width: 800px;
            text-align: center;
        }

        .section-title {
            font-size: 2.2rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            margin-top: 0;
        }

        .about-card p {
            font-size: 1.1rem;
            color: var(--text-light);
            line-height: 1.8;
            margin: 0;
        }

        /* Sección Objetivos */
        .objectives-section {
            padding: 2rem 5% 5rem;
            text-align: center;
        }

        .objectives-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            max-width: 1100px;
            margin: 2rem auto 0;
        }

        .objective-card {
            background: var(--white);
            padding: 2.5rem 1.5rem;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-top: 4px solid var(--primary-color);
        }

        .objective-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .objective-card h3 {
            color: var(--text-dark);
            margin-bottom: 1rem;
            font-size: 1.3rem;
        }

        .objective-card p {
            color: var(--text-light);
            line-height: 1.6;
            margin: 0;
        }
    </style>
</head>
<body>

    <!-- Navegación -->
    <header>
        <a href="#" class="logo">MediTurnos</a>
        <!-- Este botón redirige al formulario azul de login que ya tienes -->
        <a href="{{ route('login') }}" class="btn-login">Iniciar Sesión</a>
    </header>

    <!-- Introducción -->
    <section class="hero">
        <h1>Tu Salud, Sin Complicaciones</h1>
        <p>Una plataforma moderna diseñada para conectar a los pacientes con los mejores especialistas de forma rápida, segura y 100% digital.</p>
    </section>

    <!-- Quiénes Somos -->
    <section class="about-section">
        <div class="about-card">
            <h2 class="section-title">¿Quiénes Somos?</h2>
            <p>
                En <strong>MediTurnos</strong>, somos un equipo apasionado por la innovación tecnológica aplicada al sector salud. Nacimos con la firme convicción de que el acceso a la atención médica debe ser ágil y humano. Facilitamos el puente entre los profesionales de la salud y los pacientes, eliminando las largas filas y los procesos burocráticos mediante una herramienta digital intuitiva y accesible para todos.
            </p>
        </div>
    </section>

    <!-- Objetivos -->
    <section class="objectives-section">
        <h2 class="section-title">Nuestros Objetivos</h2>
        <div class="objectives-grid">
            
            <div class="objective-card">
                <div class="icon">⏱️</div>
                <h3>Agilizar la Atención</h3>
                <p>Reducir significativamente los tiempos de espera, permitiendo a los pacientes gestionar sus citas las 24 horas del día, los 7 días de la semana.</p>
            </div>

            <div class="objective-card">
                <div class="icon">🤝</div>
                <h3>Mejorar la Conexión</h3>
                <p>Establecer un canal de comunicación directo y eficiente entre los especialistas médicos y sus pacientes, mejorando el seguimiento clínico.</p>
            </div>

            <div class="objective-card">
                <div class="icon">🛡️</div>
                <h3>Gestión Segura</h3>
                <p>Garantizar la máxima privacidad y seguridad de los datos médicos e historiales, utilizando un sistema robusto y encriptado.</p>
            </div>

        </div>
    </section>

</body>
</html>