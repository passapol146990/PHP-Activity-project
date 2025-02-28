<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ฟอร์มอัพโหลดรูปภาพ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
        .image-preview-item {
            position: relative;
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
        #image-preview {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">ฟอร์มกิจกรรม</h3>
                    </div>
                    <div class="card-body">
                        <form action="/activity/create" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                    <label for="image-upload" class="form-label">รูปภาพกิจกรรม</label>
                                    <input type="file" class="form-control" id="image-upload" name="images[]" accept="image/*" multiple>
                                    <div class="form-text">อัพโหลดได้หลายรูป (สูงสุด 5MB ต่อรูป, รองรับไฟล์ JPEG, PNG, GIF)</div>
                                </div>
                                <!-- แสดงตัวอย่างรูปภาพที่เลือก (ก่อนอัพโหลด) -->
                                <div id="image-preview" class="image-preview-container"></div>
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">ชื่อกิจกรรม</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="description" class="form-label">รายละเอียดกิจกรรม</label>
                                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
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
                                <input type="text" class="form-control" id="location" name="location" required>
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">สิ่งที่ผู้เข้าร่วมจะได้รับ</label>
                                <input type="text" class="form-control" id="p_give" name="p_give" required>
                            </div>
                            
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">บันทึกกิจกรรม</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS และ JavaScript สำหรับแสดงตัวอย่างรูปภาพ -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('image-upload').addEventListener('change', function(event) {
            const preview = document.getElementById('image-preview');
            preview.innerHTML = ''; // ล้างตัวอย่างเดิม
            
            const files = event.target.files;
            
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                
                // ตรวจสอบว่าเป็นไฟล์รูปภาพหรือไม่
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