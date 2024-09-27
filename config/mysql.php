<?php 
require_once './database.php';
class MySQL extends Database {
    protected $host = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $dbname = "Enrollment_System";
    function __construct() {
        parent::__construct($this->host,$this->username,$this->password,$this->dbname); 
    }
}

new MySQL(); 

