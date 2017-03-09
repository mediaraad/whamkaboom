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
            //$stripboek->setTitle($stripboekData['stripheld_titelalbum']);
            $stripboek->setTitle($stripboekData['COUNT(stripheld_id)']);
            $stripboek->setJaaruitgave($stripboekData['stripheld_jaaruitgave']);
            $stripboek->setTekenaar($stripboekData['stripheld_tekenaar']);
            $stripboek->setSchrijver($stripboekData['stripheld_schrijver']);
            $stripboek->setDeel($stripboekData['stripheld_deel']);
            $stripboek->setCbr($stripboekData['stripheld_reeks']);

            $stripboeken[] = $stripboek;
        }

        return $stripboeken;
    }

    private function queryForStripboek($held ="") {
        $pdo= $this->getPDO();
        $statement = $pdo->prepare('SELECT *,COUNT(stripheld_id) FROM stripheld_tbl WHERE stripheld_held LIKE :held group by stripheld_held  ORDER BY stripheld_held,stripheld_deel');
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
    public function findTekenaarInStringById($tekenaar,$schrijver)
    {
        $pdo = $this->getPDO();
        if ($tekenaar==0) $auteur=$schrijver;
        else $auteur=$tekenaar;

        $stringAuteur = "";
        if ($auteur != '') {                    // tekenaar(s) genoemd

            if (strpos($auteur, ',') > 0) {    // er zijn meerdere tekenaars genoemd
                $auteurs = explode(',', $auteur);
                $aantalAuteurs = count($auteurs);
            } else {                                            // 1 tekenaar genoemd
                //var_dump($auteur); die;
                $aantalAuteurs = 1;
                $auteurs[0] = $auteur;
            }

            for ($i = 0; $i <= $aantalAuteurs - 1; $i++) {                // echo de tekenaars die correleren met id
                $statement = $pdo->prepare('SELECT tek_naam, tek_voornaam from tekenaar_tbl where tek_id= :id');
                $statement->execute(array('id' => $auteurs[$i]));
                $arrayAuteur = $statement->fetch(PDO::FETCH_ASSOC);
                if ($aantalAuteurs > 1) {
                    if ($i == $aantalAuteurs - 1) $stringAuteur .= $arrayAuteur['tek_voornaam'] . " " . $arrayAuteur['tek_naam'];
                    else $stringAuteur .= $arrayAuteur['tek_voornaam'] . " " . $arrayAuteur['tek_naam'] . ", ";
                } else $stringAuteur .= $arrayAuteur['tek_voornaam'] . " " . $arrayAuteur['tek_naam'];
            }
        }

        return $stringAuteur;
    }


    private function getPDO()
    {
        return $this->pdo;
    }
}