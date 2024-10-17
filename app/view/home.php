<?php 
    include "app/http/helper/displayProduct.php";
    $fetchproducts = new DisplayProduct();
    $products = $fetchproducts->recentProducts(6);
?>
<div class="homeContainer">
    <div class="introContainer d-flex justify-content-center align-items-center">
        <div class="d-flex justify-content-center align-items-center flex-column gap-5 w-75 h-100 z-3">
            <h1 class="fw-bold text-white text-align-center" > Welcome to Real Estate Management Solution</h1>
            <p class="text-white" >
                In the fast-paced world of real estate, managing properties, clients, and transactions can be a complex task. [Your System's Name] is designed to simplify and streamline the process for real estate professionals. Whether you're managing residential or commercial properties, our system offers a user-friendly platform to oversee all aspects of real estate management, from property listings and client databases to contract management and financial tracking
            </p>
        </div>
    </div>
    <div class="container-fluid pt-3">
        <h1 class="text-center display-6 fw-bold">New Listing</h1>
        <div class="row d-flex justify-content-center align-items-center gap-5 p-4">
            <!-- First Item -->
            <?php foreach($products as $product): ?>
                <div class="card border d-flex flex-row p-0 " style="height: 200px; width: 550px; cursor: pointer; " >
                    <div class="border p-1" style="width: 50%;" >
                        <img class="h-100 rounded-3" src="public/images/products/<?php echo $product['image']; ?>" alt="">
                    </div>
                    <div class="d-flex flex-column ps-2" style="width: 60%;" >
                        <div class="d-flex flex-column m-0 p-0" style="height: auto;" >
                            <p class="m-0 fw-bold fs-6"><?php echo $product['name']; ?></p>
                            <p class="m-0 text-secondary" style="font-size: 10px;" ><i class="bi bi-geo-alt"></i><?php echo $product['address']; ?></p>
                        </div>
                        <div class="ps-1 pe-2  py-0" style="height: 59%;">
                            <p class="mt-4 mx-0 text-wrap" style="font-size: 10px;" ><?php echo $product['description']; ?></p>
                        </div>
                        <div class="ps-1 pe-4 d-flex flex-row justify-content-between align-items-center" style="height: 18%;" >
                            <p class="m-0 text-secondary" >₱<?php echo $product['price']; ?></p>
                            <b class="btn btn-primary" >Inquire</b>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </div>
<!-- Parent End Tag -->
</div>
