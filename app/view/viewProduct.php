<?php
include "../../app/http/helper/base64.php";
include "../../app/http/helper/csrfHelper.php";
include "../model/viewProduct.php";
$csrf_token = CsrfHelper::generateToken();

$encodedId = $_GET['id'] ?? null; // Use null coalescing operator to check if 'id' is set

if ($encodedId) {
    // Decode the Base64-encoded ID
    $decodedId = Base64IdHelper::decode_id($encodedId);
    $getDetails = new viewProduct();

    if ($decodedId !== null) {
        $details = $getDetails->getDetails($decodedId);
    } else {
        echo "Invalid encoded ID.";
    }
} else {
    echo "No ID provided in the URL.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($details[0]['name']); ?></title>
    <link rel="stylesheet" href="../../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        html, body {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            background-color: #ffffff;
        }

        .backContainer {
            width: 600px;
            height: 50px;
            display: flex;
            justify-content: end;
            align-items:center;
            padding-right: 1rem;
        }

        .backContainer i {
            font-size: 50px;
        }

        .custom-card {
            padding: 20px 10px;
            width: 600px;
            display: flex;
            flex-direction: column;
            gap: 4px;
            cursor: pointer;
            background-color: #ffffff;
        }

        .custom-card .card-header {
            height: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .custom-card .card-header p {
            font-size: 12px;
        }

        .custom-card .card-header .status {
            width: auto; 
            height: 1.3rem;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 5px;
            padding: 7px !important;
            text-transform: uppercase;
        }

        .custom-card img {
            height: 300px;
        }
    </style>
</head>
<body>
    <div class="container-fluid h-100 d-flex flex-column gap-3 justify-content-center align-items-center">
        <div class="backContainer">
            <a href="../../index.php"><i class="bi bi-box-arrow-left text-secondary"></i></a>
        </div>
    <?php foreach($details as $detail): ?>
        <div class="card custom-card border h-auto shadow">
            <div class="card-header px-2 m-0">
                <p class="fw-medium p-0 m-0">Date Posted: <span class="text-secondary" style="font-size: 10px;"><?php echo htmlspecialchars($detail['date_added']); ?></span></p>
                <p class="status p-0 m-0 text-white fw-bold 
                <?php 
                    if ($detail['status'] == "sold") {
                        echo 'bg-danger';
                    } else {
                         echo 'bg-success';
                    }
                ?>
                    "><?php echo htmlspecialchars($detail['status']); ?></p>
            </div>
            <img class="" src="../../public/images/products/<?php echo htmlspecialchars($detail['image']); ?>" alt="<?php echo htmlspecialchars($detail['name']); ?>">
            <div class="d-flex flex-column m-0 p-0" style="height: auto;">
                <p class="m-0 fw-bold fs-6"><?php echo htmlspecialchars($detail['name']); ?></p>
                <p class="m-0 text-secondary" style="font-size: 10px;"><i class="bi bi-geo-alt"></i><?php echo htmlspecialchars($detail['address']); ?></p>
            </div>
            <div class="ps-1 pe-2 py-0" style="height: 59%;">
                <p class="mt-4 mx-0 text-wrap" style="font-size: 12px;"><?php echo htmlspecialchars($detail['description']); ?></p>
            </div>
            <div class="ps-1 pe-2 d-flex flex-row justify-content-between align-items-center" style="height: 18%;">
                <p class="m-0 text-secondary">₱<?php echo htmlspecialchars($detail['price']); ?></p>
                <button  onclick="getName('<?php echo htmlspecialchars($detail['name']); ?>','<?php echo htmlspecialchars($detail['id']); ?>')" 
                    class=" btn <?php echo ($detail['status'] == "sold") ? 'btn-secondary' : 'btn-primary'; ?> " 
                    style="font-size: 10px;" 
                    data-bs-toggle="modal" 
                    data-bs-target="#addProperty"
                    <?php echo ($detail['status'] == "sold") ? 'disabled' : ''; ?>
                >
                    Inquire
                </button>
            </div>
        </div>
    <?php endforeach; ?>
    </div>

    <!-- Add Property Modal -->
    <div class="modal fade" id="addProperty" tabindex="-1" aria-labelledby="addProperty" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="font-size: 16px; ">INQUIRY FORM [<span id="houseName" class="text-secondary" style="font-size: 12px;" ></span>]</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../http/controller/inquiryController.php" method="POST" id="addPropertyForm" enctype="multipart/form-data">
                        <input type="hidden" name="productID" class="form-control" id="productID" required>
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token, ENT_NOQUOTES, 'UTF-8'); ?>" class="form-control">
                        <input type="hidden" name="insert" class="form-control">
                        <div class="mb-3">
                            <label for="propertyName" class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="propertyAddress" class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="number" class="form-label">Phone Number</label>
                            <input type="text" name="number" class="form-control" id="number" required>
                        </div>
                        <div class="mb-3">
                            <label for="propertyDescription" class="form-label">Message<span class="text-secondary">(Optional)</span></label>
                            <textarea name="message" class="form-control" id="message" rows="3"></textarea>
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

    <script>
        function getName(name,id) {
            document.getElementById('houseName').textContent = name;
            document.getElementById('productID').value = id;
            
        }
    </script>
    
    <script src="../../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
