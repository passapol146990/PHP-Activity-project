<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตั้งค่าโปรไฟล์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>
    <?php require_once '../app/component/navbar.php'; ?>
    <div class="container text-center">
        <div class="mt-3 card p-4 shadow-sm" style="max-width: 500px; margin: auto;border-radus:50%;">
            <div class="text-start mb-3">
                <a href="#" class="btn btn-primary">กลับหน้าหลัก</a>
            </div>

            <div class="mb-3 ">
                <img class="rounded-circle" id="profileImage" src="<?= $_SESSION['login_image'] ?>" width="150px" class="profile-pic mb-2" alt="Profile">
            </div>
            <h2 class="mt-3">พัสพล สุทธาธรรม </h2>
            <h2>เข้าร่วมเมื่อ 14/11/2567 11:32:08 </h2>
            <div class="mt-3 text-start">
                <p><strong>เพศ:</strong> ชาย</p>
                <p><strong>วันเกิดของคุณ</strong></p>
                <p><i class="bi bi-calendar"></i> 06/06/2000</p>
            </div>

        </div>

    </div>
</body>

</html>