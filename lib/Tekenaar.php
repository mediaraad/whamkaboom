<?php

class Tekenaar {

    private $id;
    private $achterNaam;
    private $voorNaam;
    private $alias;
    private $geboorteDatum;
    private $geboorteLand;
    private $rol;
    private $image;
    private $opmerking;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getAchterNaam()
    {
        return $this->achterNaam;
    }

    /**
     * @param string $achterNaam
     */
    public function setAchterNaam($achterNaam)
    {
        $this->achterNaam = $achterNaam;
    }

    /**
     * @return string
     */
    public function getVoorNaam()
    {
        return $this->voorNaam;
    }

    /**
     * @param string $voorNaam
     */
    public function setVoorNaam($voorNaam)
    {
        $this->voorNaam = $voorNaam;
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    /**
     * @return string
     */
    public function getGeboorteDatum()
    {
        return $this->geboorteDatum;
    }

    /**
     * @param string $geboorteDatum
     */
    public function setGeboorteDatum($geboorteDatum)
    {
        $this->geboorteDatum = $geboorteDatum;
    }

    /**
     * @return string
     */
    public function getGeboorteLand()
    {
        return $this->geboorteLand;
    }

    /**
     * @param string $geboorteLand
     */
    public function setGeboorteLand($geboorteLand)
    {
        $this->geboorteLand = $geboorteLand;
    }

    /**
     * @return integer
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * @param integer $rol
     */
    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getOpmerking()
    {
        return $this->opmerking;
    }

    /**
     * @param string $opmerking
     */
    public function setOpmerking($opmerking)
    {
        $this->opmerking = $opmerking;
    }




}