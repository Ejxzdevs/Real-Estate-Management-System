<?php 
require_once '../../model/regularRegister.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST['password'] ?? '', ENT_QUOTES, 'UTF-8');
    $repassword = htmlspecialchars($_POST['rePassword'] ?? '', ENT_QUOTES, 'UTF-8');
    if($password !== $repassword){
        echo "<script>alert('password did not match')</script>";
    }else{
        if(!empty($username) && !empty($password)){
            try {
                $createUser = new UserRegister();
                $createUser->insertUser($username, $password);
                echo "<script>alert('User registered successfully!')</script>";
                echo "<script> window.location.href='../../../index.php'</script>";
            } catch (Exception $e) {
                echo "<script>alert('Error: " . $e->getMessage() . "')</script>";
            }
        }else{
            echo "password or username is empty";
        }
        
    }
}
