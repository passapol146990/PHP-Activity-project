<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/home.css">
    <title>หน้าแรก</title>
</head>

<body>
    <?php require_once '../app/component/navbar.php'; ?>
    <div class="event-section text-center">
        <h1 class="title">กิจกรรมที่เปิดรับสมัคร</h1>
        <div class="container">
            <div class="row">
                <? foreach($posts["data"] as $key => $post){ ?>
                    <div class="col-md-4 mb-4 d-flex">
                        <div class="card p-2 d-flex flex-column flex-grow-1">
                            <div class="text-end quota">18/20</div>
                            <div class="event-image">
                                <img src="/get/image?img=/post/<?= htmlspecialchars($post["image"]) ?>" alt="Event Image" width="100%">
                            </div>
                            <div class="text-start event-info p-2 d-flex flex-column flex-grow-1">
                                <label class="limited-text"><?= htmlspecialchars($post["p_name"]) ?></label>
                                <p class="limited-text"><?= $post["p_date_start"] ?> - <?= $post["p_date_end"] ?></p>
                                <div class="mt-auto d-flex justify-content-between gap-2">
                                    <button class="btn btn-success col-6">เข้าร่วม</button>
                                    <button class="btn btn-primary col-6" data-bs-toggle="modal" data-bs-target="#Modal_Activity_1">รายละเอียด</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <? } ?>
                <div class="modal fade text-font" id="Modal_Activity_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div>
                                    <h5 class="modal-title" id="exampleModalLabel">รายละเอียดกิจกรรม</h5>
                                    <p class="small-text">วันที่ 25/2/68 19:25:40 น.</p>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- 🔹 ผู้สร้างกิจกรรม -->
                                <div class="row d-flex align-items-center mb-3">
                                    <div class="col-2 text-start"><strong>ผู้สร้าง:</strong></div>
                                    <div class="col-10 d-flex align-items-center">
                                        <img src="https://htmlcolorcodes.com/assets/images/colors/cream-color-solid-background-1920x1080.png" 
                                            style="width: 75px; height: 75px; border-radius: 50%;" alt="รูปโปรไฟล์">
                                        <p class="d-inline-block ms-3 mb-0">พัสพล สุธาธรรม</p>
                                    </div>
                                </div>

                                <!-- 🔹 รูปกิจกรรม -->
                                <div class="row d-flex align-items-center mb-3">
                                    <div class="col-12">
                                        <img src="https://htmlcolorcodes.com/assets/images/colors/cream-color-solid-background-1920x1080.png" 
                                            alt="กิจกรรม">
                                    </div>
                                </div>

                                <!-- 🔹 รายละเอียดกิจกรรม -->
                                <div class="text-start">
                                    <p><strong>ชื่อกิจกรรม:</strong> กิจกรรม C4C เข้าค่ายเพื่อโรงเรียนทางบ้าน</p>
                                    <p><strong>ช่วงเวลา:</strong> 20/2/2568 - 22/2/2568 (3 วัน)</p>
                                    <p><strong>รายละเอียด:</strong> มหาลัยมหาสารคามออกค่ายเพื่อช่วยเหลือโรงเรียนทางบ้าน
                                        ร่วมเป็นส่วนหนึ่งกับเรา ค่าเดินทาง 0 บาท</p>
                                    <p><strong>จำนวนที่เปิดรับ:</strong> 20 คน</p>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button class="btn btn-success">เข้าร่วม</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>