<?php
class VeldenTekenaarTabel {

    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * @return array
     */


    public function getVeldenTekenaar() {
        $pdo= $this->getPDO();

        $statement = $pdo->prepare('DESCRIBE tekenaar_tbl');
        $statement->execute();
        $veldenArray = $statement->fetchAll(PDO::FETCH_COLUMN);



        return $veldenArray;


    }

    private function getPDO()
    {
        return $this->pdo;
    }
}

