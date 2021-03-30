<?php include_once "header.php"; ?>
<?php

use App\bll\recetaBLL;
use App\bll\ingredientesBLL;


$recetaBLL = new recetaBLL();
$ingredientesBLL = new ingredientesBLL();

$id = 0;
$objIngrediente = null;
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $objIngrediente = $ingredientesBLL->selectById($id);
}
$listaRecetas = $recetaBLL->selectAll();
?>
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <div class="card mt-3">
                <div class="card-header">
                    Formulario de Ingredientes
                </div>
                <div class="card-body">
                    <form method="post" action="indexIngrediente.php">
                        <input type="hidden" name="id" value="<?php echo $id ?>"/>
                        <input type="hidden" name="task" value="<?php echo ($id == 0) ? "insert" : "update"; ?>"/>
                        <div class="form-group">
                            <div>
                                <label>Nombre del ingrediente:</label>
                            </div>
                            <div>
                                <input type="text" name="nombre" class="form-control"
                                       value="<?php echo ($objIngrediente == null) ? '' : $objIngrediente->getNombreIngrediente(); ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Tipo de medida:</label>
                            </div>
                            <div>
                                <select name="tipo" class="form-control">
                                    <option <?php
                                    if ($objIngrediente != null && $objIngrediente->getTipoMedida() == 0) {
                                        echo " selected ";
                                    }
                                    ?> value="0">Taza
                                    </option>
                                    <option <?php
                                    if ($objIngrediente != null && $objIngrediente->getTipoMedida() == 1) {
                                        echo " selected ";
                                    }
                                    ?> value="1">Cuchara
                                    </option>
                                    <option <?php
                                    if ($objIngrediente != null && $objIngrediente->getTipoMedida() == 2) {
                                        echo " selected ";
                                    }
                                    ?> value="2">Cucharilla
                                    </option>
                                    <option <?php
                                    if ($objIngrediente != null && $objIngrediente->getTipoMedida() == 3) {
                                        echo " selected ";
                                    }
                                    ?> value="3">Mililitros
                                    </option>
                                    <option <?php
                                    if ($objIngrediente != null && $objIngrediente->getTipoMedida() == 4) {
                                        echo " selected ";
                                    }
                                    ?> value="4">Litro
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Receta del ingrediente:</label>
                            </div>
                            <div>
                                <select name="recetaId" class="form-control">
                                    <?php foreach ($listaRecetas as $objReceta): ?>
                                        <option <?php if ($objIngrediente != null && $objReceta->getId() == $objIngrediente->getIdReceta()) {
                                                echo "selected";
                                            }
                                            ?> value="<?php echo $objReceta->getId(); ?>"><?php echo $objReceta->getNombre(); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Cantidad:</label>
                            </div>
                            <div>
                                <input type="number" name="cantidad" class="form-control"
                                       value="<?php echo ($objIngrediente == null) ? '' : $objIngrediente->getCantidadMedida(); ?>"/>
                            </div>
                        </div>
                        <div>
                            <input type="submit" value="Enviar datos" class="btn btn-primary"/>
                            <a class="btn btn-link" href="indexIngrediente.php">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include_once "footer.php"; ?>