<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตั้งค่า</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="shortcut icon" type="image/x-icon" href="../Logo_size32.png">
</head>
<body>
    <?php require_once '../app/component/navbar.php'; ?>
    <script>
        const x = document.querySelector(".search-container");
        x.remove();
    </script>
    <div class="container text-center">
        <div class="mt-3 card p-4 shadow-sm" style="max-width: 500px; margin: auto;border-radus:50%;">
            <div class="mb-3 ">
                <img class="rounded-circle" id="profileImage" src="/get/image?img=/user/<?= $_SESSION['login_image'] ?>" width="150px" class="profile-pic mb-2" alt="Profile">
            </div>
            <h2 class="mt-3"><?= htmlspecialchars($account["fname"]." ".$account["lname"]) ?></h2>
            <h4>เข้าร่วมเมื่อ <?= htmlspecialchars(formatThaiDate($account["datetime"])) ?></h4>
            <div class="mt-3 text-start">
                <lable><b>เพศ:</b> <?= htmlspecialchars($account["gender"]) ?></lable><br>
                <lable><b>วันเกิดของคุณ:</b> <?= htmlspecialchars(formatThaiDate($account["birthday"])) ?></lable>
            </div>
            <div class="text-end mt-5">
                <a href="https://www.facebook.com/passapol.sutatam" target="_blank">ติดต่อผู้ดูแลระบบ</a>
            </div>
        </div>
    </div>
</body>
</html>