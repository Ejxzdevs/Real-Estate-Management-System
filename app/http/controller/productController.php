<?php 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $name = htmlspecialchars($_POST['propertyName'] ?? '', ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars($_POST['propertyDescription'] ?? '', ENT_QUOTES, 'UTF-8');
    $address = htmlspecialchars($_POST['propertyAddress'] ?? '', ENT_QUOTES, 'UTF-8');
    $price = htmlspecialchars($_POST['propertyPrice'] ?? '', ENT_QUOTES, 'UTF-8');
    $status = htmlspecialchars($_POST['propertyStatus'] ?? '', ENT_QUOTES, 'UTF-8');
    
    // // Validate file upload
    $targetDir = "../../../public/images/products/";
    $imageName = basename($_FILES["propertyImage"]["name"]);
    $targetFile = $targetDir . $imageName;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image
    $check = getimagesize($_FILES["propertyImage"]["tmp_name"]);
    if ($check === false) {
        die("File is not an image.");
    }

    // Check file size (e.g., limit to 2MB)
    if ($_FILES["propertyImage"]["size"] > 2000000) {
        die("Sorry, your file is too large.");
    }

    // Allow certain file formats
    $allowedTypes = ['jpg', 'png', 'jpeg', 'gif'];
    if (!in_array($imageFileType, $allowedTypes)) {
        die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
    }

    // Move uploaded file to the target directory
    if (move_uploaded_file($_FILES["propertyImage"]["tmp_name"], $targetFile)) {
        // Prepare the SQL statement
        // $stmt = $pdo->prepare("INSERT INTO properties (name, description, address, price, status, image) VALUES (:name, :description, :address, :price, :status, :image)");

        // // Bind parameters
        // $stmt->bindParam(':name', $name);
        // $stmt->bindParam(':description', $description);
        // $stmt->bindParam(':address', $address);
        // $stmt->bindParam(':price', $price);
        // $stmt->bindParam(':status', $status);
        // $stmt->bindParam(':image', $imageName);

        // // Execute the statement
        // $stmt->execute();

        echo "Property added successfully!";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}