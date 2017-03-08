<?php

class Uitgever
{
    private $id;
    private $naam;
    private $adres;
    private $opmerking = '';


    public function getSpecs()
    {
        return sprintf(
            '%s: %s/%s/%s',
            $this->id,
            $this->naam,
            $this->adres,
            $this->opmerking
        );
    }


    /**
     * @return Id string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * @return Naam string
     */
    public function getNaam()
    {
        return $this->naam;
    }

    /**
     * @param string $naam
     */
    public function setNaam($naam)
    {
        $this->naam = $naam;
    }


    /**
     * @return string
     */
    public function getAdres()
    {
        return $this->adres;
    }

    /**
     * @param string $adres
     */
    public function setAdres($adres)
    {
        $this->adres = $adres;
    }

    /**
     * @return string
     */
    public function getOpmerking()
    {
        return $this->opmerking;
    }

    /**
     * @param string $held
     */
    public function setOpmerking($opmerking)
    {
        $this->opmerking = $opmerking;
    }


}




