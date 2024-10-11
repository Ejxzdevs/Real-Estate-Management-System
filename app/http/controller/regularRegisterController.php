<?php 
require_once '../../model/regularRegister.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST['password'] ?? '', ENT_QUOTES, 'UTF-8');
    $repassword = htmlspecialchars($_POST['rePassword'] ?? '', ENT_QUOTES, 'UTF-8');
    if($password !== $repassword){
        echo "<script>alert('password did not match')</script>";
    }else{
        if(strlen($username) > 6 && strlen($password) > 6){
            try {
                $createUser = new UserRegister();
                $result = $createUser->insertUser($username, $password);
                if($result == 200){
                    echo "<script>alert('User registered successfully!')</script>";
                    echo "<script> window.location.href='../../../index.php'</script>";
                }elseif($result == 409){
                    echo "<script>alert('User is already exist')</script>";
                    echo "<script> window.location.href='../../../index.php'</script>";
                }else{
                    echo "<script> window.location.href='../../../index.php'</script>";
                }
            } catch (Exception $e) {
                echo "<script>alert('Error: " . $e->getMessage() . "')</script>";
            }
        }else{
            echo "<script>alert('Password or Username should be greater than 6')</script>";
            echo "<script> window.location.href='../../../index.php'</script>";
        }
        
    }
}
