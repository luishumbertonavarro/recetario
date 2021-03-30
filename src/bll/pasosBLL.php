<?php


namespace App\bll;

use App\dal\Connection;
use App\dto\pasos;

use PDO;
class pasosBLL
{
    function insert($paso, $orden, $recetaId)
    {
        $objConecction = new Connection();
        $objConecction->queryWithParams(
            "INSERT INTO pasos (pasodePreparacion, numeroOrden, receta_id)
VALUE (:varPasodePreparacion, :varNumeroOrden, :varReceta_id)",
            array(
                ":varPasodePreparacion" => $paso,
                ":varNumeroOrden" => $orden,
                ":varReceta_id" => $recetaId,
            )
        );
        return $objConecction->getLastInsertedId();
    }

    function update($paso, $orden, $recetaId, $id)
    {
        $objConecction = new Connection();
        $objConecction->queryWithParams("
                UPDATE pasos
                SET pasodePreparacion= :varPasodePreparacion,
                    numeroOrden= :varNumeroOrden,
                    receta_id= :varReceta_id
                  WHERE id= :varId", array(
            ":varPasodePreparacion" => $paso,
            ":varNumeroOrden" => $orden,
            ":varReceta_id" => $recetaId,
            ":varId"=>$id
        ));
    }

    function delete($id)
    {
        $objConecction = new Connection();
        $objConecction->queryWithParams("
        DELETE FROM pasos WHERE id = :varId
        ", array(
            ":varId" => $id
        ));
    }
    function selectAll()
    {
        $listaPasos = array();
        $objConnection = new Connection();
        $res = $objConnection->query("
        SELECT 
        id, pasodePreparacion, numeroOrden, receta_id
        FROM pasos");
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $pasos = $this->rowToDto($row);
            $listaPasos[] = $pasos;
        }
        return $listaPasos;
    }

    //asc==menor a mayor
    //desc==mayor a menor
    function selectAllASC($id)
    {
        $objConnection = new Connection();
        $res = $objConnection->queryWithParams("
        SELECT id, pasodePreparacion, numeroOrden, receta_id
        FROM pasos 
        WHERE receta_id=:varId ORDER BY numeroOrden ASC", array(
            ":varId"=>$id
        ));
        if ($res->rowCount() == 0) {
            return null;
        }
        while($row = $res->fetch(PDO::FETCH_ASSOC)){
        $objPasos = $this->rowToDto($row);
        $listaPasos[] = $objPasos;
        }
        return $listaPasos;
    }

    function selectById($id)
    {
        $objConnection = new Connection();
        $res = $objConnection->queryWithParams("
            SELECT id, pasodePreparacion, numeroOrden, receta_id
            FROM pasos
            WHERE id = :varId
        ", array(
            ":varId" => $id
        ));
        if ($res->rowCount() == 0) {
            return null;
        }
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $objPasos = $this->rowToDto($row);
        return $objPasos;
    }

    private function rowToDto($row)
    {
        $objPasos = new pasos();

        $objPasos->setId($row["id"]);
        $objPasos->setPasosdePreparacion($row["pasodePreparacion"]);
        $objPasos->setNumeroOrden($row["numeroOrden"]);
        $objPasos->setRecetaId($row["receta_id"]);
        return $objPasos;
    }

}