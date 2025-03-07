<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>เข้าสู่ระบบ</title>
    <link rel="shortcut icon" type="image/x-icon" href="Logo_size32.png">
    <style>
        body {
            background: linear-gradient(to right, #f77062, #fe5196);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .login-box {
            position: absolute;
            top: -5%;
            left: 8%;
            width: 450px;
            height: 80vh;
            background: white;
            border-radius: 30px;
            box-shadow: 8px 8px 20px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-box h1 {
            font-size: 6rem;
            font-weight: bold;
            color: #ff4500;
        }

        .login-box p {
            color: gray;
            font-weight: 600;
        }

        .login-form {
            position: absolute;
            top: 50%;
            left: 58%;
            transform: translate(-10%, -50%);
            width: 400px;
        }

        .btn-google {
            background: white;
            border-radius: 50px;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-login {
            position: relative;
            overflow: hidden;
            background: linear-gradient(to right, #ff4500, black);
            color: white;
            border-radius: 50px;
            font-weight: bold;
            padding: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: none;
        }

        /* Slide effect */
        .btn-login::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, #ff6347, black);
            transition: 0.4s ease-in-out;
        }

        .btn-login:hover::before {
            left: 0;
        }

        .btn-login span {
            position: relative;
            z-index: 1;
        }
    </style>
</head>

<body>
    <nav id="navbar"></nav>
    <div class="login-box text-center">
        <h1>Login</h1>
        <p>Please Login with Google account</p>
    </div>
    <div class="login-form">
        <a href="/auth/google" class="btn btn-light w-100 btn-google mb-3">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Google_%22G%22_logo.svg/1200px-Google_%22G%22_logo.svg.png"
                alt="Google Logo" width="30" class="me-2">
            Sign in with Google
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>