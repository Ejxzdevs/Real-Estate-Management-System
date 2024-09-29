<?php
// Include the routes from the routes file
$routes = include 'routes/web.php';

// Default to home page
$page = 'app/view/home.php';

// Check if the request is a GET request
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_SERVER['HTTP_REFERER'])) {
    $uri = parse_url($_SERVER['REQUEST_URI']);
    
    // Parse the query string
    if (isset($uri['query'])) {
        parse_str($uri['query'], $queryParams);
        
        // Check route
        $route = isset($queryParams['route']) ? htmlspecialchars($queryParams['route']) : 'home';
        
        // Check if the route exists
        if (array_key_exists($route, $routes)) {
            $page = 'app/view/' . $routes[$route]; // Ensure the path is correct
        } else {
            $page = '404.php'; // Redirect to a 404 page if not found
        }
    }
}

