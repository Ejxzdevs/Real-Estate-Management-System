<div style="overflow-y: scroll; height:auto; padding: 1rem 0; " >

<div class="container-fluid d-flex flex-column m-0 p-0"  >
    <div class="container-fluid" >
        <h3 class="fw-semibold font-serif py-3 mt-2 fs-4 ">Dashbord</h3>
    </div>
    <!-- First row -->
     
    <div class="container-fluid border d-flex flex-row justify-content-around" style="cursor: pointer;"  >
        <!-- each div -->
        <div class="border my-4 rounded-1 shadow d-flex flex-col pt-3" style="width: 220px; height: 100px; " >
            <div class="d-flex flex-column ps-3" style="width:65%;">
                <p class="text-secondary p-0 m-0 fs-6" >House For Sale</p>
                <p class="p-0 m-0 fw-bolder fs-2" >223</p>
            </div>
            <div class="d-flex justify-content-center align-items-center" style="width:35%;" >
                <i class="bi bi-house-door mb-3 me-3" style="font-size:50px; color: #294cab;"></i>
            </div>
        </div>

        <div class="border my-4 rounded-1 shadow d-flex flex-col pt-3" style="width: 220px; height: 100px; " >
            <div class="d-flex flex-column ps-3" style="width:65%;">
                <p class="text-secondary p-0 m-0 fs-6" >House For Rent</p>
                <p class="p-0 m-0 fw-bolder fs-2" >543</p>
            </div>
            <div class="d-flex justify-content-center align-items-center" style="width:35%;" >
                <i class="bi bi-house-door mb-3 me-3" style="font-size:50px; color: #b8071f;"></i>
            </div>
        </div>

        <div class="border my-4 rounded-1 shadow d-flex flex-col pt-3" style="width: 220px; height: 100px; " >
            <div class="d-flex flex-column ps-3" style="width:65%;">
                <p class="text-secondary p-0 m-0 fs-6" >Total Sales</p>
                <p class="p-0 m-0 fw-bolder fs-2" >443</p>
            </div>
            <div class="d-flex justify-content-center align-items-center" style="width:35%;" >
                <i class="bi bi-house-door mb-3 me-3" style="font-size:50px; color:#8f9196;"></i>
            </div>
        </div>

        <div class="border my-4 rounded-1 shadow d-flex flex-col pt-3" style="width: 220px; height: 100px; " >
            <div class="d-flex flex-column ps-3" style="width:65%;">
                <p class="text-secondary p-0 m-0 fs-6" >Total Inquiries</p>
                <p class="p-0 m-0 fw-bolder fs-2" >143</p>
            </div>
            <div class="d-flex justify-content-center align-items-center" style="width:35%;" >
                <i class="bi bi-envelope-at mb-3 me-3" style="font-size:50px; color:#44964b;"></i>
            </div>
        </div>
    </div>

    
    <!-- 2nd row -->
    <div class="container-fluid d-flex flex-col justify-content-around gap-2 p-3">
        <div class="border" style="width: 650px"  >
            <canvas id="myChart"></canva>
        </div>
        <div class="border" style="width: 300px;" >
            <p>latest properties</p>
        </div>
        
    </div>

 
</div>


</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['January', 'February', 'March', 'April', 'May', 'June' , 'July' , 'August' , 'September' , 'October', 'November', 'December'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
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