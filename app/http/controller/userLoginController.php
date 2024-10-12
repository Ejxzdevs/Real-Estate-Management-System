<?php 
require_once '../helper/csrfHelper.php';
require_once '../../model/userLogin.php';
// user Login
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

    $userFactory = new UserFactory();
    $user = $userFactory->findUser($username);
    if ($user && $user['user_password']->authenticate($password)) {
        $_SESSION['user_type'] = $user['user_type'];
        if ($user['user_type'] == "admin") {
            echo "<script>alert('Welcome Admin')</script>";
            echo "<script> window.location.href='../../../admin.php'</script>";
            exit();
        } elseif($user['user_type'] == "regular"){
            echo "<script>alert('Welcome User')</script>";
            echo "<script> window.location.href='../../../index.php'</script>";
            exit();
        }else{
            $_SESSION['user_type'] = null;
            header("Location: ../../../index.php");
            exit();
        }
    } else {
        echo "Authentication failed!";
    }
} else {
    echo "Please submit your login credentials.";
}
