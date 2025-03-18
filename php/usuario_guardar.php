        <?php
        
        require_once "main.php";

        require_once "../inc/session_start.php";

        /*== Almacenando datos ==*/
        $nombre = limpiar_cadena($_POST['usuario_nombre']);
        $nombre = ucfirst(strtolower($nombre)); // Convertir la primera letra en mayúscula
        $apellido = limpiar_cadena($_POST['usuario_apellido']);
        $usuario = limpiar_cadena($_POST['usuario_usuario']);
        $email = limpiar_cadena($_POST['usuario_email']);
        $cedula = limpiar_cadena($_POST['usuario_cedula']);
        $departamento = limpiar_cadena($_POST['usuario_departamento']);
        $clave_1 = limpiar_cadena($_POST['usuario_clave_1']);
        $clave_2 = limpiar_cadena($_POST['usuario_clave_2']);
        $pregunta1 = limpiar_cadena($_POST['pregunta1']);
        $pregunta2 = limpiar_cadena($_POST['pregunta2']);
        $respuesta1 = limpiar_cadena($_POST['respuesta1']);
    $respuesta2 = limpiar_cadena($_POST['respuesta2']);



        /*== Verificando campos obligatorios ==*/
        if($nombre=="" || $apellido=="" || $usuario=="" || $cedula=="" || $departamento=="" || $clave_1=="" || $clave_2==""){
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    No has llenado todos los campos que son obligatorios
                </div>
            ';
            exit();
        }


        /*== Verificando integridad de los datos ==*/
        if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$nombre)){
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    El NOMBRE no coincide con el formato solicitado
                </div>
            ';
            exit();
        }

        if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$apellido)){
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    El APELLIDO no coincide con el formato solicitado
                </div>
            ';
            exit();
        }

        if(verificar_datos("[a-zA-Z0-9]{4,20}",$usuario)){
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    El USUARIO no coincide con el formato solicitado
                </div>
            ';
            exit();
        }
        if(verificar_datos("[a-zA-Z0-9]{3,20}",$cedula)){
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    El USUARIO no coincide con el formato solicitado
                </div>
            ';
            exit();
        }
        if(verificar_datos("[a-zA-Z0-9]{3,50}",$departamento)){
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    El USUARIO no coincide con el formato solicitado
                </div>
            ';
            exit();    
        }
        if ($pregunta1 === $pregunta2) {
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    Las preguntas de seguridad no pueden ser iguales, por favor elija preguntas distintas
                </div>
            ';
            exit();
        }

        if($respuesta1 == "" || $respuesta2 == ""){
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    Las respuestas de seguridad son campos obligatorios
                </div>
            ';
            exit();
        }

    if (!preg_match('/[A-Z]/', $clave_1) || !preg_match('/[!@#$%^&*()\-_=+{};:,.<>?]/', $clave_1)) {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                La CLAVE debe contener al menos una letra mayúscula y un carácter especial (como !@#$%^&*()-_=+{};:,.<>?)
            </div>
        ';
        exit();
    }

    if ($clave_1 !== $clave_2) {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                Las CLAVES no coinciden
            </div>
        ';
        exit();
    }

    $check_cedula = conexion()->prepare("SELECT usuario_cedula FROM usuario WHERE usuario_cedula = :cedula");
$check_cedula->bindParam(':cedula', $cedula);
$check_cedula->execute();

if ($check_cedula->rowCount() > 0) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            La cédula ingresada ya se encuentra registrada
        </div>
    ';
    exit();
}


        /*== Verificando email ==*/
        if($email!=""){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                $check_email=conexion();
                $check_email=$check_email->query("SELECT usuario_email FROM usuario WHERE usuario_email='$email'");
                if($check_email->rowCount()>0){
                    echo '
                        <div class="notification is-danger is-light">
                            <strong>¡Ocurrio un error inesperado!</strong><br>
                            El correo electrónico ingresado ya se encuentra registrado, por favor elija otro
                        </div>
                    ';
                    exit();
                }
                $check_email=null;
            }else{
                echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        Ha ingresado un correo electrónico no valido
                    </div>
                ';
                exit();
            } 
        }



        /*== Verificando usuario ==*/
        $check_usuario=conexion();
        $check_usuario=$check_usuario->query("SELECT usuario_usuario FROM usuario WHERE usuario_usuario='$usuario'");
        if($check_usuario->rowCount()>0){
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    El USUARIO ingresado ya se encuentra registrado, por favor elija otro
                </div>
            ';
            exit();
        }
        $check_usuario=null;


        /*== Verificando claves ==*/
        if($clave_1!=$clave_2){
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    Las CLAVES que ha ingresado no coinciden
                </div>
            ';
            exit();
        }else{
            $clave=password_hash($clave_1,PASSWORD_BCRYPT,["cost"=>10]);
        }


        /*== Guardando datos ==*/
        /*== Guardando datos ==*/
        $guardar_usuario = conexion();
        $guardar_usuario = $guardar_usuario->prepare("INSERT INTO usuario(usuario_nombre, usuario_apellido, usuario_usuario, usuario_clave, usuario_email, usuario_cedula, usuario_departamento, pregunta1, pregunta2, respuesta1, respuesta2) VALUES(:nombre, :apellido, :usuario, :clave, :email, :cedula, :departamento, :pregunta1, :pregunta2, :respuesta1, :respuesta2)");
        $marcadores = [
            ":nombre" => $nombre,
            ":apellido" => $apellido,
            ":usuario" => $usuario,
            ":clave" => $clave,
            ":email" => $email,
            ":cedula" => $cedula,
            ":departamento" => $departamento,
            ":pregunta1" => $pregunta1,
            ":pregunta2" => $pregunta2,
            ":respuesta1" => $respuesta1,
            ":respuesta2" => $respuesta2
        ];
        $guardar_usuario->execute($marcadores);
    if($guardar_usuario->rowCount()==1){
        $detalle = "Usuario registrado. Usuario: $usuario";
    registrarAuditoria(conexion(), $_SESSION['id'], $_SESSION['nombre'], 'usuarios', 'INSERT', $detalle);
        echo '
            <div class="notification is-info is-light">
                <strong>¡USUARIO REGISTRADO!</strong><br>
                El usuario se registró con éxito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No se pudo registrar el usuario, por favor intente nuevamente
            </div>
        ';
    }
    $guardar_usuario=null;

