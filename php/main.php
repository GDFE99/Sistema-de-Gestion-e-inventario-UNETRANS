<?php
	
	# Conexion a la base de datos #
	function conexion(){
		$pdo = new PDO('mysql:host=localhost;dbname=pdo', 'root', '');
		return $pdo;
	}


	# Verificar datos #
	function verificar_datos($filtro,$cadena){
		if(preg_match("/^".$filtro."$/", $cadena)){
			return false;
        }else{
            return true;
        }
	}

	


	# Limpiar cadenas de texto #
	function limpiar_cadena($cadena){
		$cadena=trim($cadena);
		$cadena=stripslashes($cadena);
		$cadena=str_ireplace("<script>", "", $cadena);
		$cadena=str_ireplace("</script>", "", $cadena);
		$cadena=str_ireplace("<script src", "", $cadena);
		$cadena=str_ireplace("<script type=", "", $cadena);
		$cadena=str_ireplace("SELECT * FROM", "", $cadena);
		$cadena=str_ireplace("DELETE FROM", "", $cadena);
		$cadena=str_ireplace("INSERT INTO", "", $cadena);
		$cadena=str_ireplace("DROP TABLE", "", $cadena);
		$cadena=str_ireplace("DROP DATABASE", "", $cadena);
		$cadena=str_ireplace("TRUNCATE TABLE", "", $cadena);
		$cadena=str_ireplace("SHOW TABLES;", "", $cadena);
		$cadena=str_ireplace("SHOW DATABASES;", "", $cadena);
		$cadena=str_ireplace("<?php", "", $cadena);
		$cadena=str_ireplace("?>", "", $cadena);
		$cadena=str_ireplace("--", "", $cadena);
		$cadena=str_ireplace("^", "", $cadena);
		$cadena=str_ireplace("<", "", $cadena);
		$cadena=str_ireplace("[", "", $cadena);
		$cadena=str_ireplace("]", "", $cadena);
		$cadena=str_ireplace("==", "", $cadena);
		$cadena=str_ireplace(";", "", $cadena);
		$cadena=str_ireplace("::", "", $cadena);
		$cadena=trim($cadena);
		$cadena=stripslashes($cadena);
		return $cadena;
	}


	# Funcion renombrar fotos #
	function renombrar_fotos($nombre){
		$nombre=str_ireplace(" ", "_", $nombre);
		$nombre=str_ireplace("/", "_", $nombre);
		$nombre=str_ireplace("#", "_", $nombre);
		$nombre=str_ireplace("-", "_", $nombre);
		$nombre=str_ireplace("$", "_", $nombre);
		$nombre=str_ireplace(".", "_", $nombre);
		$nombre=str_ireplace(",", "_", $nombre);
		$nombre=$nombre."_".rand(0,100);
		return $nombre;
	}


	# Funcion paginador de tablas #
	function paginador_tablas($pagina,$Npaginas,$url,$botones){
		$tabla='<nav class="pagination is-centered is-rounded" role="navigation" aria-label="pagination">';

		if($pagina<=1){
			$tabla.='
			<a class="pagination-previous is-disabled" disabled >Anterior</a>
			<ul class="pagination-list">';
		}else{
			$tabla.='
			<a class="pagination-previous" href="'.$url.($pagina-1).'" >Anterior</a>
			<ul class="pagination-list">
				<li><a class="pagination-link" href="'.$url.'1">1</a></li>
				<li><span class="pagination-ellipsis">&hellip;</span></li>
			';
		}

		$ci=0;
		for($i=$pagina; $i<=$Npaginas; $i++){
			if($ci>=$botones){
				break;
			}
			if($pagina==$i){
				$tabla.='<li><a class="pagination-link is-current" href="'.$url.$i.'">'.$i.'</a></li>';
			}else{
				$tabla.='<li><a class="pagination-link" href="'.$url.$i.'">'.$i.'</a></li>';
			}
			$ci++;
		}

		if($pagina==$Npaginas){
			$tabla.='
			</ul>
			<a class="pagination-next is-disabled" disabled >Siguiente</a>
			';
		}else{
			$tabla.='
				<li><span class="pagination-ellipsis">&hellip;</span></li>
				<li><a class="pagination-link" href="'.$url.$Npaginas.'">'.$Npaginas.'</a></li>
			</ul>
			<a class="pagination-next" href="'.$url.($pagina+1).'" >Siguiente</a>
			';
		}

		$tabla.='</nav>';
		return $tabla;
	}

	// En main.php

// Función para obtener el stock disponible de un producto dado
function obtenerStockDisponible($producto_id) {
    try {
        // Establecer la conexión a la base de datos
        $conexion = conexion();

        // Preparar la consulta para obtener el stock del producto
        $stmt = $conexion->prepare("SELECT producto_stock FROM producto WHERE producto_id = :producto_id");

        // Bind de parámetros
        $stmt->bindParam(':producto_id', $producto_id);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        // Devolver el stock disponible
        return $resultado['producto_stock'];
    } catch (PDOException $e) {
        // Manejo de errores
        echo "Error al obtener el stock del producto: " . $e->getMessage();
        return 0;
    }
}

function obtenerProductos() {
    $producto = conexion();
    $productos = $producto->query("SELECT * FROM producto");
    return $productos->fetchAll();
}

function obtenerProfesores() {
    return conexion()->query("SELECT * FROM profesores")->fetchAll();
} 


$servername = "localhost";
$username = "root";
$password = "";
$database = "pdo";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Crear el directorio de logs si no existe
$directorio_logs = 'logs';
if (!file_exists($directorio_logs)) {
    mkdir($directorio_logs, 0777, true); // Crear el directorio recursivamente
}
	function escribirLog($mensaje) {
		error_log("DEBUG: Llamada a escribirLog con mensaje: $mensaje");
		$archivo = 'logs/app.log'; // Ruta al archivo de logs
		$fecha = date('Y-m-d H:i:s'); // Fecha y hora actual

		// Formato del mensaje de log (fecha - mensaje)
		$mensajeFormateado = "[$fecha] $mensaje" . PHP_EOL;

		try {
			// Escribir el mensaje en el archivo de logs (modo append)
			if (!file_put_contents($archivo, $mensajeFormateado, FILE_APPEND)) {
				throw new Exception("Error al escribir en el archivo de logs: No se pudo escribir el mensaje.");
			}
		} catch (Exception $e) {
			// Manejar errores al escribir en el archivo de logs
			echo 'Error al escribir en el archivo de logs: ' . $e->getMessage();
		}
	}


	function registrarAuditoria($conexion, $usuario_id, $usuario_nombre, $tabla_afectada, $operacion, $detalle) {
        $consulta = $conexion->prepare("INSERT INTO auditoria (usuario_id, usuario_usuario, tabla_afectada, operacion, detalle) VALUES (:usuario_id, :usuario_usuario, :tabla_afectada, :operacion, :detalle)");
        $consulta->execute([
            ':usuario_id' => $usuario_id,
            ':usuario_usuario' => $usuario_nombre,
            ':tabla_afectada' => $tabla_afectada,
            ':operacion' => $operacion,
            ':detalle' => $detalle
        ]);
    }

	function obtenerNombreProfesor($profesor_id) {
		$conexion = conexion(); // Establece la conexión a la base de datos
	
		$consulta = $conexion->prepare("SELECT profesor_nombre FROM profesores WHERE profesor_id = :id");
		$consulta->execute([':id' => $profesor_id]);
	
		if ($consulta->rowCount() == 1) {
			$datos_categoria = $consulta->fetch(PDO::FETCH_ASSOC);
			return $datos_categoria['profesor_nombre'];
		}
	
		return false; // Devuelve false si no se encuentra la categoría
	}