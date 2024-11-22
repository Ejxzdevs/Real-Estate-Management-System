<?php 

require_once '../helper/csrfHelper.php';
require_once '../../model/inquiry.php';

class InquiryController{

    private $model;

    public function __construct(Inquiry $model) {
        $this->model = $model;
    }

    private function sanitizeInput($data) {
        return array_map(function($value) {
            return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
        }, $data);
    }
    
    public function createInquiry($data) {
        $sanitizedData = $this->sanitizeInput($data);
        return $this->model->addInquiry(
            $sanitizedData['productID'], 
            $sanitizedData['name'], 
            $sanitizedData['email'], 
            $sanitizedData['number'],
            $sanitizedData['message'], 
        );
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST['csrf_token']) || !CsrfHelper::validateToken($_POST['csrf_token'])) {
        http_response_code(403);
        echo "<script>alert('Invalid CSRF token!')</script>";
        echo "<script>window.location.href='../../../index.php'</script>";
        exit();
    }

    CsrfHelper::regenerateToken();
    $inquiryModel = new Inquiry();
    $inquiryController = new InquiryController($inquiryModel);

    try {
        if (isset($_POST['insert'])) {
            $result_status = $inquiryController->createInquiry($_POST);
            echo $result_status === 200 
                ? "<script>alert('Inquirty successfully Submitted')</script><script>window.location.href='../../../index.php'</script>"
                : "<script>alert('Failed to insert property')</script>";
        }

        if (isset($_POST['update'])) {
            
        }

        if (isset($_POST['delete'])) {
            
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

}