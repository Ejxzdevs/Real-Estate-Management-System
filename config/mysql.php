<?php 
require_once 'database.php';
class MySQL extends Database {
    protected $MySqlHost = "localhost";
    protected $MySqlUsername ="root";
    protected $MySqlPassword = "";
    protected $MySqlDBName = "ggg";

    public function __construct() {
        parent::__construct($this->MySqlHost,$this->MySqlUsername,$this->MySqlPassword,$this->MySqlDBName); 
    }
    public function openMySqlConnection(){
        $this->OpenConnection();
    }
    public function closeMySqlConnection(){
       $this->CloseConnection();
    }
}


