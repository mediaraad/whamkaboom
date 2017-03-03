<?php

class StripboekLader
{

    private $pdo;
    private $held;

    public function __construct(PDO $pdo) {
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

        return $stripboeken;
    }

    private function queryForStripboek($held ="") {
        $pdo= $this->getPDO();
        $statement = $pdo->prepare('SELECT * FROM stripheld_tbl WHERE stripheld_held LIKE :held group by stripheld_held  ORDER BY stripheld_held,stripheld_deel');
        if ($held=="") $naam="";
        else $naam=$held."%";
        $statement->bindParam(':held',$naam, PDO::PARAM_STR);
        $statement->execute();
        $stripArray = $statement->fetchAll(PDO::FETCH_ASSOC); // FETCH_ASSOC, FETCH_CLASS, FETCH_OBJ

        return $stripArray;
    }


    /**
     * @param string $tekenaar
     * @return string
     */
    public function findTekenaarInStringById($tekenaar)
    {
        $pdo = $this->getPDO();
        $stringTekenaars = "";
        if ($tekenaar != '') {                    // tekenaar(s) genoemd

            if (strpos($tekenaar, ',') > 0) {    // er zijn meerdere tekenaars genoemd
                $tekenaars = explode(',', $tekenaar);
                $aantalTekenaars = count($tekenaars);
            } else {                                            // 1 tekenaar genoemd
                //var_dump($tekenaar); die;
                $aantalTekenaars = 1;
                $tekenaars[0] = $tekenaar;
            }

            for ($i = 0; $i <= $aantalTekenaars - 1; $i++) {                // echo de tekenaars die correleren met id
                $statement = $pdo->prepare('SELECT tek_naam, tek_voornaam from tekenaar_tbl where tek_id= :id');
                $statement->execute(array('id' => $tekenaars[$i]));
                $arrayTekenaar = $statement->fetch(PDO::FETCH_ASSOC);
                if ($aantalTekenaars > 1) {
                    if ($i == $aantalTekenaars - 1) $stringTekenaars .= $arrayTekenaar['tek_voornaam'] . " " . $arrayTekenaar['tek_naam'];
                    else $stringTekenaars .= $arrayTekenaar['tek_voornaam'] . " " . $arrayTekenaar['tek_naam'] . ", ";
                } else $stringTekenaars .= $arrayTekenaar['tek_voornaam'] . " " . $arrayTekenaar['tek_naam'];
            }
        }

        return $stringTekenaars;
    }


    private function getPDO()
    {
        return $this->pdo;
    }
}