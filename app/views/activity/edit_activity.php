<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Form Example</title>
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
            height: 310px;
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

        
    </style>
</head>
<body>
    <div class="p-2 ms-2">
        <button class="btn btn-primary">&larr; กลับ</button>
    </div>

    <div class="d-flex justify-content-center">
        <form class="form-content">
            <h2 class="mb-3 ms-3">แก้ไขกิจกรรม : c4c กิจกรรมค่ายเพื่อชุมชน</h2>
            <div class="image-upload-container">
                <!-- รูปแสดงผล -->
                <img id="preview-img" 
                    src="https://c4.wallpaperflare.com/wallpaper/613/501/200/steven-universe-cartoon-pink-lighthouse-wallpaper-preview.jpg" 
                    alt="Image Preview" 
                    class="image-preview"
                    onclick="document.getElementById('file-upload').click()">  <!-- คลิกที่รูปเพื่อเปลี่ยน -->

                <!-- ปุ่มอัพโหลด -->
                <button type="button" class="btn btn-outline-secondary upload-btn" 
                    onclick="document.getElementById('file-upload').click()">อัพโหลดรูปภาพ</button>

                <!-- Input file -->
                <input id="file-upload" type="file" accept="image/*" 
                    onchange="previewImage(event)" style="display: none;">

                <!-- ปุ่มเปลี่ยนรูป -->
                <button type="button" class="btn btn-outline-danger change-btn" 
                    onclick="document.getElementById('file-upload').click()">เปลี่ยนรูป</button>
            </div>

            <div class="p-2">
                <label class="form-label ms-1"> ชื่อกิจกรรม :</label>
                <input type="text" class="form-control mb-1" placeholder="ชื่อกิจกรรมของคุณ...">
            </div>

            <div class="p-2">
                <label class="form-label ms-1"> รายละเอียดกิจกรรม :</label>
                <input type="text" class="form-control" placeholder="รายละเอียดกิจกรรมของคุณ...">
            </div>

            <div class="p-2">
                <label class="form-label ms-1"> จำนวนที่รับสมัคร :</label>
                <input type="text" class="form-control" placeholder="จำนวนที่รับสมัครของคุณ...">
            </div>

            <div class="p-2">
                <label class="form-label ms-1"> สถานที่จัดกิจกรรม :</label>
                <input type="text" class="form-control" placeholder="สถานที่จัดกิจกรรมของคุณ...">
            </div>

            <div class="p-2">
                <label class="form-label ms-1"> วันที่จัดกิจกรรม :</label>
                <input type="date" class="form-control">
            </div>

            <div class="p-2 d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-warning">แก้ไขกิจกรรม</button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            var file = event.target.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var output = document.getElementById('preview-img');
                    var uploadBtn = document.querySelector('.upload-btn');
                    var changeBtn = document.querySelector('.change-btn');

                    output.src = e.target.result; // อัพเดตรูป
                    uploadBtn.style.display = 'none'; // ซ่อนปุ่มอัพโหลด
                    changeBtn.style.display = 'block'; // แสดงปุ่มเปลี่ยนรูป
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>
