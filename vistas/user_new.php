    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulario de Usuario</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #F4F4F4; /* Color de fondo para toda la página */
                text-align: center; /* Centra el texto en el cuerpo de la página */
            }
            .container {
                max-width: 800px;
                margin: 20px auto; /* Margen automático para centrar el contenedor */
                padding: 20px;
                background-color: #FFFFFF; /* Fondo blanco para el contenedor */
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            .form-container {
                max-width: 800px;
                margin: 20px auto; /* Margen automático para centrar el contenedor del formulario */
                padding: 20px;
                background-color: #FFFFFF; /* Fondo blanco para el contenedor del formulario */
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                margin-bottom: 10px; /* Espacio en la parte inferior del formulario */
            }
            .form-rest {
                max-width: 500px;
                margin: 0 auto;
            }
            .select, .input, .button {
                margin-bottom: 5px;
                font-size: 14px;
                padding: 5px;
            }
            .control {
                margin-bottom: 10px;
            }
            .columns {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
            }
            .column {
                flex: 1;
                min-width: 200px;
            }
            label {
                font-size: 14px;
                margin-bottom: 5px;
            }
            .button {
                font-size: 14px;
                padding: 8px 10px;
            }
            .has-text-centered {
                text-align: center;
            }
        </style>
    </head>
    <body>
    <div class="container">
        <h1 class="title has-text-centered">Usuarios</h1>
        <h2 class="subtitle has-text-centered">Nuevo usuario</h2>
    </div>

    <div class="container pb-6 pt-6 has-text-centered">

        <form action="./php/usuario_guardar.php" method="POST" class="FormularioAjax" autocomplete="off">
            <div class="columns">
                <div class="column">
                    <div class="control">
                        <label>Nombre</label>
                        <input class="input" type="text" name="usuario_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required placeholder="Nombres">
                    </div>
                </div>
                <div class="column">
                    <div class="control">
                        <label>Apellido</label>
                        <input class="input" type="text" name="usuario_apellido" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required placeholder="Apellidos">
                    </div>
                </div>
            
            
                <div class="column">
                    <div class="control">
                        <label>Usuario</label>
                        <input class="input" type="text" name="usuario_usuario" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required placeholder="Usuario">
                        <span style="color: #0D0D0E; font-style: italic;">El usuario tiene que ser de 4 a 20 dígitos y solo puede contener números, letras y guion bajo.</span>
                    </div>
                </div>
                <div class="column">
                    <div class="control">
                        <label>Email</label>
                        <input class="input" type="email" name="usuario_email" maxlength="70" placeholder="Correo">
                        <span style="color: #0D0D0E; font-style: italic;">El correo puede contener números, letras y guion bajo.</span>
                    </div>
                </div>
            </div>

            <div class="columns">
                <div class="column">
                    <div class="control">
                        <label>Cédula</label>
                        <input class="input" type="number" name="usuario_cedula" maxlength="40" placeholder="Cédula">
                        <span style="color: #0D0D0E; font-style: italic;">La cédula solo puede contener números.</span>
                    </div>
                </div>
                <div class="column">
                    <label>Departamento</label>
                    <select class="input" name="usuario_departamento" maxlength="70" placeholder="Departamento">
                        <option disabled selected>Seleccionar Departamento</option>
                        <option value="Electronica">Electronica</option>
                        <option value="Telecomunicaciones">Telecomunicaciones</option>
                        <option value="Electricidad">Electricidad</option>
                        <option value="Instrumentacionycontrol">Instrumentacion y Control</option>
                    </select>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="control">
                        <label>Contrasena</label>
                        <input class="input" type="password" name="usuario_clave_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required placeholder="Contraseña">
                        <span style="color: #0D0D0E; font-style: italic;">La CLAVE debe contener al menos una letra mayúscula y un carácter especial (como !@#$%^&*()-_=+{};:,.<>?)</span>
                    </div>
                </div>
                <div class="column">
                    <div class="control">
                        <label>Repetir contrasena</label>
                        <input class="input" type="password" name="usuario_clave_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required placeholder="Contraseña">
                    </div>
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
            <p class="has-text-centered">
                <button type="submit" class="button is-info is-rounded">Guardar</button>
            </p>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pregunta1Select = document.querySelector('select[name="pregunta1"]');
            const pregunta2Select = document.querySelector('select[name="pregunta2"]');

            pregunta1Select.addEventListener('change', function() {
                const selectedOptionValue = pregunta1Select.value;
                for (let i = 0; i < pregunta2Select.options.length; i++) {
                    if (pregunta2Select.options[i].value === selectedOptionValue) {
                        pregunta2Select.options[i].disabled = true;
                    } else {
                        pregunta2Select.options[i].disabled = false;
                    }
                }
            });
        });
    </script>
    </body>
    </html>
