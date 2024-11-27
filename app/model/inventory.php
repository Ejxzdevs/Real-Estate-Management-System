<?php 
require_once "../../http/helper/connectHelper.php";

class Inventory extends MySQL {
    // Method to add new inventory record
    public function addInventory($fullname ,$contact , $address , $id ,$method , $amount ,$change , $remark){
        try {
            $stmt = parent::openConnection()->prepare("INSERT INTO inventory (property_id, fullname, contact, address, payment_method ,amount ,`change` ,remark) 
            VALUES ( :property_id, :fullname, :contact, :address, :method , :amount , :change , :remark ) ");
       
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

    // Method to modify an existing inventory record
    public function modifyInventory($inventory_id, $fullname, $contact, $address, $id, $method, $amount, $change, $remark) {
        try {
            // Using UPDATE to modify an existing record
            $stmt = parent::openConnection()->prepare("UPDATE inventory 
            SET property_id = :property_id, fullname = :fullname, contact = :contact, address = :address, 
                payment_method = :method, amount = :amount, `change` = :change, remark = :remark
            WHERE id = :inventory_id");

            // Binding parameters
            $stmt->bindParam(':inventory_id', $inventory_id, PDO::PARAM_INT);
            $stmt->bindParam(':property_id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':contact', $contact);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':method', $method);
            $stmt->bindParam(':change', $change);
            $stmt->bindParam(':amount', $amount);
            $stmt->bindParam(':remark', $remark);

            // Executing the query
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
