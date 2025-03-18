<?php
require_once "./php/main.php";

/*== Almacenando datos ==*/
$usuario = limpiar_cadena($_POST['login_usuario']);
$clave = limpiar_cadena($_POST['login_clave']);

/*== Verificando campos obligatorios ==*/
if($usuario == "" || $clave == ""){
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            No has llenado todos los campos que son obligatorios.
        </div>
    ';
    exit();
}

/*== Verificando integridad de los datos ==*/
if(verificar_datos("[a-zA-Z0-9]{4,20}", $usuario)){
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            El USUARIO no coincide con el formato solicitado.
        </div>
    ';
    exit();
}

if(verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $clave)){
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            La CLAVE no coincide con el formato solicitado.
        </div>
    ';
    exit();
}

try {
    $conexion = conexion();
    $check_user = $conexion->query("SELECT * FROM usuario WHERE usuario_usuario='$usuario'");

    if($check_user->rowCount() == 1){
        $check_user = $check_user->fetch();

        if($check_user['usuario_usuario'] == $usuario && password_verify($clave, $check_user['usuario_clave'])) {
            $_SESSION['id'] = $check_user['usuario_id'];
            $_SESSION['nombre'] = $check_user['usuario_nombre'];
            $_SESSION['apellido'] = $check_user['usuario_apellido'];
            $_SESSION['usuario'] = $check_user['usuario_usuario'];

            // Registrar evento de inicio de sesión en la tabla de auditoría
            $evento = "Inicio de sesión";
            $detalle = "Usuario: " . $check_user['usuario_usuario'] . " inició sesión.";
            $consultaAuditoria = $conexion->prepare("INSERT INTO auditoria (usuario_id, usuario_usuario, tabla_afectada, operacion, detalle, fecha) VALUES (:usuario_id, :usuario_usuario, 'usuarios', :operacion, :detalle, NOW())");
            $consultaAuditoria->bindParam(':usuario_id', $check_user['usuario_id']);
            $consultaAuditoria->bindParam(':usuario_usuario', $check_user['usuario_usuario']);
            $consultaAuditoria->bindParam(':operacion', $evento);
            $consultaAuditoria->bindParam(':detalle', $detalle);
            $consultaAuditoria->execute();

            // Verificar si el usuario es administrador
            if ($check_user['is_admin'] == '1') {
                $_SESSION['is_admin'] = '1';
                if (headers_sent()) {
                    echo "<script> window.location.href='index.php?vista=home_admin'; </script>";
                } else {
                    header("Location: index.php?vista=home_admin");
                }
            } elseif ($check_user['is_admin'] == '2') {
                $_SESSION['is_admin'] = '2';
                if (headers_sent()) {
                    echo "<script> window.location.href='index.php?vista=home_sadmin'; </script>";
                } else {
                    header("Location: index.php?vista=home_sadmin");
                }
            } else {
                $_SESSION['is_admin'] = '0';
                if (headers_sent()) {
                    echo "<script> window.location.href='index.php?vista=home'; </script>";
                } else {
                    header("Location: index.php?vista=home");
                }
            }
        } else {
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    Usuario o clave incorrectos.
                </div>
            ';
        }
    } else {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                Usuario o clave incorrectos.
            </div>
        ';
    }
} catch (Exception $e) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            ' . $e->getMessage() . '
        </div>
    ';
} finally {
    $conexion = null;
}
?>
