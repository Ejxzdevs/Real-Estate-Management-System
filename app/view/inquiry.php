<?php
require_once 'app/http/helper/displayInquiry.php';
$Inquiries = new DisplayInquiries();
$data = $Inquiries->getAllInquiries();
?>
<div class="d-flex flex-column p-4">
    <div class="d-flex flex-row justify-content-between w-100 h-100 mb-2">
        <h5 class="mt-3">Inquiry</h5>
        
    </div>
    <div class="table-container">
        <table class="table align-middle mb-0 bg-white p-3 ">
            <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>number</th>
                    <th>email</th>
                    <th>message</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $inquiry): ?>
                    <tr>
                    <td><?php echo htmlspecialchars($inquiry['id']); ?></td>
                        <td><?php echo htmlspecialchars($inquiry['inquiry_name']); ?></td>
                        <td><?php echo htmlspecialchars($inquiry['inquiry_email']); ?></td>
                        <td><?php echo htmlspecialchars($inquiry['inquiry_number']); ?></td>
                        <td><?php echo htmlspecialchars($inquiry['inquiry_message']); ?></td>
                        <td><?php echo htmlspecialchars($inquiry['inquiry_status']); ?></td>
                        <td>
                            <div class="table-actions">
            
                              
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>



<!-- View Modal -->
<div class="modal fade" id="updateProperty" tabindex="-1" aria-labelledby="updateProperty" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Property</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="app/http/controller/productController.php" method="POST" id="updatePropertyForm" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token ?>">
                    <input type="hidden" name="update">
                    <input type="hidden" name="id" class="form-control" id="updatePropertyID" required>
                    <div class="mb-3">
                        <label for="updatePropertyName" class="form-label">Property Name</label>
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
                        <input type="text" name="propertyPrice" class="form-control" id="updatePropertyPrice" required>
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
                        <label for="updateTransactionType" class="form-label">Transaction Type</label>
                        <select class="form-select" name="transactionType" id="updateTransactionType" required>
                            <option value="" disabled selected>Select status</option>
                            <option value="sell">Sell</option>
                            <option value="rent">Rent</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Update Image</label>
                        <input type="file" name="propertyImage" class="form-control" accept="image/*" onchange="previewImage(event)">
                    </div>
                    <div class="mb-3">
                        <img id="imagePreview" src="" alt="Image Preview" style="display: none; max-width: 100%; height: auto;">
                        <input type="hidden" name="prePropertyImage" class="form-control" id="updatePropertyImage" accept="image/*" >
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
