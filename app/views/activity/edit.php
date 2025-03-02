<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <title>แก้ไขกิจกรรม</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(251, 235, 235);
        }

        .form-content {
            background-color: rgba(128, 128, 128, 0.1); /* สีเทาและโปร่งแสง */
            padding: 20px;
            border-radius: 10px;
            font-family: 'Mitr';
            width: 800px;
        }

        .image-upload-container {
            position: relative;
            width: 100%;
            max-width: 728px;
            margin: auto;
            text-align: center;
            
            
        }

        .image-preview {
            width: 100%; /* ให้รูปไม่เกินขอบของ container */
            max-width: 728px; /* กำหนดขนาดสูงสุด */
            height: 420px;
            border-radius: 10px;
            object-fit: cover;
            background-color: #ddd; /* สีพื้นหลัง */
            cursor: pointer; /* ทำให้รู้ว่ากดได้ */
            display: block;
            margin: auto;
        }


        .upload-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
        }

        .change-btn {
            margin-top: 10px;
            display: none; /* ซ่อนปุ่มเปลี่ยนรูปในตอนแรก */
        }

        input::placeholder {
            color: rgba(250, 239, 239, 0.3);
            font-size: 14px;
        }

        .btn-primary {
            width: 100px;

        }

        .preview-image {
            width: 330px;
            height: 240px;
            object-fit: cover;
            margin: 5px;
        }

        .image-preview-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .remove-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: rgba(255, 0, 0, 0.7);
            color: white;
            border: none;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            font-size: 12px;
            line-height: 1;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image-preview-item {
            position: relative;
        }

        .raduis {
            border-radius: 10px;
        }
        
    </style>
</head>
<body>
    
    <div class="p-2 ms-2">
        <a href="/" class="btn btn-primary">&larr; กลับ</a>
    </div>
    <div class="d-flex justify-content-center">
        <form class="form-content" action="/activity/edit" method="POST" enctype="multipart/form-data">
           <h2 class="mb-3 ms-3">แก้ไขกิจกรรม : <?= htmlspecialchars($result['post_name'] ?? '') ?></h2>
           <input type="hidden" name="p_id" value="<?php echo htmlspecialchars($p_id); ?>">

            <div class="mb-3">
                <label for="image-upload" class="form-label">รูปภาพกิจกรรม</label>
                <!--<input type="file" class="form-control" id="image-upload" name="images[]" accept="image/*" multiple>
                <div class="form-text">อัพโหลดได้หลายรูป (สูงสุด 5MB ต่อรูป, รองรับไฟล์ JPEG, PNG)</div> -->

                <div id="image-preview" class="image-preview-container"
                    data-existing-images="<?= htmlspecialchars($result['images'] ?? '') ?>">
                </div>
            </div>

            <div class="p-2">
                <label class="form-label ms-1"> ชื่อกิจกรรม :</label>
                <input type="text" class="form-control mb-1" id="title" name="title" placeholder="ชื่อกิจกรรมของคุณ..." 
                    value="<?= htmlspecialchars($result['post_name'] ?? '') ?> " required>
            </div>


            <div class="p-2">
            <label for="description" class="form-label">รายละเอียดกิจกรรม</label>
            <textarea class="form-control" id="description" name="description" rows="4"
             required><?= htmlspecialchars($result['post_about'] ?? '') ?></textarea>
        </div>

            <div class="p-2">
                <label class="form-label ms-1"> จำนวนที่รับสมัคร :</label>
                <input type="text" class="form-control" id="max-count" name="max_count" placeholder="จำนวนที่รับสมัครของคุณ..." 
                    value="<?= htmlspecialchars($result['post_max']) ?>" required>
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
                <input type="text" class="form-control" id="location" name="location" placeholder="สถานที่จัดกิจกรรมของคุณ..." 
                    value="<?= htmlspecialchars($result['post_address']) ?>" required>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>

document.addEventListener("DOMContentLoaded", function () {
    const preview = document.getElementById("image-preview");

    // โหลดรูปที่มีอยู่จากฐานข้อมูล
    let existingImages = preview.getAttribute("data-existing-images");
    console.log('Existing Images:', existingImages); // ดูค่าที่ได้จากฐานข้อมูล

    if (existingImages) {
        existingImages = existingImages.split(",");  // แก้ไข split
        existingImages.forEach((imageName) => {
            if (imageName.trim() !== "") {
                let imageUrl = "/get/image?img=/post/" + imageName.trim();  // สร้าง URL รูปจาก path
                addImageToPreview(imageUrl, false);  // เรียกใช้ฟังก์ชันแสดงรูป
            }
        });
    }

    function addImageToPreview(src, isNew = true) {
        const div = document.createElement("div");
        div.className = "image-preview-item";

        const img = document.createElement("img");
        img.src = src;
        img.className = "preview-image";
        img.title = "รูปภาพ";

       /* const removeBtn = document.createElement("button");
        removeBtn.className = "remove-btn";
        removeBtn.innerHTML = "×";
        removeBtn.title = "ลบรูปนี้";
        removeBtn.onclick = function () {
            div.remove();
            return false;
        }; */

        div.appendChild(img);
        //div.appendChild(removeBtn);
        preview.appendChild(div);
    }

    // แสดงรูปจาก input file
    document.getElementById("image-upload").addEventListener("change", function (event) {
        const files = event.target.files;
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (!file.type.match("image.*")) continue;

            const reader = new FileReader();
            reader.onload = function (e) {
                addImageToPreview(e.target.result);  // เพิ่มรูปที่เลือก
            };
            reader.readAsDataURL(file);
        }
    });
});


</script>


</body>
</html>
