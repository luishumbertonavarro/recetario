<?php include_once "header.php"; ?>
<?php

use App\bll\pasosBLL;
use App\bll\recetaBLL;


$pasosBLL = new pasosBLL();
$recetaBLL = new recetaBLL();

$id = 0;
$objPasos = null;
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $objPasos = $pasosBLL->selectById($id);
}
$listaRecetas = $recetaBLL->selectAll();
?>
    <div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <div class="card mt-3">
                <div class="card-header">
                    Formulario de Pasos
                </div>
                <div class="card-body">
                    <form method="post" action="indexPasos.php">
                        <input type="hidden" name="id" value="<?php echo $id ?>"/>
                        <input type="hidden" name="task" value="<?php echo ($id == 0) ? "insert" : "update"; ?>"/>
                        <div class="form-group">
                            <div>
                                <label>Detalle del paso a seguir:</label>
                            </div>
                            <div>
                                <input type="text" name="texto" class="form-control"
                                       value="<?php echo ($objPasos == null) ? '' : $objPasos->getPasosdePreparacion(); ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Orden de preparacion:</label>
                            </div>
                            <div>
                                <input type="number" name="orden" class="form-control"
                                       value="<?php echo ($objPasos == null) ? '' : $objPasos->getNumeroOrden(); ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Receta del ingrediente:</label>
                            </div>
                            <div>
                                <select name="recetaId" class="form-control">
                                    <?php foreach ($listaRecetas as $objReceta): ?>
                                        <option
                                            <?php
                                            if ($objPasos != null && $objReceta->getId() == $objPasos->getId()) {
                                                echo "selected";
                                            }
                                            ?> value="<?php echo $objReceta->getId(); ?>"><?php echo $objReceta->getNombre(); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div>
                            <input type="submit" value="Enviar datos" class="btn btn-primary"/>
                            <a class="btn btn-link" href="indexPasos.php">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include_once "footer.php"; ?>