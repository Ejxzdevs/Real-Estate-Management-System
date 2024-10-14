<?php 
require_once 'config/mysql.php';
class DisplayProduct extends MySQL {

    public function getAllProducts() {
        try {
            $stmt = parent::openConnection()->prepare("SELECT * FROM properties");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        } finally {
            parent::closeConnection();
        }
    }
}