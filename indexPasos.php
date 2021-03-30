<?php include_once "header.php"; ?>
<?php

use App\bll\pasosBLL;

$pasosBLL = new pasosBLL();

$task = "list";
if (isset($_REQUEST['task'])) {
    $task = $_REQUEST['task'];
}

switch ($task) {
    case "insert":
        if (isset($_REQUEST["texto"]) && isset($_REQUEST["orden"])
            && isset($_REQUEST["recetaId"])) {
            $text = $_REQUEST["texto"];
            $orden = $_REQUEST["orden"];
            $recetaId = $_REQUEST["recetaId"];


            $pasosBLL->insert($text, $orden, $recetaId);
        }
        break;
    case "update":
        if (isset($_REQUEST["texto"]) && isset($_REQUEST["orden"])
            && isset($_REQUEST["recetaId"])) {
            $text = $_REQUEST["texto"];
            $orden = $_REQUEST["orden"];
            $recetaId = $_REQUEST["recetaId"];
            $id = $_REQUEST["id"];

            $pasosBLL->update($text, $orden, $recetaId,$id);
        }
        break;
    case "delete":
        if (isset($_REQUEST["id"])) {
            $id = $_REQUEST["id"];
            $pasosBLL->delete($id);
        }
        break;
}


$listaPasos = $pasosBLL->selectAll();
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-header">
                    Lista de Pasos
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Receta</th>
                        <th>Paso de preparacion</th>
                        <th>Orden</th>

                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($listaPasos as $objPasos): ?>
                        <tr>
                            <td><?php echo $objPasos->getId(); ?></td>
                            <td><?php echo $objPasos->getRecetaForDisplay(); ?></td>
                            <td><?php echo $objPasos->getPasosdePreparacion(); ?></td>
                            <td><?php echo $objPasos->getNumeroOrden(); ?></td>
                            <td><a class="btn btn-primary"
                                   href="formPasos.php?id=<?php echo $objPasos->getId(); ?>">Editar</a></td>
                            <td><a class="btn btn-danger"
                                   onclick="return confirm('¿Está seguro que desea eliminar este paso?')"
                                   href="indexPasos.php?task=delete&id=<?php echo $objPasos->getId(); ?>">Eliminar</a>
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