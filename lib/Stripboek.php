<?php

class Stripboek {
    private $id;
    private $held;
    private $title;
    private $jaaruitgave = 0;
    private $tekenaar;
    private $schrijver;
    private $deel;
    private $cbr ;

    public function getSpecs() {
        return sprintf(
                '%s: %s/%s/%s',
                $this->id,
                $this->title,
                $this->jaaruitgave,
                $this->cbr
            );
        }

    /**
     * @return string
     */
    public function getDeel()
    {
        return $this->deel;
    }

    /**
     * @param string $deel
     */
    public function setDeel($deel)
    {
        $this->deel = $deel;
    }



    /**
     * @return string
     */
    public function getTekenaar()
    {
        return $this->tekenaar;
    }

    /**
     * @param string $tekenaar
     */
    public function setTekenaar($tekenaar)
    {
        $this->tekenaar = $tekenaar;
    }



    /**
     * @return string
     */
    public function getHeld()
    {
        return $this->held;
    }

    /**
     * @param string $held
     */
    public function setHeld($held)
    {
        $this->held = $held;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getJaaruitgave()
    {
        return $this->jaaruitgave;
    }

    /**
     * @param string $jaaruitgave
     */
    public function setJaaruitgave($jaaruitgave)
    {
        $this->jaaruitgave = $jaaruitgave;
    }

    /**
     * @return string
     */
    public function getCbr()
    {
        return $this->cbr;
    }

    /**
     * @param string $cbr
     */
    public function setCbr($cbr)
    {
        $this->cbr = $cbr;
    }

    /**
     * @return string
     */
    public function getSchrijver()
    {
        return $this->schrijver;
    }

    /**
     * @param string $schrijver
     */
    public function setSchrijver($schrijver)
    {
        $this->schrijver = $schrijver;
    }

    /*meerdere gegeven in de dB*/
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




