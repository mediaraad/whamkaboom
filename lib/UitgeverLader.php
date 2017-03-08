<?php

class UitgeverLader
{

    private $pdo;
    private $naam;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * @return uitgevers[]
     */
    public function getUitgever($naam)
    {
        $uitgeversData = $this->queryForUitgever($naam);
        $uitgevers = array();
        foreach ($uitgeversData as $uitgeverData) {
            $uitgever= new Uitgever();

            $uitgever->setId($uitgeverData['uitgever_id']);
            $uitgever->setNaam($uitgeverData['uitgever_naam']);
            $uitgever->setAdres($uitgeverData['uitgever_adres']);
            $uitgever->setOpmerking($uitgeverData['uitgever_opmerking']);
/*
            echo '<pre>';
            print_r($uitgever);
            echo '</pre>';
*/
            $uitgevers[] = $uitgever;
        }

        return $uitgevers;
    }


    /**
     * @return uitgevers[]
     */
    public function getUitgeverByID($id)
    {
        $uitgeversData = $this->queryForUitgeverByID($id);
        $uitgevers = array();
        foreach ($uitgeversData as $uitgeverData) {
            // maak objecten mbv uitgeversData
            $uitgever= new Uitgever();

            $uitgever->setId($uitgeverData['uitgever_id']);
            $uitgever->setNaam($uitgeverData['uitgever_naam']);
            $uitgever->setAdres($uitgeverData['uitgever_adres']);
            $uitgever->setOpmerking($uitgeverData['uitgever_opmerking']);
            /*
                        echo '<pre>';
                        print_r($uitgever);
                        echo '</pre>';
            */
            $uitgevers[] = $uitgever;
        }

        return $uitgevers[0]; //is er maar 1
    }

    private function queryForUitgeverByID($id) {
        $pdo= $this->getPDO();
        $statement = $pdo->prepare("SELECT * FROM uitgever_tbl WHERE uitgever_id = :uitgever_id  ");
        $statement->bindParam(':uitgever_id',$id, PDO::PARAM_STR);
        $statement->execute();
        $uitgeverArray = $statement->fetchAll(PDO::FETCH_ASSOC); // FETCH_ASSOC, FETCH_CLASS, FETCH_OBJ

        return $uitgeverArray;
    }




    private function queryForUitgever($uitgever ="") {
        $pdo= $this->getPDO();
        $statement = $pdo->prepare('SELECT * FROM uitgever_tbl WHERE uitgever_naam LIKE :naam ORDER BY uitgever_naam');
        if ($uitgever=="") $naam="";
        else $naam=$uitgever."%";
        $statement->bindParam(':naam',$naam, PDO::PARAM_STR);
        $statement->execute();
        $uitgeverArray = $statement->fetchAll(PDO::FETCH_ASSOC); // FETCH_ASSOC, FETCH_CLASS, FETCH_OBJ

        return $uitgeverArray;
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