<?php


namespace App\bll;


use App\dal\Connection;
use App\dto\receta;
use PDO;

class recetaBLL
{
    function insert($nombre, $descripcion, $tiempoPreparacion, $foto)
    {
        $objConecction = new Connection();
        $objConecction->queryWithParams(
            "INSERT INTO receta (nombres, descripcion, tiempo, foto)
VALUE (:varNombre, :varDescripcion, :varTiempoPreparacion, :varFoto)",
            array(
                ":varNombre" => $nombre,
                ":varDescripcion" => $descripcion,
                ":varTiempoPreparacion" => $tiempoPreparacion,
                ":varFoto" => $foto
            )
        );
        return $objConecction->getLastInsertedId();
    }

    function update($nombre, $descripcion, $tiempo, $foto, $id)
    {
        $objConecction = new Connection();
        $objConecction->queryWithParams("
                UPDATE receta
                SET nombres= :varNombre,
                    descripcion= :varIdReceta,
                    tiempo= :varTiempo,
                  foto= :varFoto
                  WHERE id= :varId", array(
            ":varNombre" => $nombre,
            ":varIdReceta" => $descripcion,
            ":varTiempo" => $tiempo,
            ":varFoto" => $foto,
            ":varId"=> $id
        ));
    }

    function delete($id)
    {
        $objConecction = new Connection();
        $objConecction->queryWithParams("
        DELETE FROM receta WHERE id = :varId
        ", array(
            ":varId" => $id
        ));
    }

    function selectAll()
    {
        $listaRecetas = array();
        $objConnection = new Connection();
        $res = $objConnection->query("
        SELECT 
        id, nombres, descripcion, tiempo, foto 
        FROM receta");
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $receta = $this->rowToDto($row);
            $listaRecetas[] = $receta;
        }
        return $listaRecetas;
    }

    function selectById($id)
    {
        $objConnection = new Connection();
        $res = $objConnection->queryWithParams("
            SELECT id, nombres, descripcion, tiempo, foto
            FROM receta
            WHERE id = :varId
        ", array(
            ":varId" => $id
        ));
        if ($res->rowCount() == 0) {
            return null;
        }
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $objReceta = $this->rowToDto($row);
        return $objReceta;
    }

    private function rowToDto($row)
    {
        $objReceta = new receta();

        $objReceta->setId($row["id"]);
        $objReceta->setNombre($row["nombres"]);
        $objReceta->setDescripcion($row["descripcion"]);
        $objReceta->setTiempo($row["tiempo"]);
        $objReceta->setFoto($row["foto"]);
        return $objReceta;
    }
}