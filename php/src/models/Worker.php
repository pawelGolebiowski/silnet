<?php

/**
 * Class which makes a worker with CRUD functions.
 */
class Worker
{
    private $connection;
    private $tab = 'workers';
    private $current_date;
    private $modification_date;

    public $id;
    public $name;
    public $surname;
    public $company_name;
    public $add_date;
    public $mod_date;

    /**
     * Class constructor with database connection
     *
     * @param $db Variable to connected with the database.
     *
     */
    public function __construct($db)
    {
        $this->connection = $db;
    }

    /**
     * Function which creates a new worker.
     */
    public function create()
    {
        $this->current_date = date('Y-m-d h:i:s', time());
        $this->modification_date = $this->current_date;

        $query = 'INSERT INTO ' . $this->tab . '(name, surname, add_date, mod_date, company_id) VALUES (:name, :surname, \'' . $this->current_date . '\', \'' . $this->modification_date . '\', :company_id)';

        $stmt = $this->connection->prepare($query);

        // Clean input data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->surname = htmlspecialchars(strip_tags($this->surname));
        $this->company_id = htmlspecialchars(strip_tags($this->company_id));

        // Bind input data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':surname', $this->surname);
        $stmt->bindParam(':company_id', $this->company_id);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    /**
     * Read function which downloads all workers data.
     */
    public function read()
    {
        $query = 'SELECT c.company_name as company_name, w.id, w.name, w.surname, w.add_date, w.mod_date
                                FROM ' . $this->tab . ' w
                                LEFT JOIN
                                  company c ON w.company_id = c.id';

        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Function which update worker data by id.
     */
    public function update()
    {
        $this->modification_date = date('Y-m-d h:i:s', time());;

        $query = 'UPDATE ' . $this->tab . '
                                SET name = :name, surname = :surname, mod_date = \'' . $this->modification_date . '\', company_id = :company_id
                                WHERE id = :id';

        $stmt = $this->connection->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->surname = htmlspecialchars(strip_tags($this->surname));
        $this->company_id = htmlspecialchars(strip_tags($this->company_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':surname', $this->surname);
        $stmt->bindParam(':company_id', $this->company_id);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    /**
     * Function which delete worker data from database by id.
     */
    public function delete()
    {
        $query = 'DELETE FROM ' . $this->tab . ' WHERE id = :id';

        $stmt = $this->connection->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}