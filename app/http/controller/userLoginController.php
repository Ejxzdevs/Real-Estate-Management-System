<?php 
require_once '../../model/userLogin.php';
// user Login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo $username = htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8');
    echo $password = htmlspecialchars($_POST['password'] ?? '', ENT_QUOTES, 'UTF-8');

    $userFactory = new UserFactory();
    $user = $userFactory->findUser($username);

    if ($user && $user->authenticate($password)) {
        if ($user instanceof Admin) {
            header("Location: ../../../admin.php");
            exit();
        } else {
            header("Location: ../../../index.php");
            exit();
        }
    } else {
        echo "Authentication failed!";
    }
} else {
    echo "Please submit your login credentials.";
}
