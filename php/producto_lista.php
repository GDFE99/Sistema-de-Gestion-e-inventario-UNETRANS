<div class="container pb-6 pt-6">
    <?php
        require_once "./php/main.php";
    ?>
    <table id="tabla-productos" class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Código</th>
                <th>Stock</th>
                <th>Categoría</th>
                <th>Registrado Por</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <style>
        .container {
            margin-top: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            background-color: #F4F4F4;
        }

        .form-rest {
            max-width: 500px;
            margin: 0 auto;
        }

        .select, .input, .button {
            margin-bottom: 10px;
        }

        .product-image {
        max-width: 50px; /* Establece el ancho máximo para las imágenes */
        height: auto; /* Permite ajustar automáticamente la altura */
    }
    </style>
</div>

<?php
                $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
                $campos = "producto.producto_id,producto.producto_codigo,producto.producto_nombre,producto.producto_stock,producto.producto_foto,producto.categoria_id,producto.usuario_id,categoria.categoria_id,categoria.categoria_nombre,usuario.usuario_id,usuario.usuario_nombre,usuario.usuario_apellido";
                if (isset($busqueda) && $busqueda != "") {
                    $consulta_datos = "SELECT $campos FROM producto INNER JOIN categoria ON producto.categoria_id=categoria.categoria_id INNER JOIN usuario ON producto.usuario_id=usuario.usuario_id WHERE producto.producto_codigo LIKE '%$busqueda%' OR producto.producto_nombre LIKE '%$busqueda%' ORDER BY producto.producto_nombre ASC LIMIT $inicio,$registros";
                    $consulta_total = "SELECT COUNT(producto_id) FROM producto WHERE producto_codigo LIKE '%$busqueda%' OR producto_nombre LIKE '%$busqueda%'";
                } elseif ($categoria_id > 0) {
                    $consulta_datos = "SELECT $campos FROM producto INNER JOIN categoria ON producto.categoria_id=categoria.categoria_id INNER JOIN usuario ON producto.usuario_id=usuario.usuario_id WHERE producto.categoria_id='$categoria_id' ORDER BY producto.producto_nombre ASC LIMIT $inicio,$registros";
                    $consulta_total = "SELECT COUNT(producto_id) FROM producto WHERE categoria_id='$categoria_id'";
                } else {
                    $consulta_datos = "SELECT $campos FROM producto INNER JOIN categoria ON producto.categoria_id=categoria.categoria_id INNER JOIN usuario ON producto.usuario_id=usuario.usuario_id ORDER BY producto.producto_nombre ASC LIMIT $inicio,$registros";
                    $consulta_total = "SELECT COUNT(producto_id) FROM producto";
                }
                $conexion = conexion();

                
                $datos = $conexion->query($consulta_datos);
                $datos = $datos->fetchAll();
                $total = $conexion->query($consulta_total);
                $total = (int) $total->fetchColumn();
                $Npaginas = ceil($total / $registros);
                
                if ($total >= 1 && $pagina <= $Npaginas) {
                    $contador = $inicio + 1;
                    foreach ($datos as $rows) {
                        echo '<tr>';
                        echo '<td>' . $contador . '</td>';
                        echo '<td>';
                    
                        // Check if product image exists
                       // Verificar si existe la imagen del producto
                       if (is_file("./img/producto/" . $rows['producto_foto'])) {
                        echo '<img src="./img/producto/' . $rows['producto_foto'] . '" alt="Product Image" class="product-image">';
                    } else {
                        echo '<img src="./img/producto.png" alt="Default Image" class="product-image">';
                    }

                    // Mostrar el nombre del producto
                        echo '<span class="producto-nombre">' . $rows['producto_nombre'] . '</span>';
                        echo '</td>';
                        echo '<td>' . $rows['producto_codigo'] . '</td>';
                        echo '<td>' . $rows['producto_stock'] . '</td>';
                        echo '<td>' . $rows['categoria_nombre'] . '</td>';
                        echo '<td>' . $rows['usuario_nombre'] . ' ' . $rows['usuario_apellido'] . '</td>';
                        echo '<td>';
                    
                        // Output action buttons
                        echo '<a href="index.php?vista=product_img&product_id_up=' . $rows['producto_id'] . '" class="button is-link is-rounded is-small">Imagen</a>';
                        echo '<a href="index.php?vista=product_update&product_id_up=' . $rows['producto_id'] . '" class="button is-success is-rounded is-small">Actualizar</a>';
                        echo '<a href="#" onclick="confirmarEliminar(' . $rows['producto_id'] . ')" class="button is-danger is-rounded is-small">Eliminar</a>';
                        echo '</td>';
                        echo '</tr>';
                        $contador++;
                    }
                    
                    }
                    
                    
                    
                    
                    
                    
                    
                 else {
                    echo '<tr><td colspan="7">No hay registros en el sistema</td></tr>';
                }
                $conexion = null;
            ?>
        </tbody>
    </table>
</div>


    <?php
        require_once "./php/main.php";

        # Eliminar producto #
        if(isset($_GET['product_id_del'])){
            require_once "./php/producto_eliminar.php";
        }

        if(!isset($_GET['page'])){
            $pagina=1;
        }else{
            $pagina=(int) $_GET['page'];
            if($pagina<=1){
                $pagina=1;
            }
        }

        $categoria_id = (isset($_GET['category_id'])) ? $_GET['category_id'] : 0;

        $pagina=limpiar_cadena($pagina);
        $url="index.php?vista=product_list&page="; /* <== */
        $registros=15;
        $busqueda="";

        # Paginador producto #
        require_once "./php/producto_lista.php";
    ?>
</div>
<script>
    function confirmarEliminar(producto_id) {
        if (confirm('¿Está seguro de eliminar este producto?')) {
            window.location.href = '<?php echo $url ?>' + '&product_id_del=' + producto_id;
        }
    }
</script>