<?php


namespace App\dto;




use App\bll\recetaBLL;

class pasos
{
    private $id;
    private $pasosdePreparacion;
    private $numeroOrden;
    private $recetaId;

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
    public function getPasosdePreparacion()
    {
        return $this->pasosdePreparacion;
    }

    /**
     * @param mixed $pasosdePreparacion
     */
    public function setPasosdePreparacion($pasosdePreparacion)
    {
        $this->pasosdePreparacion = $pasosdePreparacion;
    }

    /**
     * @return mixed
     */
    public function getNumeroOrden()
    {
        return $this->numeroOrden;
    }

    /**
     * @param mixed $numeroOrden
     */
    public function setNumeroOrden($numeroOrden)
    {
        $this->numeroOrden = $numeroOrden;
    }

    /**
     * @return mixed
     */
    public function getRecetaId()
    {
        return $this->recetaId;
    }

    /**
     * @param mixed $recetaId
     */
    public function setRecetaId($recetaId)
    {
        $this->recetaId = $recetaId;
    }
    public function getRecetaForDisplay()
    {
        $recetaBLL = new recetaBLL();
        $objReceta = $recetaBLL->selectById($this->getRecetaId());
        if ($objReceta == null) {
            return "no definido";
        }
        return $objReceta->getNombre();
    }

}