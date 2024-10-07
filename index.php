<?php 
    include "routes/router.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Estate Management System</title>
    <link rel="stylesheet" href="public/assets/styles/global.css">
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
    <header>
        <?php $page == "app/view/404.php" ? null : require_once "app/view/components/nav.php"; ?>
    </header>
    <main>
        <?php require_once $page; ?>
    </main>
    <footer>
        <?php require_once "app/view/components/footer.php"; ?>
    </footer>
     <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
