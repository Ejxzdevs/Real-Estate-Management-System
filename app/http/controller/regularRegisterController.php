<?php 
require_once '../../model/regularRegister.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST['password'] ?? '', ENT_QUOTES, 'UTF-8');
    $repassword = htmlspecialchars($_POST['rePassword'] ?? '', ENT_QUOTES, 'UTF-8');

    if($password !== $repassword){
        echo "<script>alert('password did not match')</script>";
    }else{
        echo "match";
    }
}
