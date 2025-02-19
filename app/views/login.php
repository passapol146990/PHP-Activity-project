<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>เข้าสู่ระบบ</title>
</head>
<body class="bg-dark">
<nav id="navbar"></nav>
    <div class="d-flex justify-content-center">
        <form method="post" action="/login" class="card shadow rounded p-5 m-5 w-50">
            <div class="mb-3">
                <h2>login</h2>
            </div>
            <div class="mb-3">
                <label class="form-label">username</label>
                <input class="form-control" type="text" name="username" id="" placeholder="username" require>
            </div>
            <div class="mb-3">
                <label class="form-label">password</label>
                <input class="form-control" type="password" name="password" id="" placeholder="password" require>
            </div>
            <? if(isset($_GET["message"])) { ?>
                <div class="text-danger">
                    <p>*<?= $_GET["message"] ?></p>
                </div>
            <? } ?>
            <div class="mb-3 text-end">
                <button class="btn btn-primary" type="submit">Login</button>
            </div>
        </form>
    </div>
</body>
</html>
