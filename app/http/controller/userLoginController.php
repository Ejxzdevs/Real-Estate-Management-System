<?php 
require_once '../../model/userLogin.php';
session_start();
// user Login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo $username = htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8');
    echo $password = htmlspecialchars($_POST['password'] ?? '', ENT_QUOTES, 'UTF-8');

    $userFactory = new UserFactory();
    $user = $userFactory->findUser($username);

    if ($user && $user->authenticate($password)) {
        if ($user instanceof Admin) {
            $_SESSION['user_type'] = get_class($user);
            header("Location: ../../../admin.php");
            exit();
        } elseif($user instanceof RegularUser){
            $_SESSION['user_type'] = get_class($user);
            header("Location: ../../../index.php");
            exit();
        }else{
            $_SESSION['user_type'] = null;
            header("Location: ../../../index.php");
        }
    } else {
        echo "Authentication failed!";
    }
} else {
    echo "Please submit your login credentials.";
}
