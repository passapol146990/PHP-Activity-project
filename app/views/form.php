<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="theam.css">
</head>
<body class>
    <div class="container text-center">
        <div class="card p-4 shadow-sm" style="max-width: 500px; margin: auto;">
            <h3 class="mb-3">กรอกข้อมูลผู้ใช้</h3>
            
            <!-- Profile Picture Upload -->
            <div class="mb-3">
                <img id="profileImage" src="http://localhost/get/image?img=passapol.jpg" width="150px" class="profile-pic mb-2" alt="Profile">
                <input type="file" id="imageUpload" class="form-control" accept="image/*">
            </div>
            
            <div class="mb-3 text-start">
                <label class="form-label">ชื่อ - นามสกุล</label>
                <input type="text" class="form-control" placeholder="กรอกชื่อ - นามสกุล">
            </div>
            
            <div class="mb-3 text-start">
                <label class="form-label">วันเกิด</label>
                <input type="date" class="form-control">
            </div>

            <div class="mb-3 text-start">
                <label class="form-label">เบอร์โทรศัพท์</label>
                <input type="tel" id="phone" class="form-control">
            </div>
            
            <div class="mb-3 text-start">
                <label class="form-label">เพศ</label>
                <select class="form-select">
                    <option>ชาย</option>
                    <option>หญิง</option>
                    <option>อื่น ๆ</option>
                </select>
            </div>
            
            <button class="btn w-100 mt-3 btn-login">
                <span>บันทึกข้อมูล</span>
            </button>
        </div>
    </div>

    <script>
        document.getElementById('imageUpload').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profileImage').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
