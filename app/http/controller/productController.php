<?php 
require_once '../helper/csrfHelper.php';
require_once '../../model/products.php';

class ProductsController {
    private $model;

    public function __construct(Products $model) {
        $this->model = $model;
    }

    private function sanitizeInput($data) {
        return array_map(function($value) {
            return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
        }, $data);
    }

    private function validateFile($file) {
        $targetDir = "../../../public/images/products/";
        $imageName = basename($file["propertyImage"]["name"]);
        $targetFile = $targetDir . $imageName;
        $tempFile = $file["propertyImage"]["tmp_name"];
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if (!is_uploaded_file($tempFile) || getimagesize($tempFile) === false) {
            throw new Exception("Invalid file upload.");
        }
        if ($file["propertyImage"]["size"] > 20000000) {
            throw new Exception("File is too large.");
        }
        if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
            throw new Exception("Invalid file format.");
        }
        if (!move_uploaded_file($tempFile, $targetFile)) {
            throw new Exception("Error uploading file. Error code: " . $file["propertyImage"]["error"]);
        }
        
        return $imageName;
    }

    public function createProduct($data, $file) {
        $sanitizedData = $this->sanitizeInput($data);
        $imageName = $this->validateFile($file);
        return $this->model->addProduct($sanitizedData['propertyName'], $sanitizedData['propertyDescription'], 
                                         $sanitizedData['propertyAddress'], $sanitizedData['propertyPrice'], 
                                         $sanitizedData['propertyStatus'], $imageName);
    }

    public function updateProduct($data, $file) {
        $sanitizedData = $this->sanitizeInput($data);
        $imageName = $sanitizedData['prePropertyImage'];

        if ($file["propertyImage"]["tmp_name"]) {
            $imageName = $this->validateFile($file);
        }

        return $this->model->updateProduct($sanitizedData['id'], $sanitizedData['propertyName'], 
                                            $sanitizedData['propertyDescription'], $sanitizedData['propertyAddress'], 
                                            $sanitizedData['propertyPrice'], $sanitizedData['propertyStatus'], $imageName);
    }

    public function deleteProduct($data) {
        $id = filter_var($data['id'] ?? '', FILTER_SANITIZE_NUMBER_INT);
        return $this->model->deleteProduct($id);
    }
}

// Handle the POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST['csrf_token']) || !CsrfHelper::validateToken($_POST['csrf_token'])) {
        http_response_code(403);
        echo "<script>alert('Invalid CSRF token!')</script>";
        echo "<script>window.location.href='../../../index.php'</script>";
        exit();
    }
    
    CsrfHelper::regenerateToken();
    $productModel = new Products();
    $productController = new ProductsController($productModel);

    try {
        if (isset($_POST['insert'])) {
            $result_status = $productController->createProduct($_POST, $_FILES);
            echo $result_status === 200 
                ? "<script>alert('Product successfully added')</script><script>window.location.href='../../../admin.php?route=product'</script>"
                : "<script>alert('Failed to insert property')</script>";
        }

        if (isset($_POST['update'])) {
            $result_status = $productController->updateProduct($_POST, $_FILES);
            echo $result_status === 200 
                ? "<script>alert('Product successfully updated')</script><script>window.location.href='../../../admin.php?route=product'</script>"
                : "<script>alert('Failed to update property')</script>";
        }

        if (isset($_POST['delete'])) {
            $result_status = $productController->deleteProduct($_POST);
            echo $result_status === 200 
                ? "<script>alert('Product successfully deleted')</script><script>window.location.href='../../../admin.php?route=product'</script>"
                : "<script>alert('Failed to delete property')</script>";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
