<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="../../Logo_size32.png">
    <link rel="stylesheet" href="../../style/activity/show.css">
    <title>กิจกรรมที่สร้าง</title>
    <style>
        body {
            font-family: 'Mitr', sans-serif;
            background-color: #f7f7f7;
        }

        .search-container {
            max-width: 600px;
            margin: 100px auto;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background: white;
        }

        .user-card {
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .user-card p {
            margin: 0;
            color: #333;
        }

        .btn-back {
            display: inline-block;
            margin: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <a href="/" class="btn-back">หน้าแรก</a>
    <div class="container search-container">
        <h1 class="text-center mb-4">ค้นหาผู้ใช้</h1>
        <form action="/activity/Show" method="POST">
            <div class="mb-3">
                <input type="text" name="search" class="form-control" placeholder="กรอกชื่อผู้ใช้เพื่อค้นหา" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">ค้นหา</button>
        </form>

        <?php if (isset($users) && is_array($users)): $count = 1; ?>
            <?php foreach ($users as $user): ?>
                <div class="user-card">
                    <p>ลำดับที่: <?= $count; ?></p>
                    <img src="<?= htmlspecialchars($user['image']); ?>" alt="Profile Picture" style="width:100px; height:auto;">
                    <p>ชื่อ: <?= htmlspecialchars($user['fname']); ?></p>
                    <p>นามสกุล: <?= htmlspecialchars($user['lname']); ?></p>
                    <p>Email: <?= htmlspecialchars($user['gmail']); ?></p>
                    <p>เพศ: <?= htmlspecialchars($user['gender']); ?></p>
                    <?php if (isset($user['p_name'])): ?>
                        <p>กิจกรรม: <?= htmlspecialchars($user['p_name']); ?></p>
                    <?php endif; ?>
                </div>
            <?php $count++;
            endforeach; ?>
        <?php else: ?>
            <p>ไม่มีข้อมูลผู้ใช้ที่ค้นหาพบ</p>
        <?php endif; ?>


    </div>
</body>

</html>