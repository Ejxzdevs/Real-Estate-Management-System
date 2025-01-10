<?php
require_once '../../../config/mysql.php';

class DisplayProduct extends MySQL {
    public function getFilteredProducts($filters) {
        try {
            $sql = "SELECT * FROM properties WHERE is_deleted = 0";
            
            // Conditionally add filters if provided
            if (!empty($filters['propertyStatus'])) {
                $sql .= " AND status = :propertyStatus";
            }
            if (!empty($filters['propertyTransactionType'])) {
                $sql .= " AND transaction_type = :propertyTransactionType";
            }
            if (!empty($filters['propertyName'])) {
                $sql .= " AND name LIKE :propertyName";
            }
            if (!empty($filters['propertyPrice'])) {
                $sql .= " AND price >= :propertyPrice";
            }
            if (!empty($filters['propertyAddress'])) {
                $sql .= " AND address LIKE :propertyAddress";
            }
            
            // Prepare the SQL statement
            $stmt = parent::openConnection()->prepare($sql);

            // Bind parameters to avoid SQL injection
            if (!empty($filters['propertyStatus'])) {
                $stmt->bindParam(':propertyStatus', $filters['propertyStatus'], PDO::PARAM_STR);
            }
            if (!empty($filters['propertyTransactionType'])) {
                $stmt->bindParam(':propertyTransactionType', $filters['propertyTransactionType'], PDO::PARAM_STR);
            }
            if (!empty($filters['propertyName'])) {
                $stmt->bindValue(':propertyName', '%' . $filters['propertyName'] . '%', PDO::PARAM_STR);
            }
            if (!empty($filters['propertyPrice'])) {
                $stmt->bindParam(':propertyPrice', $filters['propertyPrice'], PDO::PARAM_INT);
            }
            if (!empty($filters['propertyAddress'])) {
                $stmt->bindValue(':propertyAddress', '%' . $filters['propertyAddress'] . '%', PDO::PARAM_STR);
            }

            // Execute the statement
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            // Handle errors gracefully and return JSON response
            header('Content-Type: application/json');
            echo json_encode(['error' => "Error: " . $e->getMessage()]);
        } finally {
            parent::closeConnection();
        }
    }
}

session_start();

if (isset($_POST['filter'])) {

    $getproducts = new DisplayProduct();
    
    // Capture the filter values from the POST request
    $filters = [
        'propertyName' => isset($_POST['propertyName']) ? trim($_POST['propertyName']) : '',
        'propertyAddress' => isset($_POST['propertyAddress']) ? trim($_POST['propertyAddress']) : '',
        'propertyPrice' => isset($_POST['propertyPrice']) && is_numeric($_POST['propertyPrice']) ? (int) $_POST['propertyPrice'] : 0,
        'propertyStatus' => isset($_POST['propertyStatus']) ? trim($_POST['propertyStatus']) : '',
        'propertyTransactionType' => isset($_POST['propertyTransactionType']) ? trim($_POST['propertyTransactionType']) : ''
    ];

    // Store the filters in the session
    $_SESSION['filter'] = $filters;

    // Get the filtered products
    $products = $getproducts->getFilteredProducts($filters);

    // Store the filtered products in the session
    $_SESSION['products'] = $products;

    header("Location: ../../../index.php?route=properties");
    exit();
}
