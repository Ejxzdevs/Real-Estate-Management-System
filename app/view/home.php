<div class="homeContainer">
    <div class="container">
        <h1 class="mt-5">Hello, Bootstrap!</h1>
        <p class="lead">This is a simple Bootstrap example using Composer.</p>
        
        <button type="button" class="btn btn-primary">Click Me!</button>
    </div>
    <h5>HOME HERE <?php if(isset($_GET['id'])) echo htmlspecialchars($_GET['id']); ?></h5>
</div>