<?php
// Include the web routes from the routes file
$routes = include 'routes/web.php';

// Default to home page`
$page = 'app/view/home.php';

if (isset($_SESSION['user_type'])) {
    switch ($_SESSION['user_type']) {
        case 'admin':
            $page = 'app/view/dashboard.php';
            break;
        case 'regular':
            $page = 'app/view/home.php'; 
            break;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $uri = parse_url($_SERVER['REQUEST_URI']);
    
    // Parse the query string
    if (isset($uri['query'])) {
        parse_str($uri['query'], $queryParams);
        
        // Check route
        $route = isset($queryParams['route']) ? htmlspecialchars($queryParams['route']) : null;
        
        // Check if the route exists
        if (array_key_exists($route, $routes)) {
            $page = 'app/view/' . $routes[$route]; // Ensure the path is correct
        } else {
            // Trigger custom "page not found" handling
            $page = 'app/view/404.php';
        }
    }
}

