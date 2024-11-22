<?php 
require_once '../../config/mysql.php';

class viewProduct extends MySQL{

    public function getDetails($id){
        try {
            $stmt = parent::openConnection()->prepare("SELECT * FROM properties where id = :id");
            $stmt->bindParam(':id', $id);
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