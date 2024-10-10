<?php
// Include the web routes from the routes file
$routes = include 'routes/web.php';


// Default to home page`
$page = 'app/view/home.php'; // Default page

if (isset($_SESSION['user_type'])) {
    switch ($_SESSION['user_type']) {
        case 'admin':
            $page = 'app/view/dashboard.php';
            break;
        case 'regular':
            $page = 'app/view/home.php'; // This line is actually redundant
            break;
        // You could add more user types here if needed
    }
}

// At this point, $page will be set appropriately

// Check if the request is a GET request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $uri = parse_url($_SERVER['REQUEST_URI']);
    
    // Parse the query string
    if (isset($uri['query'])) {
        parse_str($uri['query'], $queryParams);
        
        // Check route
        $route = isset($queryParams['route']) ? htmlspecialchars($queryParams['route']) : null;
        
       
        // Check if the route exists
        if (array_key_exists($route, $routes)) {
          echo  $page = 'app/view/' . $routes[$route]; // Ensure the path is correct
        } else {
            // Trigger custom "page not found" handling
            $page = 'app/view/404.php'; // Include a custom 404 error page
        }
    }
}

