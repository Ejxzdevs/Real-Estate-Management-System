<?php 
require_once 'config/mysql.php';

class DisplayProduct extends MySQL {

    public function getAllProducts() {
        try {
            $stmt = parent::openConnection()->prepare("SELECT * FROM properties where is_deleted = 0");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        } finally {
            parent::closeConnection();
        }
    }

    public function recentProducts($limit) {
        try {
            $stmt = parent::openConnection()->prepare("SELECT * FROM properties where is_deleted = 0 ORDER BY date_added DESC LIMIT :limit");
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
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
