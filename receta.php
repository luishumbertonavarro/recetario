<?php include_once "header.php"; ?>

<?php

use App\bll\recetaBLL;
use App\bll\ingredientesBLL;
use App\bll\pasosBLL;

$recetaBLL = new recetaBLL();
$ingredientesBLL=new ingredientesBLL();
$pasosBLL=new pasosBLL();

$id = 0;
$objReceta = null;
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $objReceta = $recetaBLL->selectById($id);

}
$listaPasos=$pasosBLL->selectAllASC($id);
?>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <div class="card mt-3" style="width: 18rem;">
                    <input type="hidden" name="id" value="<?php echo $id ?>"/>
                    <img src="img/<?php echo $objReceta->getFoto() ?>" class="card-img-top" alt="RECETA IMG">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $objReceta->getNombre() ?></h5>
                        <p class="card-text"><?php echo $objReceta->getDescripcion() ?></p>
                        <p class="card-text">El tiempo de preparacion es: <?php echo $objReceta->getTiempo() ?> minutos</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($listaPasos as $objPasos): ?>

                        <li class="list-group-item">

                            <?php echo $objPasos->getPasosdePreparacion();?>
                        </li>

                        <?php endforeach;?>

                    </ul>
                    <div class="card-body">
                        <a href="indexReceta.php" class="card-link">Volver</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php include_once "footer.php"; ?>