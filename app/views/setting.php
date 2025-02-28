<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตั้งค่าโปรไฟล์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        .profile-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 400px;
        }
        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 15px;
        }
        .btn-save {
            margin-top: 15px;
        }
        .back-btn {
            position: absolute;
            top: 20px;
            left: 20px;
        }
    </style>
</head>

<body>
    <a href="index.html" class="btn btn-primary back-btn">กลับหน้าหลัก</a>
    <div class="profile-container">
        <img src="https://via.placeholder.com/120" alt="โปรไฟล์" class="profile-img">
        <h2>พัสพล สุทธาธรรม</h2>
        <p>เข้าร่วมเมื่อ 14/11/2567 11:32:08</p>
        
        <form>
            <div class="mb-3">
                <label class="form-label">ชื่อ</label>
                <input type="text" class="form-control" value="พัสพล สุทธาธรรม">
            </div>
            <div class="mb-3">
                <label class="form-label">เพศ</label>
                <select class="form-select">
                    <option selected>ชาย</option>
                    <option>หญิง</option>
                    <option>อื่น ๆ</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">วันเกิดของคุณ</label>
                <input type="date" class="form-control" value="2000-06-06">
            </div>
            <button type="submit" class="btn btn-success btn-save">บันทึก</button>
        </form>
    </div>
</body>

</html>