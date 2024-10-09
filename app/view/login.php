<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
    <style>
        body{
            height: 100vh;
        }
        .custom-form{
            height: 350px;
            width: 320px;
            background-color: #F5F5F5;
        }
        .custom-width{
            width: 280px;
        }
    </style>
<body>
    <div class="h-100 d-flex justify-content-center align-items-center">
            <form action="" class="border border-radius custom-form rounded-3 ">
                <div class="h-25 d-flex flex-column justify-content-center ps-4   ">
                   <h4 class="text-center"> User Login</h4>
                </div>
                <div class="h-25 d-flex flex-column justify-content-center ps-4   ">
                    <label class="form-label fw-medium">Email</label>
                    <input type="name" name="email" class="custom-width form-control" placeholder="Enter your email">
                </div>
                <div class="h-25 d-flex flex-column justify-content-center ps-4   ">
                    <label class="form-label fw-medium">Password</label>
                    <input type="password" name="password" class="custom-width form-control" placeholder="Enter your password">
                </div>
                <div class="h-25 d-flex flex-column justify-content-center ps-4">
                    <button class="custom-width btn btn-dark letter-spacing-lg text-capitalize">Login</button>
                </div>
            </form>
    </div>
</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>