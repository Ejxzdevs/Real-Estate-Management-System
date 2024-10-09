<?php 
require_once '../../../config/mysql.php';
interface UserType {
    public function authenticate($password);
}
class Admin implements UserType {
    private $password;
    public function __construct($password) {
        $this->password = $password;
    }
    public function authenticate($password) {
        return password_verify($password, $this->password);
    }
}
class RegularUser implements UserType {
    private $password;

    public function __construct($password) {
        $this->password = $password;
    }

    public function authenticate($password) {
        return password_verify($password, $this->password);
    }
}
class UserFactory extends MySQL {
    public function findUser($username) {
        parent::__construct();
        try {
            $this->openMySqlConnection();
            $select_username = "SELECT password, user_type FROM user_account WHERE username = :username";
            $stmt = $this->conn->prepare($select_username);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user) {
                return $user['user_type'] === 'admin' ? new Admin($user['password']) : new RegularUser($user['password']);
            }
            return null;

        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
        } finally {
            $this->closeMySqlConnection();
        }
    }
}