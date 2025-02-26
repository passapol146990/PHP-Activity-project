<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบกิจกรรม</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>ระบบกิจกรรม</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f8f8f8;
        }

        /* --- Header เมนู --- */
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: white;
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .navbar-left img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .navbar a {
            text-decoration: none;
            color: black;
            font-weight: bold;
            padding: 5px 10px;
        }

        .navbar a.active {
            color: red;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .search-box {
            padding: 5px 10px;
            border-radius: 20px;
            border: 1px solid gray;
            outline: none;
        }

        .filter-btn {
            background: red;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        /* --- Slider --- */
        .carousel-container {
            width: 100%;
            overflow: hidden;
            position: relative;
        }

        .carousel {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .carousel-item {
            min-width: 100%;
            background: pink;
            padding: 20px;
            text-align: center;
            font-size: 18px;
        }

        .carousel-controls {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }

        .carousel-controls button {
            padding: 5px 10px;
            border: none;
            background: red;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        /* --- กิจกรรมที่เปิดรับสมัคร --- */
        .event-section {
    padding: 40px 15px;
    text-align: center;
}
        .event-container {
    display: flex;
    justify-content: center; /* จัดให้อยู่กลาง */
    flex-wrap: wrap; /* ทำให้รองรับหลายขนาดหน้าจอ */
    gap: 20px; /* เพิ่มช่องว่างระหว่างการ์ด */
}

        .event-card {
    background: pink;
    width: 280px; /* ขยายให้ดูสมส่วน */
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
}


        .event-info {
            background: #e0e0e0;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
        }

        .btn {
            padding: 5px 10px;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 5px;
        }

        .join-btn {
            background: green;
        }

        .cancel-btn {
            background: red;
        }

        .detail-btn {
            background: blue;
        }
    </style>
</head>

<body>

    <!-- Navbar เมนูหลัก -->
    <div class="navbar">
        <div class="navbar-left">
            <img src="https://via.placeholder.com/40" alt="โปรไฟล์">
            <a href="#" class="active">สร้างกิจกรรม</a>
            <a href="#">กิจกรรมที่สร้าง  <span class=" top-0 start-100 translate-middle badge rounded-pill bg-danger">
                5<span class="visually-hidden">unread messages</span>
              </span></a>
            <a href="#">กิจกรรมที่เข้าร่วม <span class=" top-0 start-100 translate-middle badge rounded-pill bg-danger">
                5<span class="visually-hidden">unread messages</span>
              </span></a>
        </div>
        <div class="navbar-right">
            <input type="text" class="search-box" placeholder="ค้นหากิจกรรม...">
            <select class="form-select" aria-label="Default select example">
                <option selected>Open this Filter</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
    </div>

    <!-- Slider -->
    <div id="eventCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <!-- Indicators -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#eventCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#eventCarousel" data-bs-slide-to="1"></button>
        </div>
    
        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active ">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="event-card text-center">
                                <h4>กิจกรรมที่ 1</h4>
                                <p>วันที่: 10-12 มี.ค. 2568</p>
                                <p>สถานที่: ห้องประชุม A</p>
                                <button class="btn btn-primary">รายละเอียด</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="event-card text-center">
                                <h4>กิจกรรมที่ 2</h4>
                                <p>วันที่: 15-17 มี.ค. 2568</p>
                                <p>สถานที่: ห้องประชุม B</p>
                                <button class="btn btn-primary">รายละเอียด</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Slide 2 -->
            <div class="carousel-item">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="event-card text-center">
                                <h4>กิจกรรมที่ 3</h4>
                                <p>วันที่: 20-22 มี.ค. 2568</p>
                                <p>สถานที่: ห้องประชุม C</p>
                                <button class="btn btn-primary">รายละเอียด</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="event-card text-center">
                                <h4>กิจกรรมที่ 4</h4>
                                <p>วันที่: 25-27 มี.ค. 2568</p>
                                <p>สถานที่: ห้องประชุม D</p>
                                <button class="btn btn-primary">รายละเอียด</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- ปุ่มเลื่อนซ้ายขวา -->
        <button class="carousel-control-prev" type="button" data-bs-target="#eventCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#eventCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
    

    <!-- กิจกรรมที่เปิดรับสมัคร -->
    <div class="event-section">
        <h2>กิจกรรมที่เปิดรับสมัคร</h2>
        <div class="event-container">
            <!-- ✅ กิจกรรมที่ 1 -->
            <div class="event-card ">
                <div>10/20</div>
                <div class="event-info">
                    C4C วิทย์คอม รอบที่ 2 <br> 20/2/68-22/2/68
                </div>
                <button class="btn join-btn">เข้าร่วม</button>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal1">
                    รายละเอียด
                </button>
            </div>

            <!-- ✅ กิจกรรมที่ 2 -->
            <div class="event-card">
                <div>20/20</div>
                <div class="event-info">
                    C4C วิทย์คอม รอบที่ 1 <br> 20/2/68-22/2/68
                </div>
                <span style="color: red;">ถูกปฏิเสธ</span>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal2">
                    รายละเอียด
                </button>
            </div>
            <!-- ✅ กิจกรรมที่ 3 -->
            <div class="event-card">
                <div>20/20</div>
                <div class="event-info">
                    C4C วิทย์คอม รอบที่ 3 <br> 20/2/68-22/2/68
                </div>
                <span style="color: red;">ถูกปฏิเสธ</span>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal2">
                    รายละเอียด
                </button>
            </div>

        </div>
    </div>


    </div>
    </div>

    <!-- 🔹 Modal รายละเอียดกิจกรรม (กิจกรรมที่ 1) -->
    <div class="modal fade" id="eventModal1" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">รายละเอียดกิจกรรม</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><strong>ชื่อกิจกรรม:</strong> C4C วิทย์คอม รอบที่ 2</p>
                    <p><strong>วันที่:</strong> 20/2/68 - 22/2/68</p>
                    <p><strong>สถานะ:</strong> เปิดรับสมัคร</p>
                    <p>
                        รายละเอียดกิจกรรม...<br>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn join-btn">เข้าร่วม</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 🔹 Modal รายละเอียดกิจกรรม (กิจกรรมที่ 2) -->
    <div class="modal fade" id="eventModal2" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">รายละเอียดกิจกรรม</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><strong>ชื่อกิจกรรม:</strong> C4C วิทย์คอม รอบที่ 1</p>
                    <p><strong>วันที่:</strong> 20/2/68 - 22/2/68</p>
                    <p><strong>สถานะ:</strong> ถูกปฏิเสธ</p>
                    <p>
                        รายละเอียดกิจกรรม...<br>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 🔹 Modal รายละเอียดกิจกรรม (กิจกรรมที่ 3) -->
    <div class="modal fade" id="eventModal2" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">รายละเอียดกิจกรรม</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><strong>ชื่อกิจกรรม:</strong> C4C วิทย์คอม รอบที่ 1</p>
                    <p><strong>วันที่:</strong> 20/2/68 - 22/2/68</p>
                    <p><strong>สถานะ:</strong> ถูกปฏิเสธ</p>
                    <p>
                        รายละเอียดกิจกรรม...<br>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentIndex = 0;

        function nextSlide() {
            showSlide(currentIndex + 1);
        }

        function prevSlide() {
            showSlide(currentIndex - 1);
        }
    </script>

</body>

</html>