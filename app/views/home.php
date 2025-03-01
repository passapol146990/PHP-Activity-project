<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="theam/home.css"> -->
    <link rel="stylesheet" type="text/css" href="theam/home.css">
    <title>ระบบกิจกรรม</title>
</head>

<body>
    <?php require_once '../app/component/navbar.php'; ?>
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
                                <img src="https://wallpapers.com/images/hd/1920-x-1080-hd-1qq8r4pnn8cmcew4.jpg" alt="กิจกรรม 1" class="event-image" data-bs-toggle="modal" data-bs-target="#eventModal1">
                            </div>
                        </div>

                        <!-- กิจกรรมที่ 2 -->
                        <div class="col-md-6">
                            <div class="event-card-slider row">
                                <p class="col-md-6 text-start">วันที่: 15-17 มี.ค. 2568</p>
                                <p class="col-md-6 text-end">18/20</p>
                                <img src="https://wallpapers.com/images/hd/3000x3000-4et4lyqb490tdtyh.jpg" alt="กิจกรรม 2" class="event-image" data-bs-toggle="modal" data-bs-target="#eventModal2">
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
    <!-- 🔹 กิจกรรมที่เปิดรับสมัคร -->
    <div class="event-section text-center">
        <h1 class="title">กิจกรรมที่เปิดรับสมัคร</h1>
        <div class="container">
            <div class="row">
                <!-- เริ่ม Loop การ์ด -->
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card p-2 d-flex flex-column flex-grow-1">
                        <div class="text-end quota">18/20</div>
                        <div class="event-image">
                            <img src="https://wallpapers.com/images/hd/1920-x-1080-hd-1qq8r4pnn8cmcew4.jpg" alt="Event Image">
                        </div>
                        <div class="text-start event-info p-2 d-flex flex-column flex-grow-1">
                            <label class="limited-text">Lorem ipsum dolor sit amet consectetur adipisicing elit...</label>
                            <p class="limited-text">15/2/68 - 22/2/68 Lorem ipsum dolor sit amet...</p>
                            <!-- <lable><?= $post["p_name"] ?></lable><br>
                        <lable><?= $post["p_date_start"] ?> - <?= $post["p_date_end"] ?></lable> -->
                            <div class="mt-auto d-flex justify-content-between">
                                <button class="btn join-btn col-6">เข้าร่วม</button>
                                <button class="btn btn-primary col-6" data-bs-toggle="modal" data-bs-target="#eventModal1">รายละเอียด</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card p-2 d-flex flex-column flex-grow-1">
                        <div class="text-end quota">18/20</div>
                        <div class="event-image">
                            <img src="https://wallpapers.com/images/hd/1920-x-1080-hd-1qq8r4pnn8cmcew4.jpg" alt="Event Image">
                        </div>
                        <div class="text-start event-info p-2 d-flex flex-column flex-grow-1">
                            <label class="limited-text">Lorem ipsum dolor sit amet consectetur adipisicing elit...</label>
                            <p class="limited-text">15/2/68 - 22/2/68 Lorem ipsum dolor sit amet...</p>
                            <!-- <lable><?= $post["p_name"] ?></lable><br>
                        <lable><?= $post["p_date_start"] ?> - <?= $post["p_date_end"] ?></lable> -->
                            <div class="mt-auto d-flex justify-content-between">
                                <button class="btn join-btn col-6">เข้าร่วม</button>
                                <button class="btn btn-primary col-6" data-bs-toggle="modal" data-bs-target="#eventModal1">รายละเอียด</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card p-2 d-flex flex-column flex-grow-1">
                        <div class="text-end quota">18/20</div>
                        <div class="event-image">
                            <img src="https://wallpapers.com/images/hd/1920-x-1080-hd-1qq8r4pnn8cmcew4.jpg" alt="Event Image">
                        </div>
                        <div class="text-start event-info p-2 d-flex flex-column flex-grow-1">
                            <label class="limited-text">Lorem ipsum dolor sit amet consectetur adipisicing elit...</label>
                            <p class="limited-text">15/2/68 - 22/2/68 Lorem ipsum dolor sit amet...</p>
                            <!-- <lable><?= $post["p_name"] ?></lable><br>
                        <lable><?= $post["p_date_start"] ?> - <?= $post["p_date_end"] ?></lable> -->
                            <div class="mt-auto d-flex justify-content-between">
                                <button class="btn join-btn col-6">เข้าร่วม</button>
                                <button class="btn btn-primary col-6" data-bs-toggle="modal" data-bs-target="#eventModal1">รายละเอียด</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card p-2 d-flex flex-column flex-grow-1">
                        <div class="text-end quota">18/20</div>
                        <div class="event-image">
                            <img src="https://wallpapers.com/images/hd/1920-x-1080-hd-1qq8r4pnn8cmcew4.jpg" alt="Event Image">
                        </div>
                        <div class="text-start event-info p-2 d-flex flex-column flex-grow-1">
                            <label class="limited-text">Lorem ipsum dolor sit amet consectetur adipisicing elit...</label>
                            <p class="limited-text">15/2/68 - 22/2/68 Lorem ipsum dolor sit amet...</p>
                            <!-- <lable><?= $post["p_name"] ?></lable><br>
                        <lable><?= $post["p_date_start"] ?> - <?= $post["p_date_end"] ?></lable> -->
                            <div class="mt-auto d-flex justify-content-between">
                                <button class="btn join-btn col-6">เข้าร่วม</button>
                                <button class="btn btn-primary col-6" data-bs-toggle="modal" data-bs-target="#eventModal1">รายละเอียด</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card p-2 d-flex flex-column flex-grow-1">
                        <div class="text-end quota">18/20</div>
                        <div class="event-image">
                            <img src="https://wallpapers.com/images/hd/1920-x-1080-hd-1qq8r4pnn8cmcew4.jpg" alt="Event Image">
                        </div>
                        <div class="text-start event-info p-2 d-flex flex-column flex-grow-1">
                            <label class="limited-text">Lorem ipsum dolor sit amet consectetur adipisicing elit...</label>
                            <p class="limited-text">15/2/68 - 22/2/68 Lorem ipsum dolor sit amet...</p>
                            <!-- <lable><?= $post["p_name"] ?></lable><br>
                        <lable><?= $post["p_date_start"] ?> - <?= $post["p_date_end"] ?></lable> -->
                            <div class="mt-auto d-flex justify-content-between">
                                <button class="btn join-btn col-6">เข้าร่วม</button>
                                <button class="btn btn-primary col-6" data-bs-toggle="modal" data-bs-target="#eventModal1">รายละเอียด</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                

                <!-- <div class="col-md-4 mb-4">
                <div class="event-card d-flex flex-column">
                    <div class="text-end">20/20</div>
                    <div class="event-image">
                        <img src="your-image.jpg" alt="Event Image">
                    </div>
        
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
            </div> -->

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
                        <img src="https://wallpapers.com/images/hd/3000x3000-4et4lyqb490tdtyh.jpg" alt="ผู้สร้าง" class="creator-img">
                        <p class="mb-0 ms-2"><strong>ผู้สร้าง:</strong> ฟัพพล สุทธาธรรม</p>
                    </div>

                    <!-- กล่องกิจกรรม -->
                    <div class="activity-box mb-3">
                        <img src="https://wallpapers.com/images/hd/3000x3000-4et4lyqb490tdtyh.jpg" alt="กิจกรรม" class="activity-img">
                    </div>

                    <!-- รายละเอียดกิจกรรม -->
                    <div class="text-start">
                        <p><strong>ชื่อกิจกรรม:</strong> กิจกรรม C4C เข้าค่ายเพื่อโรงเรียนทางบ้าน Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo quas laborum autem unde vel id quisquam dolor a, iusto architecto ex rem molestiae quasi, quod, cupiditate deleniti! Tempore, amet sed!</p>
                        <p><strong>ช่วงเวลา:</strong> 20/2/2568 - 22/2/2568 (3 วัน) Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore cupiditate exercitationem officiis perferendis debitis, inventore consectetur similique expedita rem necessitatibus vitae velit, id itaque voluptatem omnis excepturi, quia amet reprehenderit.</p>
                        <p><strong>รายละเอียด:</strong> มหาลัยมหาสารคามออกค่ายเพื่อช่วยเหลือโรงเรียนทางบ้าน ร่วมเป็นส่วนหนึ่งกับเรา ค่าเต๊นท์ 0 บาท</p>
                        <p><strong>จำนวนที่เปิดรับ:</strong> 20 Lorem ipsum dolor sit amet consectetur, adipisicing elit. Similique voluptatem a consectetur atque veritatis, provident excepturi suscipit ex iure doloribus odio, amet delectus inventore est neque exercitationem! Tempora, sunt quibusdam?</p>
                    </div>
                </div>

                <!-- ส่วนปุ่ม Modal -->
                <div class="modal-footer justify-content-center">
                    <button class="btn btn-success">เข้าร่วม</button>
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