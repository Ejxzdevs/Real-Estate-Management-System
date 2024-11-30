<?php
require_once 'app/http/helper/csrfHelper.php';
require_once 'app/http/helper/displayProduct.php';
require_once 'app/http/helper/displayInventory.php';

// display inventory list
$inventory = new DisplayInventory();
$dataInventory = $inventory->getInventory();

// for option properties[form]
$products = new DisplayProduct();
$data = $products->getAllProducts();
$csrf_token = CsrfHelper::generateToken();
?>
<div class="d-flex flex-column p-4">
    <div class="d-flex flex-row justify-content-between w-100 h-100 mb-2">
        <h5 class="mt-3">Inventory</h5>
        <button class="btn btn-primary me-3" style="width: 120px; height: 2.5rem;" data-bs-toggle="modal" data-bs-target="#addInventory">ADD</button>
    </div>
    <div class="table-container">
        <table class="table align-middle mb-0 bg-white p-3 ">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Full Name</th>
                    <th>Property Name</th>
                    <th>Contact</th>
                    <th>Transaction Type</th>
                    <th>Method</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($dataInventory as $list): ?>
                <tr>
                    <td><p><?php echo htmlspecialchars($list['inventory_id']); ?></p></td>
                    <td><p><?php echo htmlspecialchars($list['fullname']); ?></p></td>
                    <td><p><?php echo htmlspecialchars($list['name']); ?></p></td>
                    <td><p><?php echo htmlspecialchars($list['contact']); ?></p></td>
                    <td><p><?php echo htmlspecialchars($list['transaction_type']); ?></p></td>
                    <td><p><?php echo htmlspecialchars($list['payment_method']); ?></p></td>
                    <td><div class="table-actions">
                        <a href="#" 
                           onclick="
                            // Populate input fields with PHP values
                                                        document.getElementById('inventory_id').value = '<?php echo htmlspecialchars($list['inventory_id']); ?>';
                            document.getElementById('Updatefullname').value = '<?php echo htmlspecialchars($list['fullname']); ?>';
                            document.getElementById('Updatecontact').value = '<?php echo htmlspecialchars($list['contact']); ?>';
                            document.getElementById('client_address').value = '<?php echo htmlspecialchars($list['inventory_address']); ?>';
                            document.getElementById('updateProperty_id').value = '<?php echo htmlspecialchars($list['property_id']); ?>';
                            document.getElementById('updatePropertyImage').value = '<?php echo htmlspecialchars($list['image']); ?>';
                            document.getElementById('imageUpdatePreview').src = 'public/images/products/<?php echo htmlspecialchars($list['image']); ?>';
                            document.getElementById('imageUpdatePreview').style.display = 'block';
                            document.getElementById('Updatepayment_method').value = '<?php echo htmlspecialchars($list['payment_method']); ?>';
                            
                            // Price, amount, and change - format to 2 decimal places
                            document.getElementById('updatePrice').value = parseFloat('<?php echo htmlspecialchars($list['price']); ?>').toFixed(2);
                            document.getElementById('updateAmount').value = parseFloat('<?php echo htmlspecialchars($list['amount']); ?>').toFixed(2);
                            document.getElementById('updateChange').value = parseFloat('<?php echo htmlspecialchars($list['change']); ?>').toFixed(2);
                            
                            // Remark field - Ensure there is no extra dot
                            document.getElementById('Updateremark').value = '<?php echo htmlspecialchars($list['remark']); ?>';
                           "
                           data-bs-toggle="modal" data-bs-target="#updateInventory" class="edit" >
                           <i class="bi bi-pencil-square"></i>
                        </a>
                        <form action="app/http/controller/inventoryController.php" method="POST" style="display: inline;">
                            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token ?>">
                            <input type="hidden" name="delete">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($list['id']); ?>">
                            <button type="submit" class="delete">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>
                    </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Inventory Modal -->
<div class="modal fade" id="addInventory" tabindex="-1" aria-labelledby="addInventory" aria-hidden="true">
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
                        <select class="form-select" name="property_id" id="property_id" onchange="getPrice(this);" required>
                            <option value="" disabled selected>Select Property</option>
                            <?php foreach ($data as $product): ?>
                                <option value="<?php echo $product['id'] ?>" 
                                data-price="<?php echo $product['price']; ?>"
                                data-image="<?php echo $product['image']; ?>"
                                ><?php echo $product['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <img id="imagePreview" src="" alt="Image Preview" style="display: none; max-width: 100%; height: auto;">
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
                        <input type="number" name="amount" class="form-control" id="amount" oninput="calculateChange();" required>
                    </div>
                    <div class="mb-3">
                        <label for="change" class="form-label">Change</label>
                        <input type="number" name="change" class="form-control" id="change">
                    </div>
                    <div class="mb-3">
                        <label for="remark" class="form-label">Remark</label>
                        <textarea name="remark" class="form-control" id="remark" rows="3"></textarea>
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

<!-- Update Inventory Modal -->
<div class="modal fade" id="updateInventory" tabindex="-1" aria-labelledby="updateInventory" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="app/http/controller/inventoryController.php" method="POST" id="updateInventoryForm" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token ?>">
                    <input type="hidden" name="inventory_id" id="inventory_id">
                    <input type="hidden" name="update">
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Full Name</label>
                        <input type="text" name="fullname" class="form-control" id="Updatefullname" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact (Email or Number)</label>
                        <input type="text" name="contact" class="form-control" id="Updatecontact" required>
                    </div>
                    <div class="mb-3">
                        <label for="client_address" class="form-label">Client Address</label>
                        <input type="text" name="client_address" class="form-control" id="client_address" required>
                    </div>
                    <div class="mb-3">
                        <label for="property_id" class="form-label">Select Properties</label>
                        <select class="form-select" name="property_id" id="updateProperty_id" onchange="getPriceImage(this);" >
                            <option value="" disabled selected>Select Property</option>
                            <?php foreach ($data as $product): ?>
                                <option 
                                value="<?php echo $product['id'] ?>" 
                                data-price="<?php echo $product['price']; ?>" 
                                data-image="<?php echo $product['image']; ?>"
                                ><?php echo $product['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <img id="imageUpdatePreview" src="" alt="Image Preview" style="max-width: 100%; height: auto;">
                        <input type="hidden" name="prePropertyImage" class="form-control" id="updatePropertyImage" accept="image/*" >
                    </div>
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Payment Method</label>
                        <select class="form-select" name="payment_method" id="Updatepayment_method" required>
                            <option value="" disabled selected>Select Payment Method</option>
                            <option value="Cash">Cash</option>
                            <option value="Credit Card">Credit Card</option>
                            <option value="Digital Wallet">Digital Wallet</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="updatePrice" class="form-label">Price</label>
                        <input type="number" name="updatePrice" class="form-control" id="updatePrice" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="updateAmount" class="form-label">Amount Paid</label>
                        <input type="number" name="updateAmount" class="form-control" id="updateAmount" oninput="calculateUpdateChange();" step="0.01" min="0" required >
                    </div>
                    <div class="mb-3">
                        <label for="updateChange" class="form-label">Change</label>
                        <input type="number" name="updateChange" class="form-control" id="updateChange">
                    </div>
                    <div class="mb-3">
                        <label for="remark" class="form-label">Remark</label>
                        <textarea name="remark" class="form-control" id="Updateremark" rows="3" ></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="updateInventoryForm">Save</button>
            </div>
        </div>
    </div>
</div>



