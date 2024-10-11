<?php 
require_once 'database.php';
class MySQL extends Database {
    protected $MySqlHost = "localhost";
    protected $MySqlUsername ="root";
    protected $MySqlPassword = "";
    protected $MySqlDBName = "RealEstateManagamentSystem";

   protected function __construct() {
        parent::__construct($this->MySqlHost,$this->MySqlUsername,$this->MySqlPassword,$this->MySqlDBName); 
    }
   protected function openMySqlConnection(){
        $this->__construct();
        $this->OpenConnection();
    }
   protected function closeMySqlConnection(){
        $this->__construct();
       $this->CloseConnection();
    }
}


