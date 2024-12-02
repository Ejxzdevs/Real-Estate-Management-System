<?php
require_once "../../http/helper/connectHelper.php";

class News extends MySQL {
    public function addNews($title, $content, $image) {
        try {
            $stmt = parent::openConnection()->prepare("INSERT INTO news (news_title, news_content, image) VALUES (:title, :content, :image)");

            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
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

    public function updateProduct($id, $name, $description, $address, $price, $status,$type ,$image) {
        try {
            $stmt = parent::openConnection()->prepare("UPDATE properties SET name = :name, description = :description, address = :address, price = :price, status = :status, transaction_type = :type , image = :image WHERE id = :id");

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':type', $type);
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

    public function deleteProduct($id) {
        try {
            $stmt = parent::openConnection()->prepare("UPDATE properties SET is_deleted = 1 WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
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
