<?php

class TekenaarLader
{
    private $pdo;
    private $tekenaar;
    private $lastName;

    public function __construct(PDO $pdo, $lastName = null)
    {
        $this->pdo = $pdo;
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }


    /**
     * @return tekenaars[]
     */
    public function getTekenaars($tekenaar)
    {
        $tekenaarsData = $this->queryForTekenaars($tekenaar);
        $tekenaars = array();
        foreach ($tekenaarsData as $tekenaarData) {
            $tekenaar = new Tekenaar();
            $tekenaar->setId($tekenaarData['tek_id']);
            $tekenaar->setAchterNaam($tekenaarData['tek_naam']);
            $this->setLastName($tekenaarData['tek_naam']);
            $tekenaar->setVoorNaam($tekenaarData['tek_voornaam']);
            $tekenaar->setAlias($tekenaarData['tek_alias']);
            $tekenaar->setGeboorteDatum($tekenaarData['tek_geboortedatum']);
            $tekenaar->setGeboorteLand($tekenaarData['tek_geboorteland']);
            $tekenaar->setRol($tekenaarData['tek_activiteit']);
            $tekenaar->setImage($tekenaarData['tek_image']);
            $tekenaar->setOpmerking($tekenaarData['tek_opmerking']);

            $tekenaars[] = $tekenaar;
        }
        //var_dump($tekenaars); die("help");
        return $tekenaars;
    }


    private function queryForTekenaars($tekenaar ="") {
        $pdo= $this->getPDO();
        $statement = $pdo->prepare('SELECT * FROM tekenaar_tbl WHERE tek_naam LIKE :achternaam ORDER BY tek_naam');
        if ($tekenaar=="") $naam="";
        else $naam=$tekenaar."%";
        $statement->bindParam(':achternaam',$naam, PDO::PARAM_STR);
        $statement->execute();
        $stripArray = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $stripArray;
    }


    /**
     * @return PDO
     */
    public function getPdo()
    {
        return $this->pdo;
    }

    /**
     * @param string $tekenaar
     * @return string
     */
    public function findTekenaarById($tekenaar)
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

}