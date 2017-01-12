<?php

class StripboekLader
{

    private $pdo;
    private $held;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return stripboeken[]
     */
    public function getStripboeken($held)
    {
        $stripboekenData = $this->queryForStripboek($held);
        $stripboeken = array();
        foreach ($stripboekenData as $stripboekData) {
            $stripboek = new Stripboek();
            $stripboek->setId($stripboekData['stripheld_id']);
            $stripboek->setHeld($stripboekData['stripheld_held']);
            $stripboek->setTitle($stripboekData['stripheld_titelalbum']);
            $stripboek->setJaaruitgave($stripboekData['stripheld_jaaruitgave']);
            $stripboek->setTekenaar($stripboekData['stripheld_tekenaar']);
            $stripboek->setDeel($stripboekData['stripheld_deel']);
            $stripboek->setCbr($stripboekData['stripheld_reeks']);

            $stripboeken[] = $stripboek;
        }
        //var_dump($stripboeken); die;
        return $stripboeken;
    }

    private function queryForStripboek($held ="") {
        $pdo= $this->getPDO();
        $statement = $pdo->prepare('SELECT * FROM stripheld_tbl WHERE stripheld_held LIKE :held ORDER BY stripheld_held,stripheld_deel');
        if ($held=="") $naam="";
        else $naam=$held."%";
        $statement->bindParam(':held',$naam, PDO::PARAM_STR);
        $statement->execute();
        $stripArray = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $stripArray;
    }



    private function getPDO()
    {
        return $this->pdo;
    }
}