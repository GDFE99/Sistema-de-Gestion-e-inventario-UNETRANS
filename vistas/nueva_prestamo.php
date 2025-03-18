<?php require_once "./php/main.php"; ?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=6.0">
    <title>Formulario de Préstamo</title>
    
    <style>
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #FFFFFF;
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
</head>
<body>
    <div class="container">
        <h1 class="title has-text-centered">Préstamos</h1>
        <h2 class="subtitle has-text-centered">Nuevo Préstamo</h2>
    </div>

        <div class="form-rest">
            <form action="./php/procesar_prestamo.php" method="POST">
                <!-- Aquí va tu formulario HTML -->
            </form>
    </div>
    <script>
        // Aquí va tu script JavaScript
    </script>
</body>
</html>


<div class="container pb-6 pt-6">
    <div class="form-rest mb-6 mt-6">
        <form action="./php/procesar_prestamo.php" method="POST">

        <div class="field is-horizontal">
    <div class="field-label is-normal">
        <label class="label">Producto</label>
    </div>
    <div class="field-body">
        <div class="field">
            <div class="control">
                <div class="select">
                    <select name="producto_id" onchange="mostrarCantidadDisponible(this)">
                        <option value="" selected>Seleccione un producto</option>
                        <?php
                        $producto = conexion();
                        $productos = $producto->query("SELECT * FROM producto");
                        if ($productos->rowCount() > 0) {
                            $productos = $productos->fetchAll();
                            foreach ($productos as $row) {
                                echo '<option value="' . $row['producto_id'] . '" data-cantidad="' . $row['producto_stock'] . '">' . $row['producto_nombre'] . '</option>';
                            }
                        }
                        $producto = null;
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="field">
            <div class="control">
                <input class="input" type="number" name="cantidad" placeholder="Cantidad">
            </div>
        </div>
        <div class="field">
            <p id="cantidad_seleccionada" class="is-size-7"></p>
        </div>
    </div>
</div>


            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Profesor</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <div class="select">
                                <select name="profesor_id">
                                    <option value="" selected>Seleccione un profesor</option>
                                    <?php
                                    $profesores = conexion()->query("SELECT * FROM profesores");
                                    if ($profesores->rowCount() > 0) {
                                        $profesores = $profesores->fetchAll();
                                        foreach ($profesores as $profesor) {
                                            echo '<option value="' . $profesor['profesor_id'] . '">' . $profesor['profesor_nombre'] . ' ' . $profesor['profesor_apellido'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
    <div class="field-label is-normal">
        <label class="label">Fecha de devolución</label>
    </div>
    <div class="field-body">
        <div class="field">
            <div class="control">
                <input class="input" type="date" name="fecha_devolucion" id="fecha_devolucion" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+1 month')); ?>">
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('fecha_devolucion').addEventListener('change', function() {
        var selectedDate = new Date(this.value);
        var maxDate = new Date();
        maxDate.setMonth(maxDate.getMonth() + 1);

        if (selectedDate > maxDate) {
            alert('La fecha de devolución no puede ser más de 1 mes después de la fecha actual');
            this.value = ''; // Limpiar el campo si la fecha no cumple con la restricción
        }
    });
</script>

            <div class="field is-horizontal">
                <div class="field-label"></div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <button type="submit" class="button is-info is-rounded">Solicitar préstamo</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>

<script>
    function mostrarCantidadDisponible(select) {
    console.log("Función ejecutada");
    var cantidadDisponible = select.options[select.selectedIndex].getAttribute('data-cantidad');
    console.log("Cantidad disponible:", cantidadDisponible);
    document.getElementById('cantidad_seleccionada').innerText = 'Cantidad disponible: ' + cantidadDisponible;
}

</script>


    