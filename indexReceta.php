<?php include_once "header.php"; ?>
<?php

use App\bll\recetaBLL;

$recetaBLL=new recetaBLL();

$task="list";
if (isset($_REQUEST['task'])) {
    $task = $_REQUEST['task'];
}

switch ($task) {
    case "insert":
        if (isset($_REQUEST["nombre"]) && isset($_REQUEST["descripcion"])
            && isset($_REQUEST["tiempo"]) && isset($_FILES["foto"])) {
            $msg="";
            $nombre = $_REQUEST["nombre"];
            $descripcion = $_REQUEST["descripcion"];
            $tiempo= $_REQUEST["tiempo"];
            $foto=$_FILES["foto"];
            $ubicacion="img/".basename($_FILES['foto']['name']);
            $image=$_FILES['foto']['name'];
            $recetaBLL->insert($nombre, $descripcion, $tiempo,$image);
            if(move_uploaded_file($_FILES['foto']['tmp_name'], $ubicacion)){
                $msg="nice";
            }
            else{
                $msg="problema subiendo img";

            }
        }
        break;
    case "update":
        if (isset($_REQUEST["nombre"]) && isset($_REQUEST["descripcion"])
            && isset($_REQUEST["tiempo"]) && isset($_FILES["foto"])) {
            $msg="";
            $nombre = $_REQUEST["nombre"];
            $descripcion = $_REQUEST["descripcion"];
            $tiempo= $_REQUEST["tiempo"];
            $foto=$_FILES["foto"];

            $ubicacion="img/".basename($_FILES['foto']['name']);
            $image=$_FILES['foto']['name'];

            $id = $_REQUEST["id"];
            $recetaBLL->update($nombre,$descripcion,$tiempo,$image,$id);
            if(move_uploaded_file($_FILES['foto']['tmp_name'], $ubicacion)){
                $msg="nice";
            }
            else{
                $msg="problema subiendo img";

            }
        }
        break;
    case "delete":
        if (isset($_REQUEST["id"])) {
            $id = $_REQUEST["id"];
            $recetaBLL->delete($id);
        }
        break;
}
$listaRecetas=$recetaBLL->selectAll();
?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card mt-3">
                    <div class="card-header">
                        Lista de Recetas
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Minutos en preparar</th>

                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($listaRecetas as $objReceta): ?>
                            <tr>

                                <td><a href="receta.php?id=<?php echo $objReceta->getId();?>"><?php echo "<img class="."img-thumbnail"." src='img/".$objReceta->getFoto()."'>"; ?></a></td>
                                <td><?php echo $objReceta->getNombre(); ?></td>
                                <td><?php echo $objReceta->getDescripcion(); ?></td>
                                <td><?php echo $objReceta->getTiempo(); ?></td>
                                <td><a class="btn btn-primary"
                                       href="formReceta.php?id=<?php echo $objReceta->getId(); ?>">Editar</a></td>
                                <td><a class="btn btn-danger"
                                       onclick="return confirm('¿Está seguro que desea eliminar la receta?')"
                                       href="indexReceta.php?task=delete&id=<?php echo $objReceta->getId(); ?>">Eliminar</a>
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