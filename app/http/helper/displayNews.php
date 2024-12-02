<?php 
require_once 'config/mysql.php';

class DisplayNews extends MySQL {

    public function getAllNews() {
        try {
            $stmt = parent::openConnection()->prepare("SELECT * FROM news Where is_deleted = 0 ORDER BY id ASC");
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
