<?php 
class Database {
    private $host;
    private $username;
    private $password;
    private $dbname;
    protected $conn;

    // Constructor to initialize properties
    protected function __construct($Host, $Username, $Password, $DBName) {
        $this->host = $Host;
        $this->username = $Username;
        $this->password = $Password;
        $this->dbname = $DBName;

        // Create a connection without selecting a database initially
        try {
            $this->conn = new PDO("mysql:host=$this->host", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Create the database if it doesn't exist
            $create_database = "CREATE DATABASE IF NOT EXISTS $this->dbname";
            $this->conn->exec($create_database);

            // Select the database for future operations
            $this->conn->exec("USE $this->dbname");
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    // OPEN CONNECTION
    protected function OpenConnection() {
        $this->conn; // Return the PDO connection
    }

    // CLOSE CONNECTION
    protected function CloseConnection() {
        $this->conn = null; // Close the connection
        echo "Connection closed.<br>";
    }
}
