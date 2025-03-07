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
    <title>แก้ไขกิจกรรม</title>
    <style>
        body {
            background: linear-gradient(to right, #f77062, #fe5196);
            font-family: Arial, sans-serif;
        }

        .form-content {
            background-color: rgba(128, 128, 128, 0.1);
            /* สีเทาและโปร่งแสง */
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
            width: 100%;
            /* ให้รูปไม่เกินขอบของ container */
            max-width: 728px;
            /* กำหนดขนาดสูงสุด */
            height: 420px;
            border-radius: 10px;
            object-fit: cover;
            background-color: #ddd;
            /* สีพื้นหลัง */
            cursor: pointer;
            /* ทำให้รู้ว่ากดได้ */
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
            display: none;
            /* ซ่อนปุ่มเปลี่ยนรูปในตอนแรก */
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
    <div class="d-flex justify-content-center p-5">
        <form class="form-content bg-white" action="/activity/edit" method="POST" enctype="multipart/form-data">
            <div class="p-2 mb-3">
                <a href="/activity/create/show" class="btn btn-primary">&larr; กลับ</a>
            </div>
            <? print_r($result['images']) ?>
            <h2 class="mb-3">แก้ไขกิจกรรม : <?= htmlspecialchars($result['post_name'] ?? '') ?></h2>
            <input type="hidden" name="p_id" value="<?php echo htmlspecialchars($p_id); ?>">
            <div class="mb-3">
                <label for="image-upload" class="form-label">รูปภาพกิจกรรม</label>
                <!-- <input type="file" class="form-control" id="image-upload" name="images[]" accept="image/*" multiple> -->
                <div id="image-preview" class="image-preview-container" data-existing-images="<?= htmlspecialchars($result['images'] ?? '') ?>"></div>
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const preview = document.getElementById("image-preview");
            let existingImages = preview.getAttribute("data-existing-images");
            if (existingImages) {
                existingImages = existingImages.split(",");
                existingImages.forEach((imageName) => {
                    if (imageName.trim() !== "") {
                        let imageUrl = "/get/image?img=/post/" + imageName.trim();
                        addImageToPreview(imageUrl,  imageName.trim());
                    }
                });
            }

            function addImageToPreview(src ,image) {
                const div = document.createElement("div");
                div.className = "image-preview-item";
                const img = document.createElement("img");
                img.src = src;
                img.className = "preview-image";
                img.title = "รูปภาพ";
                const removeBtn = document.createElement('button');
                removeBtn.className = 'remove-btn';
                removeBtn.innerHTML = '×';
                removeBtn.title = 'ลบรูปนี้';
                removeBtn.onclick = function() {
                    
                    const urlParams = new URLSearchParams(window.location.search);
                    // console.log(urlParams.get("pid"));
                    const pid = urlParams.get("pid");
                    div.remove();
                    DeleteImage(pid,image);
                    return false;
                };

                div.appendChild(img);
                div.appendChild(removeBtn);
                preview.appendChild(div);
            }
            async function DeleteImage(pid, image) {
                const myHeaders = new Headers();
                myHeaders.append("Cookie", "PHPSESSID=db9575d5f43d4160441b3bed57e062fe");
                const formdata = new FormData();
                formdata.append("pid", pid);
                formdata.append("image", image);
                const requestOptions = {
                    method: "POST",
                    headers: myHeaders,
                    body: formdata,
                    redirect: "follow"
                };
                let res = await fetch("/api/delete/image", requestOptions);
                res = await res.json();
                console.log(res);
            }
            // document.getElementById("image-upload").addEventListener("change", function(event) {
            //     const files = event.target.files;
            //     for (let i = 0; i < files.length; i++) {
            //         const file = files[i];
            //         if (!file.type.match("image.*")) continue;
            //         const reader = new FileReader();
            //         reader.onload = function(e) {
            //             addImageToPreview(e.target.result);
            //         };
            //         reader.readAsDataURL(file);
            //     }
            // });
        });
    </script>
</body>

</html>