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

    // Number of Rent
    public function NumRentSell(){

        try {
            $stmt = parent::openConnection()->prepare("
            SELECT 
                SUM(CASE WHEN transaction_type = 'rent' THEN 1 ELSE 0 END) AS Total_Rent,
                SUM(CASE WHEN transaction_type = 'sell' THEN 1 ELSE 0 END) AS Total_Sell
            FROM properties WHERE is_deleted = 0
            ");
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
