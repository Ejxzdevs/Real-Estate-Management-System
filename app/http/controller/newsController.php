<?php 
require_once '../helper/csrfHelper.php';
require_once '../../model/news.php';

class NewsController {
    private $model;

    public function __construct(News $model) {
        $this->model = $model;
    }

    private function sanitizeInput($data) {
        return array_map(function($value) {
            return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
        }, $data);
    }

    private function validateFile($file) {
        $targetDir = "../../../public/images/products/";
        $imageName = basename($file["newsImage"]["name"]);
        $targetFile = $targetDir . $imageName;
        $tempFile = $file["newsImage"]["tmp_name"];
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if (!is_uploaded_file($tempFile) || getimagesize($tempFile) === false) {
            throw new Exception("Invalid file upload.");
        }
        if ($file["newsImage"]["size"] > 20000000) {
            throw new Exception("File is too large.");
        }
        if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
            throw new Exception("Invalid file format.");
        }
        if (!move_uploaded_file($tempFile, $targetFile)) {
            throw new Exception("Error uploading file. Error code: " . $file["newsImage"]["error"]);
        }
        
        return $imageName;
    }

    public function createNews($data, $file) {
        $sanitizedData = $this->sanitizeInput($data);
        $imageName = $this->validateFile($file);
        return $this->model->addNews($sanitizedData['title'], $sanitizedData['content'], 
                                        $imageName
                                        );
    }

    public function updateNews($data, $file) {
        print_r($data);
        print_r($file);
        $sanitizedData = $this->sanitizeInput($data);
        $imageName = $sanitizedData['preNewsImage'];

        if ($file["newsImage"]["tmp_name"]) {
            $imageName = $this->validateFile($file);
        }

        return $this->model->modifiedNews($sanitizedData['id'],
        $sanitizedData['title'], $sanitizedData['content'], 
                                        $imageName);
                                        
    }

    public function updateTodeleteNews($data) {
        $id = filter_var($data['id'] ?? '', FILTER_SANITIZE_NUMBER_INT);
        return $this->model->deleteNews($id);
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
    $news = new News();
    $newsController = new NewsController($news);

    try {
        if (isset($_POST['insert'])) {
            $result_status = $newsController->createNews($_POST, $_FILES);
            echo $result_status === 200 
                ? "<script>alert('News Added')</script><script>window.location.href='../../../admin.php?route=news'</script>"
                : "<script>alert('Failed to insert News')</script>";
        }

        if (isset($_POST['update'])) {
            $result_status = $newsController->updateNews($_POST, $_FILES);
            echo $result_status === 200 
                ? "<script>alert('News successfully updated')</script><script>window.location.href='../../../admin.php?route=news'</script>"
                : "<script>alert('Failed to update News')</script>";
        }

        if (isset($_POST['delete'])) {
            $result_status = $newsController->updateTodeleteNews($_POST);
            echo $result_status === 200 
                ? "<script>alert('News successfully deleted')</script><script>window.location.href='../../../admin.php?route=news'</script>"
                : "<script>alert('Failed to delete News')</script>";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
