<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <title>สร้างกิจกรรม</title>
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

        .preview-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin: 5px;
        }
        .image-preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px;
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
        
    </style>
</head>
<body>
    <div class="p-2 ms-2">
        <button class="btn btn-primary">&larr; กลับ</button>
    </div>

    <div class="d-flex justify-content-center">
        <form class="form-content">

            <h2 class="mb-3 ms-3">สร้างกิจกรรม</h2>

            <div class="mb-3">
                <label for="image-upload" class="form-label">รูปภาพกิจกรรม</label>
                 <input type="file" class="form-control" id="image-upload" name="images[]" accept="image/*" multiple>
                <div class="form-text">อัพโหลดได้หลายรูป (สูงสุด 5MB ต่อรูป, รองรับไฟล์ JPEG, PNG)</div>
                <div id="image-preview" class="image-preview-container"></div>
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
                <button type="submit" class="btn btn-success">สร้างกิจกรรม</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('image-upload').addEventListener('change', function(event) {
            const preview = document.getElementById('image-preview');
            preview.innerHTML = '';
            const files = event.target.files;
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                if (!file.type.match('image.*')) {
                    continue;
                }
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'image-preview-item';
                    
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'preview-image';
                    img.title = file.name;
                    
                    const removeBtn = document.createElement('button');
                    removeBtn.className = 'remove-btn';
                    removeBtn.innerHTML = '×';
                    removeBtn.title = 'ลบรูปนี้';
                    removeBtn.onclick = function() {
                        div.remove();
                        return false;
                    };
                    
                    div.appendChild(img);
                    div.appendChild(removeBtn);
                    preview.appendChild(div);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
