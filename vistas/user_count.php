<?php
require_once "./php/main.php";

// Obtener el ID de usuario de la URL
$id = isset($_GET['user_id_up']) ? limpiar_cadena($_GET['user_id_up']) : 0;

// Validar el ID de usuario antes de continuar
if (!is_numeric($id) || $id <= 0) {
    include "./inc/error_alert.php";
    exit(); // Detener la ejecución si el ID de usuario no es válido
}

$check_usuario = conexion()->prepare("SELECT * FROM usuario WHERE usuario_id = :id");
$check_usuario->bindParam(':id', $id);
$check_usuario->execute();

if ($check_usuario->rowCount() > 0) {
    $datos = $check_usuario->fetch();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F4F4F4;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #FFFFFF;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-rest {
            max-width: 500px;
            margin: 0 auto;
        }

        .select, .input, .button {
            margin-bottom: 10px;
        }
    </style>
    <link rel="stylesheet" href="../css/bulma.min.css">
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
<div class="container">
    <div class="form-header">
        <h1 class="title has-text-centered">Detalles del Usuario</h1>
    </div>
    <div class="columns">
        <div class="column is-half">
            <div class="control">
                <label class="label">Nombres:</label>
                <input class="input" type="text" value="<?= htmlspecialchars($datos['usuario_nombre']) ?>" readonly>
            </div>
            <div class="control">
                <label class="label">Apellidos:</label>
                <input class="input" type="text" value="<?= htmlspecialchars($datos['usuario_apellido']) ?>" readonly>
            </div>
            <div class="control">
                <label class="label">Usuario:</label>
                <input class="input" type="text" value="<?= htmlspecialchars($datos['usuario_usuario']) ?>" readonly>
            </div>
            <div class="control">
                <label class="label">Email:</label>
                <input class="input" type="email" value="<?= htmlspecialchars($datos['usuario_email']) ?>" readonly>
            </div>
            <div class="control">
                <label class="label">Departamento:</label>
                <input class="input" type="text" value="<?= htmlspecialchars($datos['usuario_departamento']) ?>" readonly>
            </div>
        </div>
    </div>

    <div class="button-container">
        <button class="button is-info" onclick="mostrarModal()">Restablecer Clave</button>
        <button class="button is-warning" onclick="mostrarModalPreguntas()">Restablecer Preguntas</button>
    </div>

    <!-- Modal para restablecer la clave -->
    <div class="modal" id="myModal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal()">&times;</span>
            <h2>Restablecer Clave</h2>
            <form action="./php/restablecer_clave.php" method="POST">
                <input type="hidden" name="usuario_id" value="<?= htmlspecialchars($datos['usuario_id']) ?>">
                <div class="control">
                    <label class="label">Nueva Clave:</label>
                    <input class="input" type="password" name="nueva_clave" required>
                </div>
                <div class="control">
                    <label class="label">Repetir Clave:</label>
                    <input class="input" type="password" name="confirmar_clave" required>
                </div>
                <div class="button-container">
                    <button class="button is-success" type="submit">Guardar Clave</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal para restablecer las preguntas -->
    <div class="modal" id="myModalPreguntas">
        <div class="modal-content">
            <span class="close" onclick="cerrarModalPreguntas()">&times;</span>
            <h2>Restablecer Preguntas</h2>
            
            <form action="./php/restablecer_preguntas.php" method="POST">
            <input type="hidden" name="usuario_id" value="<?= htmlspecialchars($datos['usuario_id']) ?>">

                <div class="columns">
                    <div class="column">
                        <div class="control">
                            <label>Pregunta 1</label>
                            <select class="input" name="pregunta1" required>
                                <option disabled selected value="">Selecciona una pregunta</option>
                                <option value="Color Favorito">¿Color Favorito?</option>
                                <option value="Cuándo es tu cumpleaños">¿Cuándo es tu cumpleaños?</option>
                                <option value="Ciudad de nacimiento">¿Ciudad de nacimiento?</option>
                                <option value="Nombre de tu mascota">¿Nombre de tu mascota?</option>
                                <option value="Nombre de tu primer colegio">¿Nombre de tu primer colegio?</option>
                            </select>
                            <input class="input" type="text" name="respuesta1" placeholder="Respuesta a la Pregunta 1" required>
                        </div>
                    </div>
                    <div class="column">
                        <div class="control">
                            <label>Pregunta 2</label>
                            <select class="input" name="pregunta2" required>
                                <option disabled selected value="">Selecciona una pregunta</option>
                                <option value="Color Favorito">¿Color Favorito?</option>
                                <option value="Cuándo es tu cumpleaños">¿Cuándo es tu cumpleaños?</option>
                                <option value="Ciudad de nacimiento">¿Ciudad de nacimiento?</option>
                                <option value="Nombre de tu mascota">¿Nombre de tu mascota?</option>
                                <option value="Nombre de tu primer colegio">¿Nombre de tu primer colegio?</option>
                            </select>
                            <input class="input" type="text" name="respuesta2" placeholder="Respuesta a la Pregunta 2" required>
                        </div>
                    </div>
                </div>
                <div class="button-container">
                    <button class="button is-success" type="submit">Guardar Preguntas</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function mostrarModal() {
        document.getElementById("myModal").style.display = "block";
    }

    function cerrarModal() {
        document.getElementById("myModal").style.display = "none";
    }

    function mostrarModalPreguntas() {
        document.getElementById("myModalPreguntas").style.display = "block";
    }

    function cerrarModalPreguntas() {
        document.getElementById("myModalPreguntas").style.display = "none";
    }
</script>

</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const pregunta1Select = document.querySelector('select[name="pregunta1"]');
        const pregunta2Select = document.querySelector('select[name="pregunta2"]');

        pregunta1Select.addEventListener('change', function() {
            const selectedOptionValue = pregunta1Select.value;
            for (let i = 0; i < pregunta2Select.options.length; i++) {
                if (pregunta2Select.options[i].value === selectedOptionValue) {
                    pregunta2Select.options[i].disabled = true;
                } else {
                    pregunta2Select.options[i].disabled = false;
                }
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const formClave = document.querySelector('form[action="./php/restablecer_clave.php"]');
        const nuevaClaveInput = formClave.querySelector('input[name="nueva_clave"]');
        
        formClave.addEventListener('submit', function(event) {
            const nuevaClaveValue = nuevaClaveInput.value;
            const regexCaracterEspecial = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
            const regexMayuscula = /[A-Z]/;
            
            if (!regexCaracterEspecial.test(nuevaClaveValue) || !regexMayuscula.test(nuevaClaveValue)) {
                event.preventDefault(); // Evitar el envío del formulario
                alert('La clave debe contener al menos un carácter especial y una letra mayúscula.');
            }
        });
    });
</script>
</html>

<?php
} else {
    include "./inc/error_alert.php";
}
$check_usuario = null;
?>

