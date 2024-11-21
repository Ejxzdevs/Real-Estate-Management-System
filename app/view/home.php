<?php 
    include "app/http/helper/displayProduct.php";
    include "app/http/helper/base64.php";
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
    <div class="container-fluid p-5 border">
        <div class="row">
            <div class="col-md-6">
                <img src="public/images/speaker/scott.jpg" alt="" srcset="">
              
            </div>
            <div class="col-md-6 ps-4">
                <h2>The real estate debt problem still hasn't been dealt with, says RXR Realty CEO Scott Rechler</h2>
                <p>
                <a href="https://www.youtube.com/watch?v=OhaIusKCLDs">https://www.youtube.com/watch?v=OhaIusKCLDs</a> Scott Rechler, RXR Realty chairman and CEO, joins 'Squawk Box' to discuss the state of the commercial real estate market, why he's expecting a 'slow moving train wreck' for regional banks, the weight of real estate debt, and more.
                </p>
            </div>
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
    <div class="container-fluid pt-5">
        <h1 class="text-center display-6 fw-bold mb-5">New Listing</h1>
        <div class="row d-flex justify-content-center align-items-center gap-5 p-4">
            <!-- First Item -->
            <?php foreach($products as $product): ?>
                <div class="card border d-flex flex-row p-0 " style="height: 200px; width: 550px; cursor: pointer; " >
                    <div class="border p-1" style="width: 50%;" >
                        <img class="h-100 rounded-3" src="public/images/products/<?php echo htmlspecialchars($product['image']); ?>" alt="">
                    </div>
                    <div class="d-flex flex-column ps-2" style="width: 60%;" >
                        <div class="d-flex flex-column m-0 p-0" style="height: auto;" >
                            <p class="m-0 fw-bold fs-6"><?php echo htmlspecialchars($product['name']); ?></p>
                            <p class="m-0 text-secondary" style="font-size: 10px;" ><i class="bi bi-geo-alt"></i><?php echo htmlspecialchars($product['address']); ?></p>
                        </div>
                        <div class="ps-1 pe-2  py-0" style="height: 59%;">
                            <p class="mt-4 mx-0 text-wrap" style="font-size: 10px;" ><?php echo htmlspecialchars($product['description']); ?></p>
                        </div>
                        <div class="ps-1 pe-4 d-flex flex-row justify-content-between align-items-center" style="height: 18%;" >
                            <p class="m-0 text-secondary" >₱<?php echo htmlspecialchars($product['price']); ?></p>
                            <a class="btn btn-primary" href="app/view/viewProduct.php?id=<?php echo 
                                Base64IdHelper::safe_encode_id((int)$product['id']); ?>">
                            Details
                            </a>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="container-fluid border my-5">
        <h1 class="text-center my-5" >Insights from Real Estate Experts</h1>
    <div class="row justify-content-center">

        <div class="col-md-4 col-sm-6">
            <div class="card mb-4">
                <img src="public/images/speaker/gary.png" class="card-img-top p-2" alt="Gary Vaynerchuk" style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column" style="height: 250px;">
                    <h5 class="card-title">Gary Vaynerchuk: Embracing the Digital Age in Real Estate</h5>
                    <p class="card-text flex-grow-1">“In today’s world, your personal brand is everything. Use social media to showcase your authenticity and connect with clients. Focus on building long-term relationships rather than chasing quick sales—success in real estate is a marathon, not a sprint.”</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6">
            <div class="card mb-4">
                <img src="public/images/speaker/tom.jpg" class="card-img-top p-2" alt="Tom Ferry" style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column" style="height: 250px;">
                    <h5 class="card-title">Tom Ferry: The Power of Goal Setting and Continuous Learning</h5>
                    <p class="card-text flex-grow-1">“Set clear, actionable goals for your real estate business. Create a detailed plan outlining your targets and how you’ll achieve them. Never stop learning; invest in coaching and education to stay ahead of the market and improve your skills. Knowledge is your greatest asset.”</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6">
            <div class="card mb-4">
                <img src="public/images/speaker/brandon.jpg" class="card-img-top p-2" alt="Brandon Turner" style="height: 200px; object-fit: cover;">
                <div class="card-body d-flex flex-column" style="height: 250px;">
                    <h5 class="card-title">Brandon Turner: Starting Small and Building Connections</h5>
                    <p class="card-text flex-grow-1">“If you’re new to real estate investing, start small. Look for manageable properties that allow you to learn without overwhelming risk. And remember, your network is crucial. Surround yourself with experienced investors and mentors who can guide you and open doors to new opportunities.”</p>
                </div>
            </div>
        </div>

    </div>

    </div>


<!-- Parent End Tag -->
</div>
