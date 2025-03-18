<div class="container">
    <h1 class="title has-text-centered">Categorías</h1>
    <h2 class="subtitle has-text-centered">Actualizar categoría</h2>
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

        .select,
        .input,
        .button {
            margin-bottom: 10px;
        }
    </style>
</div>

<div class="container pb-6 pt-6">
    <?php
    include "./inc/btn_back.php";
    require_once "./php/main.php";

    $id = (isset($_GET['category_id_up'])) ? $_GET['category_id_up'] : 0;
    $id = limpiar_cadena($id);

    // Verificar si la categoría existe
    $check_categoria = conexion()->prepare("SELECT * FROM categoria WHERE categoria_id = :id");
    $check_categoria->execute([':id' => $id]);

    if ($check_categoria->rowCount() > 0) {
        $datos = $check_categoria->fetch();
    ?>

    <div class="form-rest mb-6 mt-6"></div>

    <form action="./php/categoria_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off">
        <input type="hidden" name="categoria_id" value="<?php echo $datos['categoria_id']; ?>" required>

        <div class="columns">
            <div class="column">
                <div class="control">
                    <label>Nombre</label>
                    <input class="input" type="text" name="categoria_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}" maxlength="50" required value="<?php echo isset($datos['categoria_nombre']) ? $datos['categoria_nombre'] : ''; ?>">
                </div>
            </div>
            <div class="column">
                <div class="control">
                    <label>Ubicación</label>
                    <input class="input" type="text" name="categoria_ubicacion" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{5,150}" maxlength="150" value="<?php echo isset($datos['categoria_ubicacion']) ? $datos['categoria_ubicacion'] : ''; ?>">
                </div>
            </div>
        </div>
        <p class="has-text-centered">
            <button type="submit" class="button is-success is-rounded">Actualizar</button>
        </p>
    </form>

    <?php 
        // Verificar y enviar mensaje al log si los datos son válidos
        if (isset($datos['categoria_nombre']) && isset($datos['categoria_ubicacion'])) {
            $nombre = $datos['categoria_nombre'];
            $ubicacion = $datos['categoria_ubicacion'];
            $mensaje = "Se actualizo la categoria con ID: '$id', Nombre: '$nombre', Ubicacion: '$ubicacion'";
            escribirLog($mensaje);
        }
    ?>

    <?php } else {
        include "./inc/error_alert.php";
    } ?>
</div>
