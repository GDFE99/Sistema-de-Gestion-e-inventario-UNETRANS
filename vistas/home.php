<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .hero {
            position: relative;
            background-image: url("./img/UNETRANS.jpg");
            background-size: cover;
            background-position: center;
            padding-top: 3rem; /* Ajuste de la altura del hero */
            padding-bottom: 3rem; /* Ajuste de la altura del hero */
            color: #fff;
            text-align: center;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .hero-title {
            font-size: 4rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 2rem;
        }

        .cta-button {
            background-color: #3273dc;
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            padding: 1.5rem 3rem;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .cta-button:hover {
            background-color: #2765c4;
        }

        .feature-card {
            background-color: #fff;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #3273dc;
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .feature-description {
            font-size: 1.1rem;
            color: #6c757d;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 2rem;
            text-align: center;
            color: #363636;
        }

        .footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }
    </style>
</head>
<body>
    <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container">
                <h1 class="title hero-title" style="color: #fff;">
                    Bienvenido al Sistema de Gestión de Inventario del Dpto. de Electricidad
                </h1>
                <h3 class="subtitle hero-subtitle" style="color: #fff;">
                    Un lugar para gestionar de manera fácil, confiable y eficiente.
                </h3>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <h2 class="section-title">Características principales</h2>
            <div class="columns is-multiline">
                <div class="column is-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div class="feature-title">Gestión</div>
                        <div class="feature-description"> Crea, actualiza y elimina tus productos del inventario de manera intuitiva.</div>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <div class="feature-title">Auditoria</div>
                        <div class="feature-description"> Visualiza tu historial de manera eficiente, mantén el control del progreso de tus acciones.</div>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div class="feature-title">Préstamos</div>
                        <div class="feature-description">Administra los préstamos de productos a los diferentes profesores de manera ágil y organizada.</div>
                    </div>
                </div>
                <div class="column is-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="feature-title">Impresión y Visualización de PDF</div>
                        <div class="feature-description">Accede fácilmente a la descarga y consulta de los PDFs de los productos, préstamos y auditoria en el sistema de inventario.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p>© 2024 UNETRANS - Todos los Derechos Reservados.</p>
        </div>
    </footer>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>


