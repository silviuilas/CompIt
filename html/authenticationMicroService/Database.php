<?php
class Database
{
    private static $databaseObj;
    private $host;
    private $database;
    private $username;
    private $password;
    private $dbconnect;

    private function __construct()
    {
        $init_set=parse_ini_file('access.php');

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

            try {
                if ($mysql->connect_errno) {
                    throw new Exception($mysql->connect_error);
                }
            }
            catch (Exception $err)
            {
                echo 'Error at establishing connection'. $err->getMessage();
            }

            $this->dbconnect = $mysql;
        }
        return $this->dbconnect;
    }

    public function query($query)
    {
        if(empty($this->dbconnect))
            $this->connect();
        $query=mysqli_real_escape_string($this->dbconnect,$query);
        $query=stripslashes($query);
        $result = $this->dbconnect->query($query);

        if ($this->dbconnect->errno) return false;
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

    public function queryArray($interrogation,$limit){
        $query = $this->query($interrogation);
        $i=0;
        $table=[];
        while(($row=mysqli_fetch_row($query))!=NULL && $i<$limit) {
            $table[$i]=$row;
            $i++;
        }
        return $table;
    }
    /**
     * @return mixed
     */
    /**
     * @return Database
     */
    public static function getDatabaseObj()
    {
        if(self::$databaseObj==null)
             self::$databaseObj=new Database();
        return self::$databaseObj;
    }
    public function getDbconnect()
    {
        return $this->dbconnect;
    }
}