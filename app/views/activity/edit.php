<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="../Logo_size32.png">
    <link rel="stylesheet" href="../../style/activity/edit.css">
    <title>แก้ไขกิจกรรม</title>
</head>
<body>
    <div class="d-flex justify-content-center p-5">
        <form class="form-content bg-white" action="/activity/edit" method="POST" enctype="multipart/form-data">
            <div class="p-2 mb-3">
                <a href="/activity/create/show" class="btn btn-primary">&larr; กลับ</a>
            </div>
            <h2 class="mb-3">แก้ไขกิจกรรม : <?= htmlspecialchars($result['post_name'] ?? '') ?></h2>
                <input type="hidden" name="p_id" value="<?php echo htmlspecialchars($p_id); ?>">
            <div class="mb-3">
                <label for="image-upload" class="form-label">รูปภาพกิจกรรม</label>
                <input type="file" class="form-control" id="image-upload" name="images[]" accept="image/*" multiple>
                <div id="image-preview" class="image-preview-container" data-existing-images="<?= htmlspecialchars($result['images'] ?? '') ?>"></div>
                <div id="image-newupload" class="image-preview-container" data-existing-images="<?= htmlspecialchars($result['images'] ?? '') ?>"></div>
            </div>
            <div class="p-2">
                <label class="form-label ms-1"> ชื่อกิจกรรม :</label>
                <input type="text" class="form-control mb-1" id="title" name="title" placeholder="ชื่อกิจกรรมของคุณ..." value="<?= htmlspecialchars($result['post_name'] ?? '') ?> " required>
            </div>
            <div class="p-2">
                <label for="description" class="form-label">รายละเอียดกิจกรรม</label>
                <textarea class="form-control" id="description" name="description" rows="4" required><?= htmlspecialchars($result['post_about'] ?? '') ?></textarea>
            </div>
            <div class="p-2">
                <label class="form-label ms-1"> จำนวนที่รับสมัคร :</label>
                <input type="text" class="form-control" id="max-count" name="max_count" placeholder="จำนวนที่รับสมัครของคุณ..." value="<?= htmlspecialchars($result['post_max']) ?>" required>
            </div>
            <div class="p-2">
                <label for="start-date" class="form-label ms-1">วันที่จัดกิจกรรม :</label>
                <div class="form-group d-flex align-items-center">
                    <input type="date" class="form-control" id="start-date" name="start_date" value="<?= htmlspecialchars($result['post_start']) ?>"
                        required style="width: 220px;">
                    <label for="end-date" class="form-label ms-1 me-1"> - </label>
                    <input type="date" class="form-control" id="end-date" name="end_date" value="<?= htmlspecialchars($result['post_end']) ?>"
                        required style="width: 220px;">
                </div>
            </div>
            <div class="p-2">
                <label class="form-label ms-1"> สถานที่จัดกิจกรรม :</label>
                <input type="text" class="form-control" id="location" name="location" placeholder="สถานที่จัดกิจกรรมของคุณ..." value="<?= htmlspecialchars($result['post_address']) ?>" required>
            </div>
            <div class="p-2">
                <label for="location" class="form-label">สิ่งที่ผู้เข้าร่วมจะได้รับ</label>
                <input type="text" class="form-control" id="p_give" name="p_give" value="<?= htmlspecialchars($result['post_give']) ?>" required>
            </div>
            <div class="p-2 d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-warning">แก้ไขกิจกรรม</button>
            </div>
        </form>
    </div>
    <script src="../../js/activity/edit.js"></script>
</body>
</html>