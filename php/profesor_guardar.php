<?php
require_once "main.php";

require_once "../inc/session_start.php";


if (isset($_SESSION['id'])) {
    $usuario_autenticado_id = $_SESSION['id']; // ID del usuario autenticado

    // Obtener el nombre del usuario autenticado desde la base de datos
    $conexion = conexion(); // Función para establecer la conexión a la base de datos
    $consulta_usuario_autenticado = $conexion->prepare("SELECT usuario_nombre FROM usuario WHERE usuario_id = :id");
    $consulta_usuario_autenticado->execute([':id' => $usuario_autenticado_id]);

    if ($consulta_usuario_autenticado->rowCount() == 1) {
        $datos_usuario_autenticado = $consulta_usuario_autenticado->fetch(PDO::FETCH_ASSOC);
        $usuario_autenticado_nombre = $datos_usuario_autenticado['usuario_nombre'];
    }
}


// Obtener valores del formulario
$nombre = limpiar_cadena($_POST['profesor_nombre']);
$apellido = limpiar_cadena($_POST['profesor_apellido']);
$departamento = limpiar_cadena($_POST['profesor_departamento']);
$cargo = limpiar_cadena($_POST['profesor_cargo']);
$cedula = limpiar_cadena($_POST['profesor_cedula']); // Nueva línea para capturar la cédula

// Validar campos requeridos
if (empty($nombre) || empty($apellido) || empty($departamento) || empty($cargo) || empty($cedula)) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            Debes completar todos los campos obligatorios
        </div>
    ';
    exit();
}

// Validar datos ingresados
if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $nombre) || verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $apellido) || verificar_datos("[a-zA-Z0-9]{3,50}", $departamento) || verificar_datos("[a-zA-Z0-9]{3,50}", $cargo)) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            Verifica los datos ingresados
        </div>
    ';
    exit();

}

$consulta_cedula_existente = conexion()->prepare("SELECT * FROM profesores WHERE profesor_cedula = :cedula");
$consulta_cedula_existente->execute([':cedula' => $cedula]);
if ($consulta_cedula_existente->rowCount() > 0) {
    // La cédula ya existe, muestra un mensaje de error
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Error!</strong><br>
            La cédula ingresada ya está registrada en la base de datos
        </div>
    ';
    exit(); // Detener la ejecución del script
}




// Insertar el nuevo profesor en la base de datos
$guardar_profesor = conexion()->prepare("INSERT INTO profesores (profesor_nombre, profesor_apellido, profesor_departamento, profesor_cargo, profesor_cedula,usuario_id) VALUES (:nombre, :apellido, :departamento, :cargo, :cedula, :usuario)");

$marcadores = [
    ":nombre" => $nombre,
    ":apellido" => $apellido,
    ":departamento" => $departamento,
    ":cargo" => $cargo,
    ":cedula" => $cedula,
    ":usuario"=>$_SESSION['id']

];

$guardar_profesor->execute($marcadores);

// Verificar el resultado de la inserción
if ($guardar_profesor->rowCount() == 1) {
    // Éxito al registrar
$detalle = "Profesor registrado. Nombre: $nombre";
    registrarAuditoria(conexion(), $_SESSION['id'], $_SESSION['nombre'], 'profesor', 'INSERT', $detalle);
    echo '
        <div class="notification is-info is-light">
            <strong>¡Profesor registrado!</strong><br>
            El profesor se ha registrado exitosamente
        </div>
    ';
} else {
    // Error al registrar
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            No se pudo registrar al profesor, por favor inténtalo nuevamente
        </div>
    ';
}


// Cerrar conexión
$guardar_profesor = null;
