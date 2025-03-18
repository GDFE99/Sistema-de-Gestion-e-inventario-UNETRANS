<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profesores</title>
    
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
        <h1 class="title has-text-centered">Profesores</h1>
        <h2 class="subtitle has-text-centered">Nuevo Profesor</h2>
    </div>
        <div class="form-rest">
            <form action="./php/procesar_prestamo.php" method="POST">
                <!-- Aquí va tu formulario HTML -->
            </form>
        </div>
    </div>
    <script>
        // Aquí va tu script JavaScript
    </script>
</body>
</html>
<div class="container">
    <div class="form-rest mb-6 mt-6"></div>
    <form action="./php/profesor_guardar.php" method="POST" class="FormularioAjax" autocomplete="off">
        <div class="columns">
            <div class="column">
                <div class="control">
                    <label>Nombre</label>
                    <input class="input" type="text" name="profesor_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required placeholder="Nombre">
                </div>
            </div>
            <div class="column">
                <div class="control">
                    <label>Apellido</label>
                    <input class="input" type="text" name="profesor_apellido" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required placeholder="Apellido">
                </div>
            </div>
            <div class="column">
                <div class="control">
                    <label>Cedula</label>
                    <input class="input" type="number" name="profesor_cedula" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required placeholder="cedula">
                </div>
            </div>
        </div>
        <div class="columns">
        <div class="columns">
            <div class="column">
                <label>Departamento</label>
                         <select class= "input" name="profesor_departamento" maxlength="70" required placeholder="Departamento">
                                    <!-- Opciones de A-1 a A-12 -->
                                    <option disabled selected>Seleccionar Departamento</option>
                                        <option value="Electronica">Electronica</option>
                                        <option value="Telecomunicaciones">Telecomunicaciones</option>
                                        <option value="Electricidad">Electricidad</option>
                                        <option value="Instrumentacionycontrol">Instrumentación y Control</option>
                                    </optgroup>
                    
                                </select>
                            </div>
                          </div>
            </div>
            <div class="columns">
            <div class="column">
                <label>Cargo</label>
                <select class= "input" name="profesor_cargo" maxlength="70" required placeholder="Cargo">
                                    <!-- Opciones de A-1 a A-12 -->
                                    <option disabled selected>Seleccionar Cargo</option>
                                        <option value="Profesor">Profesor</option>
                                        <option value="Coordinador">Coordinador</option>
                                        <option value="JefedeDepartamento">Jefe de Departamento</option>
                                    </optgroup>
                    
                                </select>
                        </div>
                </div>
        </div>


        <p class="has-text-centered">
            <button type="submit" class="button is-info is-rounded">Guardar</button>
        </p>
    </form>
</div>
