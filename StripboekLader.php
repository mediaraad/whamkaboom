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
            $stripboek->setCbr($stripboekData['stripheld_reeks']);

            $stripboeken[] = $stripboek;
        }
        //var_dump($stripboeken); die;
        return $stripboeken;
    }

    private function queryForStripboek($held ="") {
        $pdo= $this->getPDO();
        $statement = $pdo->prepare('SELECT * FROM stripheld_tbl WHERE stripheld_held LIKE :held ORDER BY stripheld_held');
        if ($held=="") $naam="";
        else $naam=$held."%";
        $statement->bindParam(':held',$naam, PDO::PARAM_STR);
        $statement->execute();
        $stripArray = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $stripArray;
    }

    public function findTekenaarById ($tekenaar) {

        $pdo = $this->getPDO();
        if ($tekenaar!='') { 					// tekenaar(s) genoemd

            if (strpos($tekenaar,',')>0) { 	// er zijn meerdere tekenaars genoemd 
                $tekenaars=explode(',',$tekenaar);
                $aantalTekenaars=count($tekenaars);
            }
            else {											// 1 tekenaar genoemd
                //var_dump($tekenaar); die;
                $aantalTekenaars=1;
                $tekenaars[0]=$tekenaar;
            }
            $stringTekenaars="";
            for ($i=0;$i<=$aantalTekenaars-1;$i++) {				// echo de tekenaars die correleren met id
                $statement = $pdo->prepare('SELECT tek_naam from tekenaar_tbl where tek_id= :id');
                $statement->execute(array('id' => $tekenaar));
                $arrayTekenaar = $statement->fetch(PDO::FETCH_ASSOC);
                $stringTekenaars .= $arrayTekenaar['tek_naam'].", ";
            }
        }

        return $stringTekenaars;
    }

    private function getPDO()
    {
        return $this->pdo;
    }
}