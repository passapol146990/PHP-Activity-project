<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="../Logo_size32.png">
    <link rel="stylesheet" href="../../style/activity/create.css">
    <title>สร้างกิจกรรม</title>
</head>
<body class="bg-dark">
    <?php require_once '../app/component/navbar.php'; ?>
    <div class="container mt-1">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="h1 p-2">
                        <h3 class="mb-0">สร้างกิจกรรมของคุณ</h3>
                    </div>
                    <div class="card-body">
                        <form class="p-3" action="/activity/create" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="image-upload" class="form-label">รูปภาพกิจกรรม</label>
                                <input type="file" class="form-control" id="image-upload" name="images[]" accept="image/*" multiple>
                                <div class="form-text">อัพโหลดได้หลายรูป (สูงสุด 2MB ต่อรูป, รองรับไฟล์ JPEG, PNG)</div>
                                <div id="image-preview" class="image-preview-container"></div>
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">ชื่อกิจกรรม</label>
                                <input type="text" class="form-control" id="title" name="title" required maxlength="50" placeholder="ชื่อกิจรรมของคุณไม่เกิน 50 ตัวอักษร">
                            </div>
                            
                            <div class="mb-3">
                                <label for="description" class="form-label">รายละเอียดกิจกรรม</label>
                                <textarea class="form-control" id="description" name="description" rows="4" required maxlength="5000" placeholder="รายละเอียดกิจกรรม"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="max-count" class="form-label">จำนวนคนที่รับสมัคร</label>
                                <input type="number" class="form-control" id="max-count" name="max_count" required>
                            </div>
                            <div class="mb-3">
                                <label for="start-date" class="form-label">วันที่จัดกิจกรรม</label><br>
                                <input type="date" class="" id="start-date" name="start_date" required>
                                <label for="start-date" class="form-label">-</label>
                                <input type="date" class="" id="end-date" name="end_date" required>
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">สถานที่จัดกิจกรรม</label>
                                <input type="text" class="form-control" id="location" name="location" required maxlength="2000">
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">สิ่งที่ผู้เข้าร่วมจะได้รับ</label>
                                <input type="text" class="form-control" id="p_give" name="p_give" required maxlength="200">
                            </div>
                            
                            <div class="mt-4" id="s">
                                <button type="submit" class="btn btn-primary" onClick="s(event)">บันทึกกิจกรรม</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/activity/create.js"></script>
</body>
</html>