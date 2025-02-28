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
            justify-content: center;
            /* จัดให้อยู่กลาง */
            flex-wrap: wrap;
            /* ทำให้รองรับหลายขนาดหน้าจอ */
            gap: 20px;
            /* เพิ่มช่องว่างระหว่างการ์ด */
        }

        .event-card {
            background: pink;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .event-card-slider {
            background: pink;
            width: 650px;
            /* ขยายให้ดูสมส่วน */
            height: 200px;
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

        .dropdown-menu {
            min-width: 150px;
        }

        .filter-btn {
            background-color: red;
            color: white;
            border-radius: 50px;
            padding: 5px 15px;
            border: none;
            cursor: pointer;
        }

        .profile-dropdown {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .profile-dropdown img {
            cursor: pointer;
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .profile-name {
            margin-top: 5px;
            font-size: 14px;
            font-weight: bold;
        }

        .event-card .quota {
            position: absolute;
            top: 10px;
            right: 10px;
            font-weight: bold;
            background: white;
            padding: 5px 10px;
            border-radius: 5px;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
        }
        .text-head{
            font-size: 28px;
    font-weight: bold;
    color: #333;
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3); /* เงา */
    padding: 15px 0;
    border-bottom: 3px solid #ff4d4d; /* เส้นขีดใต้ */
    display: inline-block;
        }

        .search-container {
            display: flex;
            align-items: center;
            background: white;
            border: 1px solid #ccc;
            border-radius: 50px;
            padding: 5px 10px;
        }

        .search-container input {
            border: none;
            outline: none;
            padding: 5px;
            width: 200px;
            border-radius: 20px;
        }

        .search-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: #28a745;
        }
    </style>
</head>

<body>

    <!-- Navbar เมนูหลัก -->
    <div class="navbar">
        <div class="navbar-left">
            <div class="dropdown profile-dropdown">
                <img src="data:image/jpeg;base64,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" alt="โปรไฟล์" class="dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="profile-name">นายสมพงค์</span>
                <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                    <li><a class="dropdown-item" href="#">ตั้งค่า</a></li>
                    <li><a class="dropdown-item" href="#">ออกจากระบบ</a></li>
                </ul>
            </div>
            <a href="#">สร้างกิจกรรม</a>
            <a href="#">กิจกรรมที่สร้าง <span class=" top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    5<span class="visually-hidden">unread messages</span>
                </span></a>
            <a href="#">กิจกรรมที่เข้าร่วม <span class=" top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    5<span class="visually-hidden">unread messages</span>
                </span></a>
        </div>
        <div class="navbar-right">
            <div class="container-fluid">
                <form class="d-flex" role="search">
                    <div class="search-container">
                        <input class="form-control" style="width: 80vh;" type="search" placeholder="ค้นหากิจกรรม..." aria-label="Search">
                        <button class="search-btn" type="submit">
                            <img src="https://cdn-icons-png.flaticon.com/512/622/622669.png" alt="ค้นหา" width="20">
                        </button>

                    </div>
                </form>
            </div>
            <div class="dropdown">
                <button class="filter-btn dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter
                </button>
                <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                    <li><a class="dropdown-item" href="#">One</a></li>
                    <li><a class="dropdown-item" href="#">Two</a></li>
                    <li><a class="dropdown-item" href="#">Three</a></li>
                </ul>
            </div>
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
                            <div class="event-card-slider text-center">
                                <p>วันที่: 10-12 มี.ค. 2568</p>
                               
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="event-card-slider text-center">

                                <p>วันที่: 15-17 มี.ค. 2568</p>
                               
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
                            <div class="event-card-slider text-center">
                                <p>วันที่: 20-22 มี.ค. 2568</p>
                                

                            </div>
                        </div>
                        <div class="col-md-6" >
                            <div class="event-card-slider text-center" >
                                <p>วันที่: 25-27 มี.ค. 2568</p>
                                

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
        <h1 class="text-head">กิจกรรมที่เปิดรับสมัคร</h1>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="event-card">
                        <div class="text-end">10/20</div>
                        <div class="event-info">
                            <div class="text-start">
                                <p>C4C วิทย์คอม รอบที่ 1 <br> 15/2/68-22/2/68</p>
                            </div>
                            <div>
                                <button class="btn join-btn">เข้าร่วม</button>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal1">
                                    รายละเอียด
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="event-card">
                        <div class="text-end">20/20</div>
                        <div class="event-info">
                            <div class="text-start">
                                <p>C4C วิทย์คอม รอบที่ 2 <br> 20/2/68-22/2/68</p>
                            </div>
                            <div>
                                <span style="color: red;">ถูกปฏิเสธ</span>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal2">
                                    รายละเอียด
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="event-card">
                        <div class="text-end">20/20</div>
                        <div class="event-info">
                            <div class="text-start">
                                <p>C4C วิทย์คอม รอบที่ 3 <br> 20/2/68-22/2/68</p>
                            </div>
                            <div>
                                <span style="color: red;">ถูกปฏิเสธ</span>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal3">
                                    รายละเอียด
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="event-card">
                        <div class="text-end">20/20</div>
                        <div class="event-info">
                            <div class="text-start">
                                <p>C4C วิทย์คอม รอบที่ 3 <br> 20/2/68-22/2/68</p>
                            </div>
                            <div>
                                <span style="color: red;">ถูกปฏิเสธ</span>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal3">
                                    รายละเอียด
                                </button>
                            </div>
                        </div>
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
                    <p><strong>ชื่อกิจกรรม:</strong> C4C วิทย์คอม รอบที่ 1</p>
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
                    <p><strong>ชื่อกิจกรรม:</strong> C4C วิทย์คอม รอบที่ 2</p>
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
    <div class="modal fade" id="eventModal3" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">รายละเอียดกิจกรรม</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><strong>ชื่อกิจกรรม:</strong> C4C วิทย์คอม รอบที่ 3</p>
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