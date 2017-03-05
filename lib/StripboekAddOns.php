<?php

class StripboekAddOns extends DatabaseStripboek {

    private $isbn;
    private $reeksnaam;
    private $deelreeks;
    private $uitgever;
    private $genre;
    private $blad;
    private $nummers;
    private $opmerking;
    private $datuminvoer;

    /**
     * @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * @param mixed $isbn
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
    }



    /**
     * @return mixed
     */
    public function getReeksnaam()
    {
        return $this->reeksnaam;
    }

    /**
     * @param mixed $reeksnaam
     */
    public function setReeksnaam($reeksnaam)
    {
        $this->reeksnaam = $reeksnaam;
    }

    /**
     * @return integer
     */
    public function getDeelreeks()
    {
        return $this->deelreeks;
    }

    /**
     * @param integer $deelreeks
     */
    public function setDeelreeks($deelreeks)
    {
        $this->deelreeks = $deelreeks;
    }

    /**
     * @return integer
     */
    public function getUitgever()
    {
        return $this->uitgever;
    }

    /**
     * @param integer $uitgever
     */
    public function setUitgever($uitgever)
    {
        $this->uitgever = $uitgever;
    }

    /**
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param string $genre
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
    }

    /**
     * @return string
     */
    public function getBlad()
    {
        return $this->blad;
    }

    /**
     * @param string $blad
     */
    public function setBlad($blad)
    {
        $this->blad = $blad;
    }

    /**
     * @return string
     */
    public function getNummers()
    {
        return $this->nummers;
    }

    /**
     * @param string $nummers
     */
    public function setNummers($nummers)
    {
        $this->nummers = $nummers;
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

    /**
     * @return string
     */
    public function getDatuminvoer()
    {
        return $this->datuminvoer;
    }

    /**
     * @param string $datuminvoer
     */
    public function setDatuminvoer($datuminvoer)
    {
        $this->datuminvoer = $datuminvoer;
    }






}