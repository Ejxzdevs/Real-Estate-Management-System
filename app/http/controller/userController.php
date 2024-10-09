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
            // Log error instead of echo
            error_log("Database error: " . $e->getMessage());
            return null;
        } finally {
            $this->closeMySqlConnection(); // Ensure connection is closed
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo $username = htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8');
    echo $password = htmlspecialchars($_POST['password'] ?? '', ENT_QUOTES, 'UTF-8');

    $userFactory = new UserFactory();
    $user = $userFactory->findUser($username);

    if ($user && $user->authenticate($password)) {
        if ($user instanceof Admin) {
            // header("Location: /admin_page.php");
            // exit();
            echo "admin pages";
        } else {
            // header("Location: /regular_page.php");
            // exit();
            echo "regular user pages";
        }
    } else {
        echo "Authentication failed!";
    }
} else {
    echo "Please submit your login credentials.";
}
