<?php include_once "header.php"; ?>
<?php

use App\bll\ingredientesBLL;

$ingredientesBLL = new ingredientesBLL();

$task = "list";
if (isset($_REQUEST['task'])) {
    $task = $_REQUEST['task'];
}

switch ($task) {
    case "insert":
        if (isset($_REQUEST["nombre"]) && isset($_REQUEST["tipo"])
            && isset($_REQUEST["recetaId"])&& isset($_REQUEST["cantidad"])) {
            $nombre = $_REQUEST["nombre"];
            $tipo = $_REQUEST["tipo"];
            $idReceta = $_REQUEST["recetaId"];
            $cantidad = $_REQUEST["cantidad"];


            $ingredientesBLL->insert($nombre, $idReceta, $tipo,$cantidad);
        }
        break;
    case "update":
        if (isset($_REQUEST["nombre"]) && isset($_REQUEST["tipo"])
            && isset($_REQUEST["recetaId"])&& isset($_REQUEST["cantidad"])) {
            $nombre = $_REQUEST["nombre"];
            $tipo = $_REQUEST["tipo"];
            $idReceta = $_REQUEST["recetaId"];
            $cantidad = $_REQUEST["cantidad"];
            $id = $_REQUEST["id"];

            $ingredientesBLL->update($nombre,$idReceta,$tipo,$cantidad,$id);
        }
        break;
    case "delete":
        if (isset($_REQUEST["id"])) {
            $id = $_REQUEST["id"];
            $ingredientesBLL->delete($id);
        }
        break;
}


$listaIngredientes = $ingredientesBLL->selectAll();
?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mt-3">
                    <div class="card-header">
                        Lista de Mascotas
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Receta</th>

                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($listaIngredientes as $objIngrediente): ?>
                            <tr>
                                <td><?php echo $objIngrediente->getId(); ?></td>
                                <td><?php echo $objIngrediente->getNombreIngrediente(); ?></td>
                                <td><?php echo $objIngrediente->getTipoForDisplay(); ?></td>
                                <td><?php echo $objIngrediente->getRecetaForDisplay(); ?></td>
                                <td><a class="btn btn-primary"
                                       href="formIngredientes.php?id=<?php echo $objIngrediente->getId(); ?>">Editar</a></td>
                                <td><a class="btn btn-danger"
                                       onclick="return confirm('¿Está seguro que desea eliminar el ingrediente?')"
                                       href="indexIngrediente.php?task=delete&id=<?php echo $objIngrediente->getId(); ?>">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php include_once "footer.php"; ?>