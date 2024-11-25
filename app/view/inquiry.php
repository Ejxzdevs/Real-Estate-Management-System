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
                    <th>email</th>
                    <th>number</th>
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
                        <td><?php echo htmlspecialchars($inquiry['inquiry_status']); ?></td>
                        <td>
                            <div class="table-actions">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#viewInquiry"
                                onclick="
                                document.getElementById('email').textContent = '<?php echo htmlspecialchars($inquiry['inquiry_email']); ?>';
                                document.getElementById('name').value = '<?php echo htmlspecialchars($inquiry['inquiry_name']); ?>';
                                document.getElementById('message').value = '<?php echo htmlspecialchars($inquiry['inquiry_message']); ?>';
                               "
                                
                                ><i class="bi bi-envelope"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>



<!-- View Modal -->
<div class="modal fade" id="viewInquiry" tabindex="-1" aria-labelledby="viewInquiry" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-size: 14px;" >Email From: <span id="email" style="font-size: 14px;"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="app/http/controller/productController.php" method="POST" id="updatePropertyForm" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="updatePropertyName" class="form-label">Client Name</label>
                        <input type="text" name="propertyName" class="form-control" id="name" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="updatePropertyDescription" class="form-label">Message</label>
                        <textarea name="propertyDescription" class="form-control" id="message" rows="3" disabled></textarea>
                    </div>
        </div>
    </div>
</div>
<script>
    function view(){

    }
</script>
