<?php

class AjaxAutoComplete {
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }






    /**
     * @return PDO
     */
    public function getPDO()
    {
        return $this->pdo;
    }


}
