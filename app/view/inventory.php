<?php
require_once 'app/http/helper/csrfHelper.php';
require_once 'app/http/helper/displayProduct.php';
$products = new DisplayProduct();
$data = $products->getAllProducts();
$csrf_token = CsrfHelper::generateToken();
?>
<div class="d-flex flex-column p-4">
    <div class="d-flex flex-row justify-content-between w-100 h-100 mb-2">
        <h5 class="mt-3">Inventory</h5>
        <button class="btn btn-primary me-3" style="width: 120px; height: 2.5rem;" data-bs-toggle="modal" data-bs-target="#addProperty">ADD</button>
    </div>
    <div class="table-container">
        <table class="table align-middle mb-0 bg-white p-3 ">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Property Name</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Price</th>
                    <th>Transaction Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data rows will be populated here -->
            </tbody>
        </table>
    </div>
</div>

<!-- Add Inventory Modal -->
<div class="modal fade" id="addProperty" tabindex="-1" aria-labelledby="addProperty" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Client Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="app/http/controller/inventoryController.php" method="POST" id="addPropertyForm" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token ?>">
                    <input type="hidden" name="insert">
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Full Name</label>
                        <input type="text" name="fullname" class="form-control" id="fullname" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact (Email or Number)</label>
                        <input type="text" name="contact" class="form-control" id="contact" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" id="address" required>
                    </div>
                    <div class="mb-3">
                        <label for="property_id" class="form-label">Select Properties</label>
                        <select class="form-select" name="property_id" id="property_id" onchange="updatePrice(this);" required>
                            <option value="" disabled selected>Select Property</option>
                            <?php foreach ($data as $product): ?>
                                <option value="<?php echo $product['id'] ?>" data-price="<?php echo $product['price']; ?>"><?php echo $product['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Payment Method</label>
                        <select class="form-select" name="payment_method" id="payment_method" required>
                            <option value="" disabled selected>Select Payment Method</option>
                            <option value="Cash">Cash</option>
                            <option value="Credit Card">Credit Card</option>
                            <option value="Digital Wallet">Digital Wallet</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="Price" class="form-label">Price</label>
                        <input type="number" name="Price" class="form-control" id="Price" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" name="amount" class="form-control" id="amount" oninput="calculateChange();" required >
                    </div>
                    <div class="mb-3">
                        <label for="change" class="form-label">Change</label>
                        <input type="number" name="change" class="form-control" id="change">
                    </div>
                    <div class="mb-3">
                        <label for="remark" class="form-label">Remark</label>
                        <textarea name="remark" class="form-control" id="remark" rows="3" ></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="addPropertyForm">Submit</button>
            </div>
        </div>
    </div>
</div>

