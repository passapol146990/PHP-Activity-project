<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="Logo_size32.png">
    <title>ค้นหาผู้ใช้</title>
</head>

<body>
    <?php require_once '../app/component/navbar.php'; ?>
    <div class="event-section text-center">
        <div class="col-md-8 offset-md-2 bg-white p-5 mt-2 mb-5 rounded shadow">
            <h1 class="title text-start">ค้นหาผู้ใช้</h1>
            <form method="GET" action="/search/accout" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search_query" class="form-control" placeholder="กรอกชื่อผู้ใช้ที่ต้องการค้นหา" required value="<?= $search_query ?>">
                    <button type="submit" class="btn btn-primary">ค้นหา</button>
                </div>
            </form>
            <hr>
            <h2 class="title text-start">ผู้ใช้ที่ค้นหา</h2>
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">รูปปก</th>
                        <th scope="col">ชื่อ-นามสกุล</th>
                        <th scope="col">จำนวนกิจกรรมที่สร้าง</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data["data"] as $key => $accout) { ?>
                            <tr>
                                <th scope="row">
                                    <img src="/get/image?img=/user/<?= htmlspecialchars($accout["image"]) ?>" alt="" width="50px" height="50px" style="border-radius: 50%;">
                                </th>
                                <td><?= htmlspecialchars($accout["fname"].' '.$accout["lname"]) ?></td>
                                <td><?= htmlspecialchars($accout["count_post"]) ?></td>
                                <td>
                                    <a href="/profile?user=<?= htmlspecialchars($accout["aid"]) ?>" class="btn btn-primary">ดูโปรไฟล์</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        const x = document.querySelector(".search-container");
        x.remove();
    </script>
</body>

</html>