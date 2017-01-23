<?php

class Container
{
    private $configuration;
    private $pdo;
    private $stripboekLader;
    private $tekenaarLader;
    private $veldenTekenaarLader;

    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @return PDO
     */
    public function getPDO()
    {

        if ($this->pdo === null) {
            $this->pdo = new PDO (
                $this->configuration['db_dsn'],
                $this->configuration['db_user'],
                $this->configuration['db_pass'],
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
                )
            );
            //$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$this->pdo->exec("SET NAMES 'utf8';");

            // Onderstaande regel kan niet, omdat de verbinding met de dB al gemaakt is
            // $this->pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAME 'utf8'");
            // de juiste code is:
            // $this->pdo = new PDO($this->dsn, $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        }

        return $this->pdo;
    }

    /**
     * @return StripboekLader
     */
    public function getStripboekLader()
    {
        if ($this->stripboekLader === null) {
            $this->stripboekLader = new StripboekLader($this->getPDO());
        }
        return $this->stripboekLader;
    }

    /**
     * @return TekenaarLader
     */
    public function getTekenaarLader()
    {
        if ($this->tekenaarLader === null) {
            $this->tekenaarLader = new TekenaarLader($this->getPDO());
        }
        return $this->tekenaarLader;
    }

    /**
     * @return veldenTekenaarTabel
     */
    public function getVeldenTekenaarTabel()
    {
        if ($this->veldenTekenaarTabel === null) {
            $this->veldenTekenaarTabel = new VeldenTekenaarTabel($this->getPDO());
        }
        return $this->veldenTekenaarTabel;
    }

}