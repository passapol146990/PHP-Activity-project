<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>อัพเดทข้อมูล</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="../Logo_size32.png">
    <style>
        body {
            background: linear-gradient(to right, #f77062, #fe5196);
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        #profileImage{
            border-radius: 50%;
        }
    </style>
</head>
<body class>
    <div class="container text-center">
        <form action="/update/user/data" method="post" class="mt-3 card p-4 shadow-sm" style="max-width: 500px; margin: auto;">
            <div class="mb-3 text-start">
                <a class="btn btn-danger" href="/logout">ออกจากระบบ</a>
            </div>
            <h4 class="mb-2">กรอกข้อมูลผู้ใช้</h4>
            <div class="mb-3">
                <img id="profileImage" src="/get/image?img=/user/<?= htmlspecialchars($_SESSION['login_image']) ?>" width="100px" class="profile-pic mb-2" alt="Profile"><br>
            </div>
            <div class="mb-3 text-start">
                <label class="form-label">ชื่อ</label>
                <input type="text" class="form-control" name="fname" placeholder="กรอกชื่อ" value="<?= htmlspecialchars($account["fname"]??"") ?>" required>
            </div>
            <div class="mb-3 text-start">
                <label class="form-label">นามสกุล</label>
                <input type="text" class="form-control" name="lname" placeholder="นามสกุล" value="<?= htmlspecialchars($account["lname"]??"") ?>" required>
            </div>
            <div class="mb-3 text-start">
                <label class="form-label">วันเกิด</label>
                <input type="date" name="birthday" class="form-control" value="<?= htmlspecialchars($account["birthday"]??"") ?>" required>
            </div>
            <div class="mb-3 text-start">
                <label class="form-label">เพศ</label>
                <select class="form-select" name="gender" required>
                    <option style="display:none;"><?= htmlspecialchars($account["gender"]??"กรุณาใส่เพศ") ?></option>
                    <option>ชาย</option>
                    <option>หญิง</option>
                    <option>อื่นๆ</option>
                </select>
            </div>
            <div class="mb-1 text-start">
                <a href="/privacy-policy" class="btn btn-link">อ่านนโยบายการเก็บข้อมูลส่วนตัว</a>
            </div>
            <div class="mb-3 text-start">
                <button class="btn btn-success w-100 mt-3 btn-login">เข้าสู่ระบบ</button>
            </div>
        </form>
    </div>
</body>
</html>
