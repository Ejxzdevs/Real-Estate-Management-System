<?php 
require_once 'config/mysql.php';

class DisplayInquiries extends MySQL {

    public function getAllInquiries() {
        try {
            $stmt = parent::openConnection()->prepare("SELECT * FROM inquiries ORDER BY id ASC");
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
