<?php

class Stripboek {
    private $id;
    private $held;
    private $title;
    private $jaaruitgave = 0;
    private $tekenaar;
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



}




