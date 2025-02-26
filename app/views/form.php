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
<style>
    body {
    background: linear-gradient(to right, #f77062, #fe5196);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}

.login-box {
    position: absolute;
    top: -5%;
    left: 8%;
    width: 450px;
    height: 80vh;
    background: white;
    border-radius: 30px;
    box-shadow: 8px 8px 20px rgba(0, 0, 0, 0.2);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.login-box h1 {
    font-size: 6rem;
    font-weight: bold;
    color: #ff4500;
}

.login-box p {
    color: gray;
    font-weight: 600;
}

.login-form {
    position: absolute;
    top: 50%;
    left: 58%;
    transform: translate(-10%, -50%);
    width: 400px;
}

.btn-google {
    background: white;
    border-radius: 50px;
    padding: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
}

.btn-login {
    position: relative;
    overflow: hidden;
    background: linear-gradient(to right, #ff4500, black);
    color: white;
    border-radius: 50px;
    font-weight: bold;
    padding: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    border: none;
}

/* Slide effect */
.btn-login::before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(to right, #ff6347, black);
    transition: 0.4s ease-in-out;
}

.btn-login:hover::before {
    left: 0;
}

.btn-login span {
    position: relative;
    z-index: 1;
}
.profile-pic {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid #ddd;
}
</style>
<body class>
<a href="#" class="btn btn-light position-absolute top-0 start-0 m-3 shadow-sm">
    ← กลับ
</a>
    <div class="container text-center">
        <div class="card p-4 shadow-sm" style="max-width: 500px; margin: auto;">
            <h3 class="mb-3">กรอกข้อมูลผู้ใช้</h3>
            
            <!-- Profile Picture Upload -->
            <div class="mb-3">
                <img id="profileImage" src="https://via.placeholder.com/120" class="profile-pic mb-2" alt="Profile">
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
