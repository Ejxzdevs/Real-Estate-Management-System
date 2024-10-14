<?php 
require_once 'app/http/helper/displayProduct.php';
$products = new DisplayProduct();
$data = $products->getAllProducts();
?>
<div class="d-flex flex-column p-4">
    <div class="d-flex flex-row d-flex justify-content-between w-100 h-100 " >
        <h5 class="mt-3" >Products</h5>
        <button class="btn btn-primary me-3" style="width: 120px; height: 2.5rem; " data-bs-toggle="modal" data-bs-target="#addProperty" >ADD</button>
    </div>
    <table class="table align-middle mb-0 bg-white p-3 mt-4">
    <thead class="bg-light">
        <tr>
            <th>Image</th>
            <th>Product</th>
            <th>Description</th>
            <th>Location</th>
            <th>Price</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <?php 
        foreach($data as $product):
    ?>
    <tbody>
        <tr>
            <td><img src="public/images/products/<?php echo $product['image']; ?>" style="height:3rem; width:4rem;"></td>
            <td><?php echo $product['name']; ?></td>
            <td><?php echo $product['description']; ?></td>
            <td><?php echo $product['address']; ?></td>
            <td><?php echo $product['price']; ?></td>
            <td><?php echo $product['status']; ?></td>
            <td><a href="#" >Edit</a></td>
        </tr>
    </tbody>
    <?php endforeach; ?>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="addProperty" tabindex="-1" aria-labelledby="addProperty" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProperty">Add Property</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="app/http/controller/productController.php" method="POST" id="addPropertyForm" enctype="multipart/form-data">
                    <div class="mb-3">
  
                        <input type="hidden" name="insert" >
                        <label for="propertyName" class="form-label">Property Name</label>
                        <input type="text" name="propertyName" class="form-control" id="propertyName" required>
                    </div>
                    <div class="mb-3">
                        <label for="propertyDescription" class="form-label">Description</label>
                        <textarea name="propertyDescription" class="form-control" id="propertyDescription" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="propertyAddress" class="form-label">Address</label>
                        <input type="text" name="propertyAddress" class="form-control" id="propertyAddress" required>
                    </div>
                    <div class="mb-3">
                        <label for="propertyPrice" class="form-label">Price</label>
                        <input type="number" name="propertyPrice" class="form-control" id="propertyPrice" required>
                    </div>
                    <div class="mb-3">
                        <label for="propertyStatus" class="form-label">Status</label>
                        <select class="form-select" name="propertyStatus" id="propertyStatus" required>
                            <option value="" disabled selected>Select status</option>
                            <option value="available">Available</option>
                            <option value="sold">Sold</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="propertyImage" class="form-label">Upload Image</label>
                        <input type="file" name="propertyImage" class="form-control" id="propertyImage" accept="image/*" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="addPropertyForm">Add Property</button>
            </div>
        </div>
    </div>
</div>




