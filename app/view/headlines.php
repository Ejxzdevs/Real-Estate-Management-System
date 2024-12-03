<?php 
require_once 'app/http/helper/displayNews.php';
$news = new DisplayNews();
$data = $news->getAllNews();


?>

<div class="container-fluid py-5 m-0" style="height: auto;" >
    <div class="d-flex flex-row" style="height:100px;">
     
        <div class="d-flex align-items-center justify-content-center" style="width:100%;">
            <div class="input-group" style="width:450px">
                <input type="text" class="form-control border" placeholder="Search..." aria-label="Search">
                <button class="btn btn-outline-secondary" type="button"><i class="bi bi-search"></i></button>
            </div>
        </div>
    </div>
    <div class="container-fluid d-flex flex-wrap gap-2 py-4 m-0 " style="height:auto;" >
        <div class="d-flex align-items-center " style="width:100%;">
            <h3 class="fw-medium">News</h3>
        </div>
        <?php foreach($data as $news): ?>
                <div class="card border d-flex flex-row p-0 shadow " style="height: 200px; width: 600px; cursor: pointer; " >
                    <div class="border p-1 d-flex justify-content-center align-items-center" style="width: 50%;" >
                        <img class="rounded-3" style="height: 180px;" src="public/images/products/<?php echo htmlspecialchars($news['image']); ?>" alt="">
                    </div>
                    <div class="d-flex flex-column ps-2" style="width: 60%;" >
                        <div class="d-flex flex-column m-0 p-2" style="height: auto;" >
                            <p class="m-0 p-0 text-secondary" style="font-size: 10px;" >Posted: <?php echo htmlspecialchars(date('F j, Y', strtotime($news['date_added']))); ?></p>
                            <p class="m-0 p-0 fw-bold fs-6"><?php echo htmlspecialchars($news['news_title']); ?></p>
                        </div>
                        <div class="ps-1 pe-2 py-0 " style="overflow:hidden; height:115px;">
                            <p class="mt-2 mx-0 text-wrap" style="font-size: 10px; " ><?php echo htmlspecialchars($news['news_content']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            
    </div>
</div>