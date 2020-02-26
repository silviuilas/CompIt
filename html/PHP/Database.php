<?php
class Database
{
    private $host;
    private $database;
    private $username;
    private $password;
    private $dbconnect;

    public function __construct()
    {
        $init_set=parse_ini_file('../configure/config.php');

        $this->host = $init_set['_MYSQL_HOST'];
        $this->database=$init_set['_MYSQL_DB'];
        $this->username = $init_set['_MYSQL_USER'];
        $this->password = $init_set['_MYSQL_PASS'];

    }
    public function connect()
    {
        // Fa conexiunea daca nu este deja facuta
        if (empty($this->dbconnect)) {

            $mysql = new mysqli($this->host, $this->username, $this->password, $this->database);

            if ($mysql->connect_errno) {
                throw new appError($mysql->connect_error);
            }
            $this->dbconnect = $mysql;
        }
        return $this->dbconnect;
    }

    public function query($query)
    {
        $db = $this->connect();
        $result = $db->query($query);

        if ($db->errno) return false;
        return $result;
    }

    public function select($query)
    {
        $rows = array();
        $result = $this->query($query);

        if ($result === false) return false;

        // Create array with results
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        return $rows;
    }
}