<?php
require_once '../../../config/mysql.php';

class DisplayProduct extends MySQL {
    public function getFilteredProducts($filters) {
        try {
            $sql = "SELECT * FROM properties WHERE is_deleted = 0";
            $conditions = [];
            $params = [];

            // Filter by property name (partial match)
            if (!empty($filters['propertyName'])) {
                $conditions[] = "name LIKE :propertyName";
                $params[':propertyName'] = "%" . $filters['propertyName'] . "%";
            }

            // Filter by property address (partial match)
            if (!empty($filters['propertyAddress'])) {
                $conditions[] = "address LIKE :propertyAddress";
                $params[':propertyAddress'] = "%" . $filters['propertyAddress'] . "%";
            }

            // Filter by price (ensure it's numeric and use '<=' comparison)
            if (!empty($filters['propertyPrice']) && is_numeric($filters['propertyPrice'])) {
                $conditions[] = "price >= :propertyPrice";
                $params[':propertyPrice'] = $filters['propertyPrice'];
            }

            // Filter by property status
            if (!empty($filters['propertyStatus'])) {
                $conditions[] = "status = :propertyStatus";
                $params[':propertyStatus'] = $filters['propertyStatus'];
            }

            // Filter by transaction type
            if (!empty($filters['propertyTransactionType'])) {
                $conditions[] = "transaction_type = :propertyTransactionType";
                $params[':propertyTransactionType'] = $filters['propertyTransactionType'];
            }

            // If any filter conditions were added, append them to the SQL query
            if (count($conditions) > 0) {
                $sql .= " AND " . implode(" AND ", $conditions);
            }

            // Prepare the SQL statement
            $stmt = parent::openConnection()->prepare($sql);

            // Bind parameters to the prepared statement
            foreach ($params as $key => $value) {
                $stmt->bindParam($key, $value, PDO::PARAM_STR);
            }

            // Execute the statement
            $stmt->execute();

            // Fetch and return the results
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            // Handle errors gracefully and return JSON response
            header('Content-Type: application/json');
            echo json_encode(['error' => "Error: " . $e->getMessage()]);
        } finally {
            // Ensure the database connection is closed
            parent::closeConnection();
        }
    }
}

session_start();

if (isset($_POST['filter'])) {
    // Create an instance of the DisplayProduct class
    $getproducts = new DisplayProduct();
    
    // Capture the filter values from the POST request
    $filters = [
        'propertyName' => $_POST['propertyName'] ?? '',
        'propertyAddress' => $_POST['propertyAddress'] ?? '',
        'propertyPrice' => $_POST['propertyPrice'] ?? '',
        'propertyStatus' => $_POST['propertyStatus'] ?? '',
        'propertyTransactionType' => $_POST['propertyTransactionType'] ?? ''
    ];
    
    // Store the filters in the session
    $_SESSION['filter'] = $filters;

    // Get the filtered products
    $products = $getproducts->getFilteredProducts($filters);

    // Store the filtered products in the session
    $_SESSION['products'] = $products;
    
    // Redirect to properties page
    header("Location: ../../../index.php?route=properties");
    exit();
}

