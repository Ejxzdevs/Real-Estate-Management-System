<?php 
    session_start();
    include "routes/router.php"; 
    echo $_SESSION['user_type'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="public/assets/styles/global.css">
    <link rel="stylesheet" href="public/assets/styles/sidebar.css">
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
    <div class="container-fluid admin-container p-0">
        <aside class="border" style="width: 20%;" >
                <?php require_once 'app/view/components/sidebar.php' ?>
        </aside>
        <main class="mainContainer" style="width: 80%;"> 
            <header class="admin-header">
                <h1>its a header</h1>
            </header>
            <section class="border">
                <?php require_once $page ; ?>
            </section>
        </main>
    </div>
     <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
