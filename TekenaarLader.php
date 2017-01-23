<?php

class TekenaarLader
{
    private $pdo;
    //private $tekenaar;
    private $lastName;
    const TYPE_TEKENAAR = "tekenaar";
    const TYPE_SCHRIJVER = "schrijver";
    const TYPE_BEIDE = "beiden";

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
    public function getTekenaars($tekenaar,$id="")
    {
        $tekenaarsData = $this->queryForTekenaars($tekenaar,$id);
        $velden = $this->getVeldenTekenaar();
        $tekenaars = array();

        foreach ($tekenaarsData as $tekenaarData) {
            $teken = new Tekenaar();
            $teken->setId($tekenaarData[$velden[0]]);
            $teken->setAchterNaam($tekenaarData[$velden[1]]);
            $this->setLastName($tekenaarData[$velden[1]]);
            $teken->setVoorNaam($tekenaarData[$velden[2]]);
            $teken->setAlias($tekenaarData[$velden[3]]);
            $teken->setGeboorteDatum($tekenaarData[$velden[4]]);
            $teken->setGeboorteLand($tekenaarData[$velden[5]]);
            $teken->setRol($tekenaarData[$velden[6]]);
            $teken->setImage($tekenaarData[$velden[7]]);
            $teken->setOpmerking($tekenaarData[$velden[8]]);


            $tekenaars[] = $teken;
        }

        return $tekenaars;
    }

    public function getVeldenTekenaar() {
        $pdo= $this->getPDO();

        $statement = $pdo->prepare('DESCRIBE tekenaar_tbl');
        $statement->execute();
        $veldenArray = $statement->fetchAll(PDO::FETCH_COLUMN);

        //$object = (object) $veldenArray;

        //var_dump($object);die;
        return $veldenArray;
    }



    /**
     * @param string $tekenaar
     * @return array
     */
    private function queryForTekenaars($tekenaar, $id) {
        $pdo= $this->getPDO();
        if ($id == null) {
            $statement = $pdo->prepare('SELECT * FROM tekenaar_tbl WHERE tek_naam LIKE :achternaam ORDER BY tek_naam');
            if ($tekenaar=="") $naam="";
            else $naam=$tekenaar."%";
            $statement->bindParam(':achternaam',$naam, PDO::PARAM_STR);
        }
        else {
            $statement = $pdo->prepare('SELECT * FROM tekenaar_tbl WHERE tek_id = :id');
            $statement->bindParam(':id',$id, PDO::PARAM_INT);
        }

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