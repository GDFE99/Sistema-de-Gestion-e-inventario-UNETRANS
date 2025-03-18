<?php
require_once "main.php";

require_once "../inc/session_start.php";

// Verificar si se recibieron datos por POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener los datos del formulario
    $nombre = limpiar_cadena($_POST['categoria_nombre']);
    $ubicacion = limpiar_cadena($_POST['categoria_ubicacion']);

    // Verificar si el campo nombre está vacío
    if ($nombre == "") {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Error!</strong> Debes completar el nombre de la categoría.
            </div>
        ';
        exit();
    }

    // Validar el formato del nombre
    if (!preg_match("/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}$/", $nombre)) {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Error!</strong> El nombre no cumple con el formato requerido.
            </div>
        ';
        exit();
    }

    // Validar el formato de la ubicación si se proporcionó
    if ($ubicacion != "" && !preg_match("/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{5,150}$/", $ubicacion)) {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Error!</strong> La ubicación no cumple con el formato requerido.
            </div>
        ';
        exit();
    }

    // Verificar si el nombre de la categoría ya existe en la base de datos
    $conexion = conexion();
    $check_nombre = $conexion->prepare("SELECT categoria_nombre FROM categoria WHERE categoria_nombre = :nombre");
    $check_nombre->execute([':nombre' => $nombre]);

    if ($check_nombre->rowCount() > 0) {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Error!</strong> El nombre de la categoría ya está registrado.
            </div>
        ';
        exit();
    }

    // Insertar la nueva categoría en la base de datos
    $guardar_categoria = $conexion->prepare("INSERT INTO categoria (categoria_nombre, categoria_ubicacion) VALUES (:nombre, :ubicacion)");
    $guardar_categoria->execute([':nombre' => $nombre, ':ubicacion' => $ubicacion]);

    if ($guardar_categoria->rowCount() == 1) {
        $categoria_id = $conexion->lastInsertId();

        // Registrar evento en la auditoría
        $detalle = "Categoría creada. Nombre: $nombre, Ubicación: $ubicacion";
        registrarAuditoria($conexion, $_SESSION['id'], $_SESSION['nombre'], 'categoria', 'INSERT', $detalle);

        echo '
            <div class="notification is-success is-light">
                <strong>¡Éxito!</strong> La categoría se ha registrado correctamente.
            </div>
        ';
    } else {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Error!</strong> Ocurrió un problema al registrar la categoría. Inténtalo de nuevo.
            </div>
        ';
    }
}
?>
