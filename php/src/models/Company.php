<?php

/**
 * Class which makes a company with CRUD functions.
 */
class Company
{
    private $connection;
    private $tab = 'company';
    private $current_date;
    private $modification_date;

    public $id;
    public $company_name;
    public $add_date;
    public $mod_date;
    public $logo;

    /**
     * Class constructor with database connection
     *
     * @param $db Variable to connected to the database.
     *
     */
    public function __construct($db)
    {
        $this->connection = $db;
    }

    /**
     * Function which creates a new company.
     */
    public function create()
    {
        $this->current_date = date('Y-m-d h:i:s', time());
        $this->modification_date = $this->current_date;

        $query = 'INSERT INTO ' . $this->tab . '(company_name, add_date, mod_date) VALUES (:company_name, \'' . $this->current_date . '\', \'' . $this->modification_date . '\')';

        $stmt = $this->connection->prepare($query);

        $this->company_name = htmlspecialchars(strip_tags($this->company_name));

        $stmt->bindParam(':company_name', $this->company_name);
        //$stmt->bindParam(':logo', $this->logo);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    /**
     * Read function which downloads company data.
     */
    public function read()
    {
        $query = 'SELECT id, company_name, add_date, mod_date, logo FROM ' . $this->tab;

        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Read function which downloads only one company data by id.
     */
    public function get_single_company()
    {
        $query = 'SELECT id, company_name, add_date, mod_date, logo FROM ' . $this->tab . ' WHERE id = ? LIMIT 0,1';

        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->company_name = $row['company_name'];
        $this->add_date = $row['add_date'];
        $this->mod_date = $row['mod_date'];
        $this->logo = $row['logo'];
    }

    /**
     * Function which update company data by id.
     */
    public function update()
    {
        $this->modification_date = date('Y-m-d h:i:s', time());;

        $query = 'UPDATE ' . $this->tab . '
                                SET company_name = :company_name, mod_date = \'' . $this->modification_date . '\'
                                WHERE id = :id';

        $stmt = $this->connection->prepare($query);

        $this->company_name = htmlspecialchars(strip_tags($this->company_name));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':company_name', $this->company_name);
        //$stmt->bindParam(':logo', $this->logo);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    /**
     * Function which delete company data from database by id.
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