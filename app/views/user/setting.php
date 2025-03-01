<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตั้งค่าโปรไฟล์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php require_once '../app/component/navbar.php'; ?>
    <div class="container text-center">
        <form action="/update/user/data" method="post" class="mt-3 card p-4 shadow-sm" style="max-width: 500px; margin: auto;border-radus:50%;">
            <h3 class="mb-3">กรอกข้อมูลผู้ใช้</h3>
            <div class="mb-3">
                <img id="profileImage" src="<?= $_SESSION['login_image'] ?>" width="150px" class="profile-pic mb-2" alt="Profile">
            </div>
            <div class="mb-3 text-start">
                <label class="form-label">ชื่อ</label>
                <input type="text" class="form-control" name="fname" placeholder="กรอกชื่อ">
            </div>
            <div class="mb-3 text-start">
                <label class="form-label">นามสกุล</label>
                <input type="text" class="form-control" name="lname" placeholder="นามสกุล">
            </div>
            <div class="mb-3 text-start">
                <label class="form-label">วันเกิด</label>
                <input type="date" name="birthday" class="form-control">
            </div>
            <div class="mb-3 text-start">
                <label class="form-label">เพศ</label>
                <select class="form-select" name="gender">
                    <option>ชาย</option>
                    <option>หญิง</option>
                    <option>อื่น ๆ</option>
                </select>
            </div>
            <div class="mb-3 text-start">
                <a href="/privacy-policy" class="btn btn-link">อ่านนโยบายการเก็บข้อมูลส่วนตัว</a>
            </div>
            <div class="mb-3 text-start">
                <button class="btn btn-success w-100 mt-3 btn-login">เข้าสู่ระบบ</button>
            </div>
        </form>
    </div>
</body>

</html>