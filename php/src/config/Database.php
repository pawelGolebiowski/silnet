<?php

/**
 * Class which establishes the database connection.
 */
class Database
{
    private $host = "db";
    private $db = "silnet";
    private $user = "root";
    private $pass = "MYSQL_ROOT_PASSWORD";
    private $connection;

    /**
     * Public function which creates a connection to a database using a PDO.
     */
    public function connect()
    {
        $this->connection = null;

        try {
            $this->connection = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db, $this->user, $this->pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->connection;
    }
}