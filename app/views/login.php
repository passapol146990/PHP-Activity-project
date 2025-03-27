<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="shortcut icon" type="image/x-icon" href="Logo_size32.png">
    <link rel="stylesheet" href="style/login.css">
    <title>เข้าสู่ระบบ</title>
</head>
<body>
    <nav id="navbar"></nav>
    <div class="login-box text-center">
        <h1>Login</h1>
         <p>Please Login with your Email </p> <!-- <p>Please Login with Google account</p> -->
    </div>
    <!-- <div class="login-form">
        <a href="/auth/google" class="btn btn-light w-100 btn-google mb-3">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Google_%22G%22_logo.svg/1200px-Google_%22G%22_logo.svg.png"
                alt="Google Logo" width="30" class="me-2">
            Sign in with Google
        </a>
    </div> -->
    <div class="login-form">
        <h2 class="text-center">Login</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="email" class="" style="color:aliceblue"> Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3 ">
                <label for="password" class=""  style="color:aliceblue">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="text-center"> <button type="submit" class="btn btn-primary w-50">Login</button></div>
        </form>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>