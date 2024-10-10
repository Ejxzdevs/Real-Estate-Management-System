<?php 
    include "routes/router.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="public/assets/styles/global.css">
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
    <div class="container-fluid admin-container">
        <div class="row h-100 ">
            <div class="col-md-3 border">
                <h2>Column 1</h2>
                <?php require_once 'app/view/components/sidebar.php' ?>
            </div>
            <div class="col-md-9 border ">
                <h2>Column 2</h2>
                <?php require_once $page; ?>
            </div>
        </div>
    </div>
     <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
