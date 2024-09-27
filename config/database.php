<?php 

abstract class Database {
    protected $host;
    protected $user;
    protected $password;
    protected $dbname;

    // Constructor for setting common connection properties
    public function __construct($host, $user, $password, $dbname) {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->dbname = $dbname;
    }

    // Shared method for opening the connection
    public function openConnection() {
        echo "Opening connection to $this->dbname on $this->host.";
    }

    // Shared method for closing the connection
    public function closeConnection() {
        echo "Closing connection.";
    }

    // Abstract method for running queries, to be implemented by subclasses
    abstract public function runQuery($query);
}
