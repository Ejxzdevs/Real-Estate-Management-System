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

        if ($this->userExists($this->username)) {
            return 409; // If there is a conflict in the request (like a duplicate entry).
        }
        try {
            $this->hashed_password = password_hash($this->password, PASSWORD_DEFAULT);
            $insert_account = "INSERT INTO user_account (username, password, user_type) VALUES (:name, :hashed_password, :type)";
            $stmt = parent::OpenConnection()->prepare($insert_account);
            $stmt->bindParam(':name', $this->username);
            $stmt->bindParam(':hashed_password', $this->hashed_password);
            $stmt->bindParam(':type', $this->userType);
            $stmt->execute();
            return 200;
        } catch (PDOException $e) {
            echo "<script>alert('Error: " . $e->getMessage() . "')</script>";
        } finally {
                parent::CloseConnection();
        }

    }
    // check user if exist
    private function userExists($username) {
        $select_account = "SELECT password FROM user_account WHERE username = :username"; 
        $stmt =  parent::OpenConnection()->prepare($select_account);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user > 0; // Returns true if user exists
    }



}