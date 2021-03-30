<?php


namespace App\dto;


use App\bll\recetaBLL;

class ingredientes
{
    private $id;
    private $nombreIngrediente;
    private $idReceta;
    private $tipoMedida;
    private $cantidadMedida;

    /**
     * @return mixed
     */
    public function getIdReceta()
    {
        return $this->idReceta;
    }

    /**
     * @param mixed $idReceta
     */
    public function setIdReceta($idReceta)
    {
        $this->idReceta = $idReceta;
    }

    /**
     * @return mixed
     */

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNombreIngrediente()
    {
        return $this->nombreIngrediente;
    }

    /**
     * @param mixed $nombreIngrediente
     */
    public function setNombreIngrediente($nombreIngrediente)
    {
        $this->nombreIngrediente = $nombreIngrediente;
    }

    /**
     * @return mixed
     */
    public function getTipoMedida()
    {
        return $this->tipoMedida;
    }
    public function getTipoForDisplay()
    {
        switch ($this->tipoMedida) {
            case 0:
                return "Taza";
            case 1:
                return "Cuchara";
            case 2:
                return "Cucharilla";
            case 3:
                return "Ml";
            case 4:
                return "Litro";
        }
        return "no definido";
    }

    /**
     * @param mixed $tipoMedida
     */
    public function setTipoMedida($tipoMedida)
    {
        $this->tipoMedida = $tipoMedida;
    }

    /**
     * @return mixed
     */
    public function getCantidadMedida()
    {
        return $this->cantidadMedida;
    }

    /**
     * @param mixed $cantidadMedida
     */
    public function setCantidadMedida($cantidadMedida)
    {
        $this->cantidadMedida = $cantidadMedida;
    }
    public function getRecetaForDisplay()
    {
        $recetaBLL = new recetaBLL();
        $objReceta = $recetaBLL->selectById($this->getIdReceta());
        if ($objReceta == null) {
            return "no definido";
        }
        return $objReceta->getNombre();
    }

}