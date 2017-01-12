<?php

class TekenaarLader
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
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