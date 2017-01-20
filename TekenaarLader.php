<?php

class TekenaarLader
{
    private $pdo;
    //private $tekenaar;
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
            $teken = new Tekenaar();
            $teken->setId($tekenaarData['tek_id']);
            $teken->setAchterNaam($tekenaarData['tek_naam']);
            $this->setLastName($tekenaarData['tek_naam']);
            $teken->setVoorNaam($tekenaarData['tek_voornaam']);
            $teken->setAlias($tekenaarData['tek_alias']);
            $teken->setGeboorteDatum($tekenaarData['tek_geboortedatum']);
            $teken->setGeboorteLand($tekenaarData['tek_geboorteland']);
            $teken->setRol($tekenaarData['tek_activiteit']);
            $teken->setImage($tekenaarData['tek_image']);
            $teken->setOpmerking($tekenaarData['tek_opmerking']);

            $tekenaars[] = $teken;
        }
        //var_dump($tekenaars); die("help");
        return $tekenaars;
    }


    /**
     * @param string $tekenaar
     * @return array
     */
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


    /** CrUd
     *
     * @param $id
     * @param $naam
     * @param $voornaam
     * @param $alias
     * @param $datum
     * @param $land
     * @param $rol
     * @param $image
     * @param $opmerking
     * @return bool
     */
    public function createOrUpdateTekenaar($id,$naam,$voornaam,$alias,$datum,$land,$rol,$image,$opmerking)
    {
        $pdo = $this->getPDO();
        try
        {
            if ($id=='') {
                $stmt = $pdo->prepare("INSERT INTO tekenaar_tbl (tek_naam,tek_voornaam,tek_alias,tek_geboortedatum,tek_geboorteland,tek_activiteit,tek_image,tek_opmerking) VALUES(:naam, :voornaam, :alias, :datum, :land, :rol, :image, :opmerking)");
            }
            else {
                $stmt=$pdo->prepare("UPDATE tekenaar_tbl SET
                    tek_naam=:naam,
                    tek_voornaam=:voornaam,
                    tek_alias=:alias,
                    tek_geboortedatum=:datum,
                    tek_geboorteland=:land,
                    tek_activiteit=:rol,
                    tek_image=:image,
                    tek_opmerking=:opmerking WHERE id=:id ");
                $stmt->bindparam(":id",$id);
            }

            $stmt->bindparam(":naam",$naam);
            $stmt->bindparam(":voornaam",$voornaam);
            $stmt->bindparam(":alias",$alias);
            $stmt->bindparam(":datum",$datum);
            $stmt->bindparam(":land",$land);
            $stmt->bindparam(":rol",$rol);
            $stmt->bindparam(":image",$image);
            $stmt->bindparam(":opmerking",$opmerking);
            $stmt->execute();
            return true;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }

    }


    /** cruD
     *
     * @param $id
     * @return bool
     */
    public function deleteTekenaar($id)
    {
        $pdo = $this->getPDO();
        $stmt = $pdo->prepare("DELETE FROM tekenaar_tbl WHERE id=:id");
        $stmt->bindparam(":id",$id);
        $stmt->execute();
        return true;
    }




}