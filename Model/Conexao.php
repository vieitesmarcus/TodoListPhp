<?php

require __DIR__.'/../config/config.php';

abstract class Conexao
{
    protected PDO $connection;
    public function __construct()
    {
        try{
            return $this->connection = new PDO(
                "mysql:host=".CONF_DB_HOST.";dbname=".CONF_DB_NAME,
                CONF_DB_USER,
                CONF_DB_PASSWORD
            );

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getInstance(): PDO
    {
        return $this->connection;
    }
}

