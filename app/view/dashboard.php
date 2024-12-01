<?php 
require_once 'app/http/helper/displayInventory.php';
require_once 'app/http/helper/displayProduct.php';
require_once 'app/http/helper/displayInquiry.php';

// display 5 recent inventory
$inventory = new DisplayInventory();
$recentSales = $inventory->latestTransactions();
// total sales
$totalSales = $inventory->total_sales();

// display total rent and sell
$total_product = new DisplayProduct();
$total = $total_product->NumRentSell();

// display total Inquiry
$total_inquiries = new DisplayInquiries();
$num_inquiry = $total_inquiries->getTotalInquiries();


?>


<div class="overflow-y-scroll pb-1"  style="height:120vh;" >

<div class="container-fluid d-flex flex-column m-0 p-0"  >
    <div class="container-fluid mt-4" >
        <h3 class="fw-semibold font-serif fs-4 ">Dashboard</h3>
    </div>
    <!-- First row -->
     
    <div class="container-fluid d-flex flex-row justify-content-around" style="cursor: pointer;"  >
        <!-- each div -->
        <a href="admin.php?route=product" class="text-decoration-none text-black border my-4 rounded-1 shadow d-flex flex-col pt-3" style="width: 220px; height: 100px; " >
            <div class="d-flex flex-column ps-3" style="width:65%;">
                <p class="text-secondary p-0 m-0 fs-6" >House For Sale</p>
                <p class="p-0 m-0 fw-bolder fs-2" ><?php echo $total[0]['Total_Sell'] ?></p>
            </div>
            <div class="d-flex justify-content-center align-items-center" style="width:35%;" >
                <i class="bi bi-house-door mb-3 me-3" style="font-size:50px; color: #294cab;"></i>
            </div>
        </a>

        <a href="admin.php?route=product" class="text-decoration-none text-black border my-4 rounded-1 shadow d-flex flex-col pt-3" style="width: 220px; height: 100px; " >
            <div class="d-flex flex-column ps-3" style="width:65%;">
                <p class="text-secondary p-0 m-0 fs-6" >House For Rent</p>
                <p class="p-0 m-0 fw-bolder fs-2" ><?php echo $total[0]['Total_Rent'] ?></p>
            </div>
            <div class="d-flex justify-content-center align-items-center" style="width:35%;" >
                <i class="bi bi-house-door mb-3 me-3" style="font-size:50px; color: #b8071f;"></i>
            </div>
        </a>

        <a href="admin.php?route=inventory" class="text-decoration-none text-black border my-4 rounded-1 shadow d-flex flex-col pt-3" style="width: 220px; height: 100px; " >
            <div class="d-flex flex-column ps-3" style="width:65%;">
                <p class="text-secondary p-0 m-0 fs-6" >Total Sales</p>
                <p class="p-0 m-0 fw-bolder fs-2" ><?php echo $totalSales[0]['Total_Sales']; ?></p>
            </div>
            <div class="d-flex justify-content-center align-items-center" style="width:35%;" >
                <i class="bi bi-house-door mb-3 me-3" style="font-size:50px; color:#8f9196;"></i>
            </div>
        </a>

        <a href="admin.php?route=inquiry" class="text-decoration-none text-black border my-4 rounded-1 shadow d-flex flex-col pt-3" style="width: 220px; height: 100px; " >
            <div class="d-flex flex-column ps-3" style="width:65%;">
                <p class="text-secondary p-0 m-0 fs-6" >Total Inquiries</p>
                <p class="p-0 m-0 fw-bolder fs-2" ><?php echo $num_inquiry[0]['total_inquiries']; ?></p>
            </div>
            <div class="d-flex justify-content-center align-items-center" style="width:35%;" >
                <i class="bi bi-envelope-at mb-3 me-3" style="font-size:50px; color:#44964b;"></i>
            </div>
        </a>
    </div>

    
    <!-- 2nd row -->
    <div class="container-fluid d-flex flex-col justify-content-around gap-2 p-3">
        <div class="border" style="width: 650px"  >
            <canvas id="myChart"></canva>
        </div>
        <div class="border px-3 overflow-y-auto" style="width: 300px; height: 330px; " >
            <div class="d-flex align-items-center" style="height: 40px;" >
                <p class="fw-medium fs-5 m-0 p-0" >Latest Sales</p>
            </div>
            <div>
                <ul class="p-0 m-0 ">
                    <?php foreach($recentSales as $sale): ?>
                        <li>
                            <div class="border d-flex flex-row align-items-center p-2 gap-2 mb-1 rounded-1 shadow-sm" >
                                <div>
                                    <img class="rounded-1" src="public/images/products/<?php echo $sale['image'] ?>" style="height: 35px;">
                                </div>
                                <div>
                                    <p class="p-0 m-0 fs-6 fw-bold" ><?php echo $sale['name'] ?></p>
                                    <p class="p-0 m-0 text-secondary"><?php echo $sale['price'] ?></p>
                                </div>
                            </div>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
        
    </div>

    <!-- 3rd row -->
     <div class="border" style="height: 700px;" >
            <p>ww</p>
     </div>

 
</div>


</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN' ,'JUL' , 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
      datasets: [{
        label: 'Revenue',
        data: [12, 19, 3, 5, 2, 3,3,15,3,52,12,3],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>