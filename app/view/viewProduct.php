<?php
include "../../app/http/helper/base64.php";
include "../model/viewProduct.php";

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
    <title><?php echo $details[0]['name']; ?></title>
    <link rel="stylesheet" href="../../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        html , body {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            background-color: #ffffff;
        }
       .custom-card  {
            padding: 20px 10px;
            width: 600px;
            display: flex;
            flex-direction: column;
            gap: 4px;
            cursor: pointer;
            background-color: #ffffff;
        }

        .custom-card .card-header{
            height: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .custom-card .card-header p{
            font-size: 12px;
        }

        .custom-card .card-header .status {
            width: auto; 
            height: 1.3rem ;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 5px;
            padding: 7px !important;
            text-transform: uppercase;

        }
        

        .custom-card  img {
            height: 300px;
        }
       
    </style>
</head>
<body>
    <div class="container-fluid h-100 d-flex justify-content-center align-items-center">
    <?php foreach($details as $detail): ?>
        <div class="card custom-card border h-auto shadow"  >
            <div class="card-header px-2 m-0">
                <p class="fw-medium p-0 m-0"  >Date Posted: <span class="text-secondary" style="font-size: 10px;" ><?php echo htmlspecialchars($detail['date_added']); ?></span></p>
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
            <img class="" src="../../public/images/products/<?php echo htmlspecialchars(string: $detail['image']); ?>" alt="<?php echo htmlspecialchars($detail['name']); ?>">
            <div class="d-flex flex-column m-0 p-0" style="height: auto;" >
                <p class="m-0 fw-bold fs-6"><?php echo htmlspecialchars($detail['name']); ?></p>
                <p class="m-0 text-secondary" style="font-size: 10px;" ><i class="bi bi-geo-alt"></i><?php echo htmlspecialchars($detail['address']); ?></p>
            </div>
            <div class="ps-1 pe-2  py-0" style="height: 59%;">
                <p class="mt-4 mx-0 text-wrap" style="font-size: 12px;" ><?php echo htmlspecialchars($detail['description']); ?></p>
            </div>
            <div class="ps-1 pe-2 d-flex flex-row justify-content-between align-items-center" style="height: 18%;" >
                <p class="m-0 text-secondary" >₱<?php echo htmlspecialchars($detail['price']); ?></p>
                <?php 
                    if ($detail['status'] == "sold") {
                        echo '
                        <a class="btn btn-secondary" style="font-size: 10px;">
                            Inquires
                        </a>';
                    } else {
                         echo ' 
                         <a class="btn btn-primary" style="font-size: 10px;">
                            Inquires
                        </a>';
                    }
                ?>
               
            </div>
            
    
        </div>
    </div>
    <?php endforeach; ?>
    
</body>
    <script src="../../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</html>
