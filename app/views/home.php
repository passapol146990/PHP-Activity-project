<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="theam/home.css">
    <title>ระบบกิจกรรม</title>

</head>

<body>
    <div class="navbar">
        <div class="navbar-left">
            <div class="dropdown profile-dropdown">
                <img src="www" alt="โปรไฟล์" class="dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="profile-name">นายสมพงค์</span>
                <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                    <li><a class="dropdown-item" href="/seting">ตั้งค่า</a></li>
                    <li><a class="dropdown-item" href="/logout">ออกจากระบบ</a></li>
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
                        <input class="form-control" style="width: 80vh;  background:pink" type="search" placeholder="ค้นหากิจกรรม..." aria-label="Search">
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
            <div class="carousel-item active">
                <div class="container">
                    <div class="row">
                        <!-- กิจกรรมที่ 1 -->
                        <div class="col-md-6">
                            <div class="event-card-slider row">
                                <!-- รูปที่กดแล้วเปิด Modal -->
                                <p class="col-md-6 text-start">วันที่: 10-12 มี.ค. 2568</p>
                                <p class="col-md-6 text-end">15/20</p>
                                <img src="data:image/jpeg;base64,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" alt="กิจกรรม 1" class="event-image" data-bs-toggle="modal" data-bs-target="#eventModal1">
                            </div>
                        </div>

                        <!-- กิจกรรมที่ 2 -->
                        <div class="col-md-6">
                            <div class="event-card-slider row">
                                <p class="col-md-6 text-start">วันที่: 15-17 มี.ค. 2568</p>
                                <p class="col-md-6 text-end">18/20</p>
                                <img src="your-image2.jpg" alt="กิจกรรม 2" class="event-image" data-bs-toggle="modal" data-bs-target="#eventModal2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item active">
                <div class="container">
                    <div class="row">
                        <!-- กิจกรรมที่ 1 -->
                        <div class="col-md-6">
                            <div class="event-card-slider row">
                                <!-- รูปที่กดแล้วเปิด Modal -->
                                <p class="col-md-6 text-start">วันที่: 11-12 มี.ค. 2568</p>
                                <p class="col-md-6 text-end">15/20</p>
                                <img src="your-image2.jpg" alt="กิจกรรม 3" class="event-image" data-bs-toggle="modal" data-bs-target="#eventModal2">
                            </div>
                        </div>

                        <!-- กิจกรรมที่ 2 -->
                        <div class="col-md-6">
                            <div class="event-card-slider row">
                                <p class="col-md-6 text-start">วันที่: 15-17 มี.ค. 2568</p>
                                <p class="col-md-6 text-end">18/20</p>
                                <img src="your-image2.jpg" alt="กิจกรรม 4" class="event-image" data-bs-toggle="modal" data-bs-target="#eventModal2">
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
        <h1 class="text-start">กิจกรรมที่เปิดรับสมัคร</h1>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="event-card d-flex flex-column">
                        <div class="text-end">18/20</div>
                        <!-- ครึ่งบน: รูปภาพ -->
                        <div class="event-image">
                            <img src="data:image/jpeg;base64,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" alt="Event Image">
                        </div>

                        <!-- ครึ่งล่าง: ข้อความและปุ่ม -->
                        <div class="event-info">
                            <div class="text-start">
                                <p>C4C วิทย์คอม รอบที่ 1 <br> 15/2/68-22/2/68</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button class="btn join-btn col-md-6">เข้าร่วม</button>
                                <button class="btn btn-primary col-md-6" data-bs-toggle="modal" data-bs-target="#eventModal1">
                                    รายละเอียด
                                </button>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-md-4 mb-4">
                    <div class="event-card d-flex flex-column">
                        <div class="text-end">20/20</div>
                        <!-- ครึ่งบน: รูปภาพ -->
                        <div class="event-image">
                            <img src="your-image.jpg" alt="Event Image">
                        </div>

                        <!-- ครึ่งล่าง: ข้อความและปุ่ม -->
                        <div class="event-info">
                            <div class="text-start">
                                <p>C4C วิทย์คอม รอบที่ 2 <br> 15/2/68-22/2/68</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-danger col-md-6">ยกเลิก</button>
                                <button class="btn btn-primary col-md-6" data-bs-toggle="modal" data-bs-target="#eventModal2">
                                    รายละเอียด
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="event-card d-flex flex-column">
                        <div class="text-end">20/20</div>
                        <!-- ครึ่งบน: รูปภาพ -->
                        <div class="event-image">
                            <img src="your-image.jpg" alt="Event Image">
                        </div>

                        <!-- ครึ่งล่าง: ข้อความและปุ่ม -->
                        <div class="event-info">
                            <div class="text-start">
                                <p>C4C วิทย์คอม รอบที่ 3 <br> 15/2/68-22/2/68</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-danger col-md-6" disabled>ถูกปฏิเสธ</button>
                                <button class="btn btn-primary col-md-6" data-bs-toggle="modal" data-bs-target="#eventModal3">
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
                        <!-- ส่วนหัว Modal -->
                        <div class="modal-header">
                            <div>
                                <h5 class="modal-title"><strong>รายละเอียดกิจกรรม</strong></h5>
                                <p class="text-muted small">20/2/2568 06:20:52</p>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- ส่วนเนื้อหา Modal -->
                        <div class="modal-body">
                            <!-- ผู้สร้างกิจกรรม -->
                            <div class="d-flex align-items-center mb-3">
                                <img src="profile-placeholder.png" alt="ผู้สร้าง" class="creator-img">
                                <p class="mb-0 ms-2"><strong>ผู้สร้าง:</strong> ฟัพพล สุทธาธรรม</p>
                            </div>

                            <!-- กล่องกิจกรรม -->
                            <div class="activity-box mb-3">
                                <img src="data:image/jpeg;base64,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" alt="">
                            </div>

                            <!-- รายละเอียดกิจกรรม -->
                            <div class="text-start">
                                <p><strong>ชื่อกิจกรรม:</strong> กิจกรรม C4C เข้าค่ายเพื่อโรงเรียนทางบ้าน</p>
                                <p><strong>ช่วงเวลา:</strong> 20/2/2568 - 22/2/2568 (3 วัน)</p>
                                <p><strong>รายละเอียด:</strong> มหาลัยมหาสารคามออกค่ายเพื่อช่วยเหลือโรงเรียนทางบ้าน
                                    ร่วมเป็นส่วนหนึ่งกับเรา ค่าเต๊นท์ 0 บาท</p>
                                <p><strong>จำนวนที่เปิดรับ:</strong> 20</p>
                            </div>
                        </div>
                        <!-- ส่วนปุ่ม Modal -->
                        <div class="modal-footer justify-content-center">
                            <button class="btn btn-success">เข้าร่วม</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- 🔹 Modal รายละเอียดกิจกรรม (กิจกรรมที่ 2) -->
            <div class="modal fade" id="eventModal2" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <!-- ส่วนหัว Modal -->
                        <div class="modal-header">
                            <div>
                                <h5 class="modal-title"><strong>รายละเอียดกิจกรรม</strong></h5>
                                <p class="text-muted small">20/2/2568 06:20:52</p>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- ส่วนเนื้อหา Modal -->
                        <div class="modal-body">
                            <!-- ผู้สร้างกิจกรรม -->
                            <div class="d-flex align-items-center mb-3">
                                <img src="profile-placeholder.png" alt="ผู้สร้าง" class="creator-img">
                                <p class="mb-0 ms-2"><strong>ผู้สร้าง:</strong> ฟัพพล สุทธาธรรม</p>
                            </div>

                            <!-- กล่องกิจกรรม -->
                            <div class="activity-box mb-3">
                                <img src="data:image/jpeg;base64,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" alt="">
                            </div>

                            <!-- รายละเอียดกิจกรรม -->
                            <div class="text-start">
                                <p><strong>ชื่อกิจกรรม:</strong> กิจกรรม C4C เข้าค่ายเพื่อโรงเรียนทางบ้าน</p>
                                <p><strong>ช่วงเวลา:</strong> 20/2/2568 - 22/2/2568 (3 วัน)</p>
                                <p><strong>รายละเอียด:</strong> มหาลัยมหาสารคามออกค่ายเพื่อช่วยเหลือโรงเรียนทางบ้าน
                                    ร่วมเป็นส่วนหนึ่งกับเรา ค่าเต๊นท์ 0 บาท</p>
                                <p><strong>จำนวนที่เปิดรับ:</strong> 20</p>
                            </div>
                        </div>
                        <!-- ส่วนปุ่ม Modal -->
                        <div class="modal-footer justify-content-center">
                            <button class="btn btn-danger ">ยกเลิก</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 🔹 Modal รายละเอียดกิจกรรม (กิจกรรมที่ 3) -->
            <div class="modal fade" id="eventModal3" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <!-- ส่วนหัว Modal -->
                        <div class="modal-header">
                            <div>
                                <h5 class="modal-title"><strong>รายละเอียดกิจกรรม</strong></h5>
                                <p class="text-muted small">20/2/2568 06:20:52</p>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- ส่วนเนื้อหา Modal -->
                        <div class="modal-body">
                            <!-- ผู้สร้างกิจกรรม -->
                            <div class="d-flex align-items-center mb-3">
                                <img src="profile-placeholder.png" alt="ผู้สร้าง" class="creator-img">
                                <p class="mb-0 ms-2"><strong>ผู้สร้าง:</strong> ฟัพพล สุทธาธรรม</p>
                            </div>

                            <!-- กล่องกิจกรรม -->
                            <div class="activity-box mb-3">
                                <img src="data:image/jpeg;base64,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" alt="">
                            </div>

                            <!-- รายละเอียดกิจกรรม -->
                            <div class="text-start">
                                <p><strong>ชื่อกิจกรรม:</strong> กิจกรรม C4C เข้าค่ายเพื่อโรงเรียนทางบ้าน</p>
                                <p><strong>ช่วงเวลา:</strong> 20/2/2568 - 22/2/2568 (3 วัน)</p>
                                <p><strong>รายละเอียด:</strong> มหาลัยมหาสารคามออกค่ายเพื่อช่วยเหลือโรงเรียนทางบ้าน
                                    ร่วมเป็นส่วนหนึ่งกับเรา ค่าเต๊นท์ 0 บาท</p>
                                <p><strong>จำนวนที่เปิดรับ:</strong> 20</p>
                            </div>
                        </div>
                        <!-- ส่วนปุ่ม Modal -->
                        <div class="modal-footer justify-content-center">
                            <button class="btn btn-danger" disabled>ถูกปฏิเสธ</button>
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