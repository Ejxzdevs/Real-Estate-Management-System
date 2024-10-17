<?php 
    include "app/http/helper/displayProduct.php";
    $fetchproducts = new DisplayProduct();
    $products = $fetchproducts->recentProducts(6);
?>
<div class="homeContainer">
    <div class="introContainer d-flex justify-content-center align-items-center">
        <div class="d-flex justify-content-center align-items-center flex-column gap-5 w-75 h-100 z-3">
            <h1 class="fw-bold text-white" > Welcome to Real Estate Management Solution</h1>
            <p class="text-white" >
                In the fast-paced world of real estate, managing properties, clients, and transactions can be a complex task. [Your System's Name] is designed to simplify and streamline the process for real estate professionals. Whether you're managing residential or commercial properties, our system offers a user-friendly platform to oversee all aspects of real estate management, from property listings and client databases to contract management and financial tracking
            </p>
        </div>
    </div>
    <div class="container-fluid py-5 d-flex flex-column border" style="height: auto;">
        <h1 class="fw-bold text-dark text-center mb-3">Why Choose Real Estate as an Investment?</h1>
        <div class="row d-flex justify-content-center align-items-center gap-5 p-3">
            <div class="col-12 col-md-4 d-flex flex-column justify-content-center align-items-center border rounded-2">
                <i class="bi-house-lock text-success" style="font-size:6rem;"></i>
                <p class="fw-bold">Secure Investment</p>
            </div>
            <div class="col-12 col-md-4 d-flex flex-column justify-content-center align-items-center border rounded-2">
                <i class="bi-currency-dollar text-success" style="font-size:6rem;"></i>
                <p class="fw-bold">Steady Cash Flow</p>
            </div>
            <div class="col-12 col-md-4 d-flex flex-column justify-content-center align-items-center border rounded-2">
                <i class="bi-gear text-success" style="font-size:6rem;"></i>
                <p class="fw-bold">Control Over Investment</p>
            </div>
        </div>
    </div>
    <div class="container-fluid p-5 border">
        <div class="row">
            <div class="col-md-6">
                <iframe 
                    src="https://www.youtube.com/embed/Fr0MFISQSFw?si=oJ17zGiFYQXRqMVS" 
                    title="YouTube video player" 
                    class="embed-responsive-item" 
                    style="width: 100%; height: 315px;" 
                    frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    referrerpolicy="strict-origin-when-cross-origin" 
                    allowfullscreen>
                </iframe>
            </div>
            <div class="col-md-6 ps-4">
                <h2>Scott Rechler on the Future of Commercial Real Estate</h2>
                <p>
                    In this insightful video, RXR CEO Scott Rechler discusses the evolving landscape of commercial real estate amid shifting economic conditions. He explores the implications of potential rate cuts and the Federal Reserve's uncertain stance on interest rates. Tune in to gain valuable perspectives on navigating this new paradigm in real estate!
                </p>
            </div>
        </div>
    </div>
    <div class="container-fluid pt-5">
        <h1 class="text-center display-6 fw-bold mb-5">New Listing</h1>
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
