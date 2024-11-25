<?php 
include "app/http/helper/displayProduct.php";
include "app/http/helper/base64.php";

if (isset($_SESSION['products'])) {
    // Get the products from the session
    $products = $_SESSION['products'];  
    unset($_SESSION['products']);
    $filters = $_SESSION['filter'];
    unset($_SESSION['filter']);
} else {
    $fetchproducts = new DisplayProduct();
    $products = $fetchproducts->getAllProducts();
    
}
?>
<div class="propertiesContainer"> 
    <div class="filterContainer border">
        <label class="text-secondary mb-3 fs-5" for="">Filter Properties</label>
        <form action="app/http/helper/filterProduct.php" method="POST">
                <div class="mb-3">
                    <label for="PropertyName" class="form-label">Property Name</label>
                    <input type="text" name="propertyName" class="form-control" id="propertyName"  >
                </div>
                <div class="mb-3">
                    <label for="propertyAddress" class="form-label">Address</label>
                    <input type="text" name="propertyAddress" class="form-control" id="propertyAddress" >
                </div>
                <div class="mb-3">
                    <label for="propertyPrice" class="form-label">Price</label>
                    <input type="text" name="propertyPrice" class="form-control" id="propertyPrice" >
                </div>
                <div class="mb-3">
                    <label for="PropertyStatus" class="form-label">Status</label>
                    <select class="form-select" name="propertyStatus" id="propertyStatus" >
                        <option value="">None</option>
                        <option value="available">Available</option>
                        <option value="sold">Sold</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="propertyTransactionType" class="form-label">Transaction Type</label>
                    <select class="form-select" name="propertyTransactionType" id="propertyTransactionType" >
                        <option value="">None</option>
                        <option value="sell">Sell</option>
                        <option value="rent">Rent</option>
                    </select>
                </div>
                <div class="mb-3">
                    <button type="submit" name="filter" class="btn btn-primary form-control">Submit</button>
                </div>
        </form>
    </div>
    <div class="productDisplay" >
        <div class="propertiesLabelContainer " >
            <h1>Properties Listing</h1>
        </div>
        <div class="productContainer" >
            <?php foreach($products as $product): ?>
                <div class="card border d-flex flex-row p-0 " style="height: 200px; width: 450px; cursor: pointer; " >
                    <div class="border p-1" style="width: 50%;" >
                        <img class="h-100 rounded-3" src="public/images/products/<?php echo htmlspecialchars($product['image']); ?>" alt="">
                    </div>
                    <div class="d-flex flex-column ps-2" style="width: 60%;" >
                        <div class="d-flex flex-column m-0 p-0" style="height: auto;" >
                            <p class="m-0 fw-bold fs-6"><?php echo htmlspecialchars($product['name']); ?></p>
                            <p class="m-0 text-secondary" style="font-size: 10px;" ><i class="bi bi-geo-alt"></i><?php echo htmlspecialchars($product['address']); ?></p>
                        </div>
                        <div class="ps-1 pe-2  py-0" style="height: 59%;">
                            <p class="mt-4 mx-0 text-wrap" style="font-size: 10px;" ><?php echo htmlspecialchars($product['description']); ?></p>
                        </div>
                        <div class="ps-1 pe-4 d-flex flex-row justify-content-between align-items-center" style="height: 18%;" >
                            <p class="m-0 text-secondary" >₱<?php echo htmlspecialchars($product['price']); ?></p>
                            <a class="btn btn-primary" href="app/view/viewProduct.php?id=<?php echo 
                                Base64IdHelper::safe_encode_id((int)$product['id']); ?>">
                            Details
                            </a>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<script type="text/javascript">
   document.getElementById('propertyName').value = '<?php echo htmlspecialchars($filters['propertyName']); ?>';
   document.getElementById('propertyAddress').value = '<?php echo htmlspecialchars($filters['propertyAddress']); ?>';
   document.getElementById('propertyPrice').value = '<?php echo htmlspecialchars($filters['propertyPrice']); ?>';
   document.getElementById('propertyStatus').value = '<?php echo htmlspecialchars($filters['propertyStatus']); ?>';
   document.getElementById('propertyTransactionType').value = '<?php echo htmlspecialchars($filters['propertyTransactionType']); ?>';
</script>