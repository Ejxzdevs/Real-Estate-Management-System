<?php
require_once "../../http/helper/connectHelper.php";

class Products extends MySQL {
    public function addProduct($name, $description, $address, $price, $status, $image) {
        try {
            $stmt = parent::openConnection()->prepare("INSERT INTO properties (name, description, address, price, status, image) VALUES (:name, :description, :address, :price, :status, :image)");

            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':image', $image);
            $stmt->execute();
            return 200;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        } finally {
            parent::closeConnection();
        }
    }

    public function updateProduct($id, $name, $description, $address, $price, $status, $image) {
        try {
            $stmt = parent::openConnection()->prepare("UPDATE properties SET name = :name, description = :description, address = :address, price = :price, status = :status, image = :image WHERE id = :id");

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':status', $status);
            echo $stmt->bindParam(':image', $image);
            $stmt->execute();
            return 200;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        } finally {
            parent::closeConnection();
        }
    }
}
