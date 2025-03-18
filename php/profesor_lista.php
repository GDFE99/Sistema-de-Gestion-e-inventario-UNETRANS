<?php
require_once "./php/main.php";

# Eliminar profesor #
if(isset($_GET['profesor_id_del'])){
    require_once "./php/profesor_eliminar.php";
}

if(!isset($_GET['page'])){
    $pagina=1;
}else{
    $pagina=(int) $_GET['page'];
    if($pagina<=1){
        $pagina=1;
    }
}

$inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
$tabla = "";
if (isset($busqueda) && $busqueda != "") {
    $consulta_datos = "SELECT * FROM profesores WHERE (profesor_nombre LIKE '%$busqueda%' OR profesor_apellido LIKE '%$busqueda%' OR profesor_departamento LIKE '%$busqueda%' OR profesor_cargo LIKE '%$busqueda%') ORDER BY profesor_nombre ASC LIMIT $inicio,$registros";
    $consulta_total = "SELECT COUNT(profesor_id) FROM profesores WHERE (profesor_nombre LIKE '%$busqueda%' OR profesor_apellido LIKE '%$busqueda%' OR profesor_departamento LIKE '%$busqueda%' OR profesor_cargo LIKE '%$busqueda%')";
} else {
    $consulta_datos = "SELECT * FROM profesores ORDER BY profesor_nombre ASC LIMIT $inicio,$registros";
    $consulta_total = "SELECT COUNT(profesor_id) FROM profesores";
}
$conexion = conexion();
$datos = $conexion->query($consulta_datos);
$datos = $datos->fetchAll();
$total = $conexion->query($consulta_total);
$total = (int) $total->fetchColumn();
$Npaginas = ceil($total / $registros);
$tabla .= '
<div class="table-container">
    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
            <tr class="has-text-centered">
                <th>#</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Departamento</th>
                <th>Cargo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
';
if ($total >= 1 && $pagina <= $Npaginas) {
    $contador = $inicio + 1;
    $pag_inicio = $inicio + 1;
    foreach ($datos as $rows) {
        $tabla .= '
            <tr class="has-text-centered" >
                <td>' . $contador . '</td>
                <td>' . $rows['profesor_nombre'] . '</td>
                <td>' . $rows['profesor_apellido'] . '</td>
                <td>' . $rows['profesor_departamento'] . '</td>
                <td>' . $rows['profesor_cargo'] . '</td>
                <td>
                    <button onclick="confirmarEliminar(' . $rows['profesor_id'] . ')" class="button is-danger is-rounded">Eliminar</button>
                </td>
            </tr>
        ';
        $contador++;
    }
    $pag_final = $contador - 1;
} else {
    if ($total >= 1) {
        $tabla .= '
            <tr class="has-text-centered" >
                <td colspan="6">
                    <a href="' . $url . '1" class="button is-link is-rounded is-small mt-4 mb-4">
                        Haga clic aquí para recargar el listado
                    </a>
                </td>
            </tr>
        ';
    } else {
        $tabla .= '
            <tr class="has-text-centered" >
                <td colspan="6">
                    No hay registros en el sistema
                </td>
            </tr>
        ';
    }
}
$tabla .= '</tbody></table></div>';
if ($total > 0 && $pagina <= $Npaginas) {
    $tabla .= '<p class="has-text-right">Mostrando profesores <strong>' . $pag_inicio . '</strong> al <strong>' . $pag_final . '</strong> de un <strong>total de ' . $total . '</strong></p>';
}
$conexion = null;
echo $tabla;
if ($total >= 1 && $pagina <= $Npaginas) {
    echo paginador_tablas($pagina, $Npaginas, $url, 7);
}

?>

<script>
function confirmarEliminar(profesor_id) {
    if (confirm('¿Está seguro de eliminar este profesor?')) {
        window.location.href = '<?php echo $url ?>&profesor_id_del=' + profesor_id;
    }
}
</script>
