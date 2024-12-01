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
        }
    }

    public function getMonthlyRevenue(){
        try{
         $stmt = parent::OpenConnection()->prepare("
            SELECT 
            months.month,
            COALESCE(SUM(i.amount), 0) AS total_amount
            FROM 
                (SELECT 1 AS month UNION ALL 
                SELECT 2 UNION ALL 
                SELECT 3 UNION ALL 
                SELECT 4 UNION ALL 
                SELECT 5 UNION ALL 
                SELECT 6 UNION ALL 
                SELECT 7 UNION ALL 
                SELECT 8 UNION ALL 
                SELECT 9 UNION ALL 
                SELECT 10 UNION ALL 
                SELECT 11 UNION ALL 
                SELECT 12) AS months
            LEFT JOIN inventory i 
            ON MONTH(i.date_added) = months.month 
            AND YEAR(i.date_added) = 2024
            AND i.date_added BETWEEN '2024-01-01' AND '2024-12-31'
        GROUP BY 
            months.month
        ORDER BY 
            months.month;
         ");
         $stmt->execute();
         return $stmt->fetchAll(PDO::FETCH_ASSOC);

        }catch(PDOException $e){
            "Error" . $e->getMessage();
            return false;
        }finally {
            parent::closeConnection();
        }
    }

    
}
