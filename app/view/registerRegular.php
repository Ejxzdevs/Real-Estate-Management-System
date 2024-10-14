<?php 
session_start();
require_once '../http/helper/csrfHelper.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="../../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
</head>
    <style>
        body{
            height: 100vh;
            background-image: url("../../public/images/Backgrounds/Home_bg.jpg");
            background-size: cover; 
            background-position: center; 
            background-repeat: no-repeat;
        }
        body::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4); /* Dark overlay */
        z-index: 1; /* Ensure the overlay is on top of the background */

        }
        .custom-form{
            height: 420px;
            width: 420px;
            backdrop-filter: blur(5px);
            padding: 2rem;
            z-index: 10;
        }
    </style>
<body>
    <div class="h-100 d-flex justify-content-center align-items-center">
            <form action="../http/controller/regularRegisterController.php" method="post" class="border border-radius custom-form rounded-3 ">
                <div class="d-flex flex-column justify-content-center" style="height:20%">
                   <h1 class="text-center fw-bold text-white">Register</h1>
                </div>
                <div class="d-flex flex-column justify-content-center" style="height:20%">
                    <input type="hidden" name="csrf_token" value="<?php echo CsrfHelper::generateToken(); ?>">
                    <label class="form-label fw-medium text-white">Username</label>
                    <input type="name" name="username" class="form-control" placeholder="Enter your Username" required>
                </div>
                <div class="d-flex flex-column justify-content-center" style="height:20%">
                    <label class="form-label fw-medium text-white">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                </div>
                <div class="d-flex flex-column justify-content-center" style="height:20%">
                    <label class="form-label fw-medium text-white">Retype Password</label>
                    <input type="password" name="rePassword" class="form-control" placeholder="Retype your password" required>
                </div>
                <div class="d-flex flex-column justify-content-center" style="height:20%">
                    <button name="submit" class="btn btn-dark ">Submit</button>
                </div>
            </form>
    </div>
</body>
    <script src="../../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</html>