<?php 
require_once '../helper/csrfHelper.php';
require_once '../../model/products.php';
// Insert Products
class ProductsController {
    private $model;

    public function __construct(Products $model) {
        $this->model = $model;
    }

    public function createProduct($data, $file) {
        // Sanitize input
        $name = htmlspecialchars($data['propertyName'] ?? '', ENT_QUOTES, 'UTF-8');
        $description = htmlspecialchars($data['propertyDescription'] ?? '', ENT_QUOTES, 'UTF-8');
        $address = htmlspecialchars($data['propertyAddress'] ?? '', ENT_QUOTES, 'UTF-8');
        $price = htmlspecialchars($data['propertyPrice'] ?? '', ENT_QUOTES, 'UTF-8');
        $status = htmlspecialchars($data['propertyStatus'] ?? '', ENT_QUOTES, 'UTF-8');

        // Validate file upload
        $targetDir = "../../../public/images/products/";
        $imageName = basename($file["propertyImage"]["name"]);
        $targetFile = $targetDir . $imageName;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $tempFile = $file["propertyImage"]["tmp_name"];

        // Check if image file is a actual image
        if (!is_uploaded_file($tempFile)) {
            throw new Exception("File upload failed or no file was uploaded.");
        }
        
        if (getimagesize($tempFile) === false) {
            throw new Exception("File is not an image.");
        }

        // Check file size (limit to 20MB)
        if ($file["propertyImage"]["size"] > 20000000) {
            throw new Exception("Sorry, your file is too large.");
        }

        // Allow certain file formats
        $allowedTypes = ['jpg', 'png', 'jpeg', 'gif'];
        if (!in_array($imageFileType, $allowedTypes)) {
            throw new Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        }

        // Move uploaded file to the target directory
        if (!move_uploaded_file($tempFile, $targetFile)) {
            throw new Exception("Sorry, there was an error uploading your file. Error code: " . $file["propertyImage"]["error"]);
        }

        // Add product using the model
        return $this->model->addProduct($name, $description, $address, $price, $status, $imageName);
    }
}

// Handle the POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create or Add property
    if(isset($_POST['insert'])){
        try {
            $productModel = new Products();
            $productController = new ProductsController($productModel);
            $result_status = $productController->createProduct($_POST, $_FILES);
            
            if ($result_status === 200) {
                echo "<script>alert('Product successfully added')</script>";
                echo "<script> window.location.href='../../../admin.php?route=product'</script>";
            } else {
                echo "Failed to insert property.";
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    if(isset($_POST['update'])){

    }
}
