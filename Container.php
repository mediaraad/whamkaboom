<?php

class Container
{
    private $configuration;
    private $pdo;
    private $stripboekLader;

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
                $this->configuration['db_pass']
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
}