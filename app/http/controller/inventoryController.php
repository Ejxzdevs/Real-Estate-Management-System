<?php 
require_once '../helper/csrfHelper.php';
require_once '../../model/inventory.php';

class InventoryController{

    private $model;

    public function __construct(Inventory $model) {
        $this->model = $model;
    }

    private function sanitizeInput($data) {
        return array_map(function($value) {
            return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
        }, $data);
    }
    
    public function createInventory($data) {
        $sanitizedData = $this->sanitizeInput($data);
        return $this->model->addInventory(
            $sanitizedData['fullname'], 
            $sanitizedData['contact'], 
            $sanitizedData['address'], 
            $sanitizedData['property_id'],
            $sanitizedData['payment_method'], 
            $sanitizedData['amount'],
            $sanitizedData['change'],
            $sanitizedData['remark'], 
        );
    }

    public function updateInventory($data) {
        $sanitizedData = $this->sanitizeInput($data);
        return $this->model->modifyInventory(
            $sanitizedData['inventory_id'], 
            $sanitizedData['fullname'], 
            $sanitizedData['contact'], 
            $sanitizedData['client_address'], 
            $sanitizedData['property_id'],
            $sanitizedData['payment_method'], 
            $sanitizedData['updateAmount'],
            $sanitizedData['updateChange'],
            $sanitizedData['remark'], 
        );
    }
}





if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST['csrf_token']) || !CsrfHelper::validateToken($_POST['csrf_token'])) {
        http_response_code(403);
        echo "<script>alert('Invalid CSRF token!')</script>";
        echo "<script>window.location.href='../../../admin.php?route=inventory'</script>";
        exit();
    }

    CsrfHelper::regenerateToken();
    $inventoryModel = new Inventory();
    $inventoryController = new InventoryController($inventoryModel);

    try {
        if (isset($_POST['insert'])) {
            $result_status = $inventoryController->createInventory($_POST);
            echo $result_status === 200 
                ? "<script>alert('Inventory Added Successfully')</script><script>window.location.href='../../../admin.php?route=inventory'</script>"
                : "<script>alert('Failed to insert property')</script>";
        }

        if (isset($_POST['update'])) {
            
            $result_status = $inventoryController->updateInventory($_POST);
            echo $result_status === 200 
                ? "<script>alert('Inventory Update Successfully')</script><script>window.location.href='../../../admin.php?route=inventory'</script>"
                : "<script>alert('Failed to insert property')</script>";
        }

        if (isset($_POST['delete'])) {
            
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

}