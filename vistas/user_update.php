	<?php
		require_once "./php/main.php";
		$id = (isset($_GET['user_id_up'])) ? $_GET['user_id_up'] : 0;
		$id = limpiar_cadena($id);
		
	?>

	<div class="container">
		<?php if($id == $_SESSION['id']) { ?>
			<h1 class="title has-text-centered">Mi cuenta</h1>
			<h2 class="subtitle has-text-centered">Actualizar datos de cuenta</h2>
		<?php } else { ?>
			<h1 class="title">Usuarios</h1>
			<h2 class="subtitle">Actualizar usuario</h2>
		<?php } ?>
	</div>

	<div class="container pb-6 pt-6 has-text-centered">
		<?php
			include "./inc/btn_back.php";

			/*== Verificando usuario ==*/
			$check_usuario = conexion();
			$check_usuario = $check_usuario->query("SELECT * FROM usuario WHERE usuario_id = '$id'");
			if ($check_usuario->rowCount() > 0) {
				$datos = $check_usuario->fetch();
		?>

		<div class="form-rest mb-6 mt-6"></div>
		<form action="./php/usuario_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off">
			<input type="hidden" name="usuario_id" value="<?php echo $datos['usuario_id']; ?>" required>

			<style>
		 .container {
            max-width: 800px;
            margin: 20px auto; /* Margen automático para centrar el contenedor */
            padding: 20px;
            background-color: #FFFFFF; /* Fondo blanco para el contenedor */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F4F4F4; /* Color de fondo para toda la página */
            text-align: center; /* Centra el texto en el cuerpo de la página */
        }

			.form-rest {
				max-width: 500px;
				margin: 0 auto;
			}

			.select, .input, .button {
				margin-bottom: 10px;
			}
		</style>
			
			<div class="columns">
				<div class="column">
					<div class="control">
						<label>Nombres</label>
						<input class="input" type="text" name="usuario_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required value="<?php echo $datos['usuario_nombre']; ?>">
					</div>
				</div>
				<div class="column">
					<div class="control">
						<label>Apellidos</label>
						<input class="input" type="text" name="usuario_apellido" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required value="<?php echo $datos['usuario_apellido']; ?>">
					</div>
				</div>
			

			
				<div class="column">
					<div class="control">
						<label>Usuario</label>
						<input class="input" type="text" name="usuario_usuario" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required value="<?php echo $datos['usuario_usuario']; ?>">
					</div>
				</div>
				<div class="column">
					<div class="control">
						<label>Email</label>
						<input class="input" type="email" name="usuario_email" maxlength="70" value="<?php echo $datos['usuario_email']; ?>">
					</div>
				</div>
				<div class="column">
					<label>Departamento</label>
					<select class="input" name="usuario_departamento" maxlength="70" placeholder="Departamento">
										<!-- Opciones de A-1 a A-12 -->
										<option disabled selected>Seleccionar Departamento</option>
											<option value="Electronica">Electronica</option>
											<option value="Telecomunicaciones">Telecomunicaciones</option>
											<option value="Electricidad Industrial y Potencia">Electricidad Industrial y Potencia</option>
											<option value="Instrumentación y Control">Instrumentación y Control</option>
										</optgroup>
						
									</select>
								</div>
			</div>
			<div class="columns">
    <div class="column">
        <div class="control">
            <label>Pregunta 1</label>
            <select class="input" name="pregunta1" required>
                <option value="¿Color Favorito?">¿Color Favorito?</option>
                <option value="¿Cuándo es tu cumpleaños?">¿Cuándo es tu cumpleaños?</option>
                <option value="¿Ciudad de nacimiento?">¿Ciudad de nacimiento?</option>
                <option value="¿Nombre de tu mascota?">¿Nombre de tu mascota?</option>
                <option value="¿Nombre de tu primer colegio?">¿Nombre de tu primer colegio?</option>
            </select>
            <input class="input" type="text" name="respuesta1" placeholder="Respuesta a la Pregunta 1">
        </div>
    </div>
    <div class="column">
        <div class="control">
            <label>Pregunta 2</label>
            <select class="input" name="pregunta2" required>
                <option value="¿Color Favorito?">¿Color Favorito?</option>
                <option value="¿Cuándo es tu cumpleaños?">¿Cuándo es tu cumpleaños?</option>
                <option value="¿Ciudad de nacimiento?">¿Ciudad de nacimiento?</option>
                <option value="¿Nombre de tu mascota?">¿Nombre de tu mascota?</option>
                <option value="¿Nombre de tu primer colegio?">¿Nombre de tu primer colegio?</option>
            </select>
            <input class="input" type="text" name="respuesta2" placeholder="Respuesta a la Pregunta 2">
        </div>
    </div>
</div>

			<div class="columns">
				<div class="column">
					<div class="control">
						<label>Clave</label>
						<input class="input" type="password" name="usuario_clave_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100">
					</div>
				</div>
				<div class="column">
					<div class="control">
						<label>Repetir clave</label>
						<input class="input" type="password" name="usuario_clave_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100">
					</div>
				</div>
			</div>

			<br><br>
			<p class="has-text-centered">
				Si desea actualizar la clave de este usuario, por favor llene los 2 campos. Si NO desea actualizar la clave, deje los campos vacíos.
			</p>
			<br>


			<div class="modal" id="myModal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Ingresar Usuario y Clave</h2>
        <form id="formAdmin" method="POST" action="procesar.php">
            <label for="administrador_usuario">Usuario:</label>
            <input type="text" id="administrador_usuario" name="administrador_usuario" required><br><br>
            <label for="administrador_clave">Clave:</label>
            <input type="password" id="administrador_clave" name="administrador_clave" required><br><br>
            <input type="hidden" id="usuario_id" name="usuario_id" value="<?php echo $id; ?>">
            <input type="submit" value="Actualizar">
        </form>
    </div>
</div>


			<p class="has-text-centered">
				<button id="actualizarBtn" class= "button is-success is-rounded" type="button">Actualizar</button>
			</p>
		</form>

		<?php 
			}else{
				include "./inc/error_alert.php";
			}
			$check_usuario = null;
		?>
	</div>

	<script>
		// Mostrar el modal cuando se haga clic en el botón de "Actualizar"
		document.getElementById("actualizarBtn").addEventListener("click", function() {
			document.getElementById("myModal").style.display = "block";
		});

		// Cerrar el modal cuando se haga clic en la "X" o fuera del modal
		var closeBtn = document.getElementsByClassName("close")[0];
		closeBtn.addEventListener("click", function() {
			document.getElementById("myModal").style.display = "none";
		});

		window.addEventListener("click", function(event) {
			if (event.target == document.getElementById("myModal")) {
				document.getElementById("myModal").style.display = "none";
			}
		});
	</script>

