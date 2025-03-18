<div class="container">
    <h1 class="title">Préstamos</h1>
    <h2 class="subtitle">Buscar préstamo por fecha, nombre y categoría</h2>
</div>

<div class="container pb-6 pt-6">
    <?php
        require_once "./php/main.php";

        if(isset($_POST['modulo_buscador'])){
            require_once "./php/buscador.php"; // Aquí debería estar el script de búsqueda
        }

        if(!isset($_SESSION['busqueda_prestamo']) && empty($_SESSION['busqueda_prestamo'])){
    ?>
    <div class="columns">
        <div class="column">
            <form action="" method="POST" autocomplete="off" >
                <input type="hidden" name="modulo_buscador" value="prestamo">
                <div class="field is-grouped">
                    <p class="control is-expanded">
                        <input class="input is-rounded" type="date" name="fecha_buscada" placeholder="Fecha" required>
                    </p>
                    <p class="control is-expanded">
                        <input class="input is-rounded" type="text" name="nombre_buscado" placeholder="Nombre">
                    </p>
                    <p class="control is-expanded">
                        <input class="input is-rounded" type="text" name="categoria_buscada" placeholder="Categoria">
                    </p>
                    <p class="control">
                        <button class="button is-info" type="submit">Buscar</button>
                    </p>
                </div>
            </form>
        </div>
    </div>
    <?php }else{ ?>
    
    <?php
            # Eliminar préstamo #
            if(isset($_GET['prestamo_id_del'])){
                require_once "./php/prestamo_eliminar.php"; // Asegúrate de tener el archivo prestamo_eliminar.php para eliminar préstamos
            }

            if(!isset($_GET['page'])){
                $pagina=1;
            }else{
                $pagina=(int) $_GET['page'];
                if($pagina<=1){
                    $pagina=1;
                }
            }

            $pagina=limpiar_cadena($pagina);
            $url="index.php?vista=prestamo_search&page=";
            $registros=15;
            $busqueda=$_SESSION['busqueda_prestamo'];

            # Paginador préstamo #
            require_once "./php/prestamo_lista.php"; // Asegúrate de tener el archivo prestamo_lista.php para listar préstamos
        } 
    ?>
</div>
