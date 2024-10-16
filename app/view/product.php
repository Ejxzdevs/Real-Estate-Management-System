<?php 
require_once 'app/http/helper/displayProduct.php';
$products = new DisplayProduct();
$data = $products->getAllProducts();
?>
<div class="d-flex flex-column p-4">
    <div class="d-flex flex-row justify-content-between w-100 h-100">
        <h5 class="mt-3">Products</h5>
        <button class="btn btn-primary me-3" style="width: 120px; height: 2.5rem;" data-bs-toggle="modal" data-bs-target="#addProperty">ADD</button>
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
        <?php foreach ($data as $product): ?>
        <tbody>
            <tr>
                <td><img src="public/images/products/<?php echo $product['image']; ?>" style="height:3rem; width:4rem;"></td>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['description']; ?></td>
                <td><?php echo $product['address']; ?></td>
                <td><?php echo $product['price']; ?></td>
                <td><?php echo $product['status']; ?></td>
                <td>
                    <a href="#" 
                       onclick="
                        document.getElementById('updatePropertyID').value = `<?php echo $product['id'] ?>`;
                        document.getElementById('updatePropertyName').value = `<?php echo $product['name'] ?>`;
                        document.getElementById('updatePropertyDescription').value = `<?php echo $product['description'] ?>`;
                        document.getElementById('updatePropertyAddress').value = `<?php echo $product['address'] ?>`;
                        document.getElementById('updatePropertyPrice').value = `<?php echo $product['price'] ?>`;
                        document.getElementById('updatePropertyStatus').value = `<?php echo $product['status'] ?>`;
                        document.getElementById('imagePreview').src = `public/images/products/<?php echo $product['image']; ?>`;
                        document.getElementById('imagePreview').style.display = 'block';
                       "
                       data-bs-toggle="modal" data-bs-target="#updateProperty">Edit</a>
                </td>
            </tr>
        </tbody>
        <?php endforeach; ?>
    </table>
</div>

<!-- Add Property Modal -->
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
                        <input type="hidden" name="insert">
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

<!-- Update Modal -->
<div class="modal fade" id="updateProperty" tabindex="-1" aria-labelledby="updateProperty" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateProperty">Update Property</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="app/http/controller/productController.php" method="POST" id="updatePropertyForm" enctype="multipart/form-data">
                    <div class="mb-3">
                        <input type="hidden" name="update">
                        <label for="updatePropertyName" class="form-label">Property Name</label>
                        <input type="text" name="id" class="form-control" id="updatePropertyID" required>
                        <input type="text" name="propertyName" class="form-control" id="updatePropertyName" required>
                    </div>
                    <div class="mb-3">
                        <label for="updatePropertyDescription" class="form-label">Description</label>
                        <textarea name="propertyDescription" class="form-control" id="updatePropertyDescription" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="updatePropertyAddress" class="form-label">Address</label>
                        <input type="text" name="propertyAddress" class="form-control" id="updatePropertyAddress" required>
                    </div>
                    <div class="mb-3">
                        <label for="updatePropertyPrice" class="form-label">Price</label>
                        <input type="number" name="propertyPrice" class="form-control" id="updatePropertyPrice" required>
                    </div>
                    <div class="mb-3">
                        <label for="updatePropertyStatus" class="form-label">Status</label>
                        <select class="form-select" name="propertyStatus" id="updatePropertyStatus" required>
                            <option value="" disabled selected>Select status</option>
                            <option value="available">Available</option>
                            <option value="sold">Sold</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="updatePropertyImage" class="form-label">Update Image</label>
                        <input type="file" name="propertyImage" class="form-control" id="updatePropertyImage" accept="image/*" required onchange="previewImage(event)">
                    </div>
                    <div class="mb-3">
                        <img id="imagePreview" src="" alt="Image Preview" style="display: none; max-width: 100%; height: auto;">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="updatePropertyForm">Update Property</button>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const imagePreview = document.getElementById('imagePreview');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
        }
        
        reader.readAsDataURL(file);
    } else {
        imagePreview.src = '';
        imagePreview.style.display = 'none';
    }
}
</script>
