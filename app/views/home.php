<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>ระบบกิจกรรม</title>
    <link rel="stylesheet" href="../style/home.css">
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

        .text-head {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
            /* เงา */
            padding: 15px 0;
            border-bottom: 3px solid #ff4d4d;
            /* เส้นขีดใต้ */
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
    <div class="navbar">
        <div class="navbar-left">
            <div class="dropdown profile-dropdown">
                <img src="<?= $_SESSION['login_image'] ?>" alt="โปรไฟล์" class="dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="profile-name"><?= $_SESSION['login_name'] ?></span>
                <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                    <li><a class="dropdown-item" href="/seting">ตั้งค่า</a></li>
                    <li><a class="dropdown-item" href="/logout">ออกจากระบบ</a></li>
                </ul>
            </div>
            <a href="/activity/create">สร้างกิจกรรม</a>
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
        <?php if (isset($postsTop['data']) && is_array($postsTop['data'])) { ?>
            <?php foreach ($postsTop['data'] as $row) { ?>
                <div class="carousel-item active">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="event-card text-center">
                                    <p>วันที่: <?= htmlspecialchars($row['p_date_start']) ?> - <?= htmlspecialchars($row['p_date_end']) ?></p>
                                    <?php if (!empty($row['image'])) { ?>
                                        <img src="/get/image?img=/post/<?= htmlspecialchars($row['image']) ?>" 
                                            alt="<?= htmlspecialchars($row['p_name']) ?>" 
                                            width="300" height="150">
                                    <?php } else { ?>
                                        <p>ไม่มีรูปภาพ</p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <p>ไม่มีข้อมูลโพสต์</p>
        <?php } ?>

            <!-- Slide 1 -->
            <!-- <div class="carousel-item active ">
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
            </div> -->

            <!-- Slide 2 -->
            <!-- <div class="carousel-item">
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
            </div> -->
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
            <? foreach ($posts as $row) { ?>
                <div class="col-md-4 mb-4">
                    <div class="event-card">
                        <div class="text-end">10/20</div>
                        <div class="event-info">
                            <div class="text-start">
                                <img src="/get/image?img=/post/<?= $row['image'] ?>" alt="<?= $row['p_name'] ?>" width="300" height="150">
                                <p><?= $row['p_name'] ?> <br> <?= $row['p_date_start'] ?>-<?= $row['p_date_end'] ?></p>
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
            <? } ?>
                <!-- <div class="col-md-4 mb-4">
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
                </div> -->
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