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
}
