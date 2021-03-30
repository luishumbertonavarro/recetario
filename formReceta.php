<?php include_once "header.php"; ?>
<?php

use App\bll\recetaBLL;

$recetaBLL=new recetaBLL();

$id=0;
$objReceta=null;
if(isset($_REQUEST['id'])){
    $id=$_REQUEST['id'];
    $objReceta=$recetaBLL->selectById($id);
}
?>
<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <div class="card mt-3">
                <div class="card-header">
                    Formulario de Recetas
                </div>
                <div class="card-body">
                    <form method="post" action="indexReceta.php" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $id?>"/>
                        <input type="hidden" name="task" value="<?php echo ($id == 0) ? "insert" : "update"; ?>"/>
                        <div class="form-group">
                            <div>
                                <label>Nombre: </label>
                            </div>
                            <div>
                                <input type="text" name="nombre" class="form-control"
                                       value="<?php echo ($objReceta == null) ? '' : $objReceta->getNombre(); ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Descripcion de la receta: </label>
                            </div>
                            <div>
                                <input type="text" name="descripcion" class="form-control"
                                       value="<?php echo ($objReceta == null) ? '' : $objReceta->getDescripcion(); ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Tiempo de preparacion en minutos: </label>
                            </div>
                            <div>
                                <input type="number" name="tiempo" class="form-control"
                                       value="<?php echo ($objReceta == null) ? '' : $objReceta->getTiempo(); ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <label>Imagen de la receta</label>
                            </div>
                            <div>
                                <input type="file" name="foto" class="form-control"/>
                            </div>
                        </div>

                        <div>
                            <input type="submit" value="Enviar datos" class="btn btn-primary"/>
                            <a class="btn btn-link" href="indexReceta.php">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once "footer.php";?>