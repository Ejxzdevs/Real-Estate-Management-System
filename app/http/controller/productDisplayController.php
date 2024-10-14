<?php 
require_once 'app/model/products.php';
class ProductDisplayController {
    private $model;

    public function __construct(Products $model) {
        $this->model = $model;
    }
    
    public function displayAll (){
           return $this->model->getAllProducts();
    }
}
$productModel = new Products();
$displayProducts = new ProductDisplayController($productModel);
$displayProducts->displayAll();