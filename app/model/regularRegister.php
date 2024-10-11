<?php 
require_once '../../../config/mysql.php';
class UserRegister extends MYSQL {
    private $username;
    private $password;
    private $hashed_password;
    private $userType = "regular";
    public function insertUser($username,$password){
        $this->username = $username;
        $this->password = $password;
        try {
            $this->openMySqlConnection();
            $this->hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
            $insert_account = "INSERT INTO user_account (username, password, user_type) VALUES (:name, :hashed_password, :type)";
            $stmt = $this->conn->prepare($insert_account);
            $stmt->bindParam(':name', $this->username);
            $stmt->bindParam(':hashed_password', $this->hashed_password);
            $stmt->bindParam(':type', $this->userType);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            $this->closeMySqlConnection();
        }

    }



}