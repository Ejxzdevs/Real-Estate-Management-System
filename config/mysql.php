<?php 
require_once 'database.php';
class MySQL extends Database {
   private $MySqlHost = "localhost";
   private $MySqlUsername ="root";
   private $MySqlPassword = "";
   private $MySqlDBName = "RealEstateManagamentSystemtest";
    public function __construct() {
        parent::__construct($this->MySqlHost,$this->MySqlUsername,$this->MySqlPassword,$this->MySqlDBName); 
    }
  
}




