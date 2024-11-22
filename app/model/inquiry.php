<?php 
require_once "../../http/helper/connectHelper.php";

class Inquiry extends MySQL {
    public function addInquiry($property_id , $name , $email , $number , $message){
        try {
            $stmt = parent::openConnection()->prepare("INSERT INTO inquiries (property_id, inquiry_name, inquiry_email, inquiry_number, inquiry_message) 
            VALUES (:property_id, :inquiry_name, :inquiry_email, :inquiry_number, :inquiry_message)");
    
            $stmt->bindParam(':property_id', $property_id);
            $stmt->bindParam(':inquiry_name', $name);
            $stmt->bindParam(':inquiry_email', $email);
            $stmt->bindParam(':inquiry_number', $number);
            $stmt->bindParam(':inquiry_message', $message);
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