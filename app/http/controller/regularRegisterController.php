<?php 
require_once '../helper/csrf.php';
require_once '../../model/regularRegister.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || !CsrfHelper::validateToken($_POST['csrf_token'])) {
        http_response_code(403);
        echo "<script>alert('Invalid CSRF token! ')</script>";
        echo "<script> window.location.href='../../../index.php'</script>";
        exit();
    }
    CsrfHelper::regenerateToken();

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
