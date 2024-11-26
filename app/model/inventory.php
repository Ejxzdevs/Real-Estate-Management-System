<?php 
require_once "../../http/helper/connectHelper.php";

class Inventory extends MySQL {
    public function addInventory($fullname ,$contact , $address , $id ,$method , $amount ,$change , $remark){
        try {
            $stmt = parent::openConnection()->prepare("INSERT INTO inventory (property_id, fullname, contact, address, payment_method ,amount ,`change` ,remark) 
            VALUES ( :property_id, :fullname, :contact, :address, :method , :amount , :change , :remark )");
            $stmt->bindParam(':property_id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':contact', $contact);
            $stmt->bindParam(':address', $address );
            $stmt->bindParam(':method', $method);
            $stmt->bindParam(':change', $change);
            $stmt->bindParam(':amount', $amount);
            $stmt->bindParam(':remark', $remark);
            $stmt->execute();
            return 200; // success
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false; // failure
        } finally {
            parent::closeConnection();
        }
    }
}