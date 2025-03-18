<div class="container">
    <h1 class="title has-text-centered">Productos</h1>
    <h2 class="subtitle has-text-centered">Nuevo producto</h2>
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
</div>
<div class="container pb-6 pt-6 has-text-centered">
<?php
        require_once "./php/main.php";
    ?>
    <div class="form-rest mb-6 mt-6"></div>
    <form action="./php/producto_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data">
        <div class="columns">
            <div class="column">
                <div class="control">
                    <label>Código</label>
                    <input class="input" type="text" name="producto_codigo" pattern="[a-zA-Z0-9- ]{1,70}" maxlength="70" required>
                </div>
            </div>
            <div class="column">
                <div class="control">
                    <label>Nombre</label>
                    <input class="input" type="text" name="producto_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}" maxlength="70" required>
                </div>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <div class="control">
                    <label>Stock</label>
                    <input class="input" type="text" name="producto_stock" pattern="[0-9]{1,25}" maxlength="25" required>
                </div>
            </div>
            <div class="column">
                <label>Foto o imagen del producto</label><br>
                <div class="file is-small has-name">
                    <label class="file-label">
                        <input class="file-input" type="file" name="producto_foto" accept=".jpg, .png, .jpeg">
                        <span class="file-cta">
                            <span class="file-label">Imagen</span>
                        </span>
                        <span class="file-name">JPG, JPEG, PNG. (MAX 3MB)</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <label>Categoría</label><br>
                <div class="select is-rounded">
                    <select name="producto_categoria">
                        <option value="" selected>Seleccione una opción</option>
                        <?php
                            $categorias = conexion();
                            $categorias = $categorias->query("SELECT * FROM categoria");
                            if ($categorias->rowCount() > 0) {
                                $categorias = $categorias->fetchAll();
                                foreach ($categorias as $row) {
                                    echo '<option value="' . $row['categoria_id'] . '">' . $row['categoria_nombre'] . '</option>';
                                }
                            }
                            $categorias = null;
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <p class="has-text-centered">
            <button type="submit" class="button is-info is-rounded">Guardar</button>
        </p>
    </form>
</div>

<script>
    document.getElementById('codigoFormato').addEventListener('change', function() {
        const formatoSeleccionado = this.value;
        const inputCodigo = document.getElementById('productoCodigo');
        inputCodigo.value = formatoSeleccionado;
        inputCodigo.setAttribute('pattern', `[a-zA-Z]-[0-9]{1,25}`);
    });
</script>
