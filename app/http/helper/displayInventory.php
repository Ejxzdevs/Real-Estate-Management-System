<?php 
require_once 'config/mysql.php';

class DisplayInventory extends MySQL {

    public function getInventory() {
        try {
            $stmt = parent::openConnection()->prepare("
            SELECT 
            inventory.id AS inventory_id,  
                Properties.id AS property_id,   
                inventory.*, 
                Properties.*, 
                Properties.address AS property_address, 
                inventory.address AS inventory_address
            FROM inventory
            JOIN Properties ON inventory.property_id = Properties.id;
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

    public function latestTransactions() {
        try {
            $stmt = parent::openConnection()->prepare("
            SELECT 
                inventory.id AS inventory_id,  
                Properties.id AS property_id,   
                inventory.*, 
                Properties.*, 
                Properties.address AS property_address, 
                inventory.address AS inventory_address
                FROM inventory
                JOIN Properties ON inventory.property_id = Properties.id ORDER BY 
            inventory.date_added ASC LIMIT 5
            ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        } 
    }

    public function total_sales(){
        try{
            $stmt = parent::OpenConnection()->prepare("
            SELECT COUNT(*) As Total_Sales from inventory
            ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }finally {
            parent::closeConnection();
        }
    }

    
}
