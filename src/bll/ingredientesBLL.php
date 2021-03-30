<?php


namespace App\bll;

use App\dal\Connection;
use App\dto\ingredientes;

use PDO;

class ingredientesBLL
{
    function insert($nombre, $idReceta, $tipoMedida, $cantidadMedida)
    {
        $objConecction = new Connection();
        $objConecction->queryWithParams(
            "INSERT INTO ingredientes (nombreIngrediente, idReceta, tipoMedida, cantidadMedida)
VALUE (:varNombreIngrediente, :varIdReceta, :varTipoMedida, :varCantidadMedida)",
            array(
                ":varNombreIngrediente" => $nombre,
                ":varIdReceta" => $idReceta,
                ":varTipoMedida" => $tipoMedida,
                ":varCantidadMedida" => $cantidadMedida
            )
        );
        return $objConecction->getLastInsertedId();
    }

    function update($nombre, $idReceta, $tipoMedida, $cantidadMedida, $id)
    {
        $objConecction = new Connection();
        $objConecction->queryWithParams("
                UPDATE ingredientes
                SET nombreIngrediente= :varNombreIngrediente,
                    idReceta= :varIdReceta,
                    tipoMedida= :varTipoMedida,
                  cantidadMedida= :varCantidadMedida
                  WHERE id= :varId", array(
            ":varNombreIngrediente" => $nombre,
            ":varIdReceta" => $idReceta,
            ":varTipoMedida" => $tipoMedida,
            ":varCantidadMedida" => $cantidadMedida,
            ":varId"=>$id
        ));
    }

    function delete($id)
    {
        $objConecction = new Connection();
        $objConecction->queryWithParams("
        DELETE FROM ingredientes WHERE id = :varId
        ", array(
            ":varId" => $id
        ));
    }

    function selectAll()
    {
        $listaIngredientes = array();
        $objConnection = new Connection();
        $res = $objConnection->query("
        SELECT 
        id, nombreIngrediente, idReceta, tipoMedida, cantidadMedida 
        FROM ingredientes");
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $ingrediente = $this->rowToDto($row);
            $listaIngredientes[] = $ingrediente;
        }
        return $listaIngredientes;
    }

    function selectById($id)
    {
        $objConnection = new Connection();
        $res = $objConnection->queryWithParams("
            SELECT id, nombreIngrediente, idReceta, tipoMedida, cantidadMedida
            FROM ingredientes
            WHERE id = :varId
        ", array(
            ":varId" => $id
        ));
        if ($res->rowCount() == 0) {
            return null;
        }
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $objIngrediente = $this->rowToDto($row);
        return $objIngrediente;
    }

    private function rowToDto($row)
    {
        $objIngrediente = new ingredientes();

        $objIngrediente->setId($row["id"]);
        $objIngrediente->setNombreIngrediente($row["nombreIngrediente"]);
        $objIngrediente->setIdReceta($row["idReceta"]);
        $objIngrediente->setTipoMedida($row["tipoMedida"]);
        $objIngrediente->setCantidadMedida($row["cantidadMedida"]);
        return $objIngrediente;
    }

}