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

    public function modifiedNews($id, $title, $content, $image) {
        try {
            $stmt = parent::openConnection()->prepare("UPDATE news SET news_title = :title, news_content = :content ,image = :image WHERE id = :id");

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
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

    public function deleteNews($id) {
        try {
            $stmt = parent::openConnection()->prepare("UPDATE news SET is_deleted = 0 WHERE id = :id");
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
