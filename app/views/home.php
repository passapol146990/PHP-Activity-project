<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/home.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="shortcut icon" type="image/x-icon" href="Logo_size32.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>หน้าแรก</title>
</head>

<body>
    <?php require_once '../app/component/navbar.php'; ?>
    <?php require_once '../app/component/slide.php'; ?>
    <div class="event-section text-center bg-white pt-5">
        <div class="container">
            <h1 class="title text-start">กิจกรรมที่เปิดรับสมัคร</h1>
            <div class="row">
                <? foreach ($posts["data"] as $key => $post) { ?>
                    <div class="col-md-4 mb-4 d-flex">
                        <div class="card p-2 d-flex flex-column flex-grow-1">
                            <div class="text-end quota"><?= htmlspecialchars($post["approved"] . "/" . $post["p_max"]) ?>
                            </div>
                            <div class="event-image">
                                <img src="/get/image?img=/post/<?= htmlspecialchars($post["image"]) ?>" alt="Event Image"
                                    width="100%" loading="lazy">
                            </div>
                            <div class="text-start event-info p-2 d-flex flex-column flex-grow-1">
                                <label class="limited-text"><?= htmlspecialchars($post["p_name"] ?? "") ?></label>
                                <p class="limited-text">
                                    <?= htmlspecialchars(formatThaiDate($post["p_date_start"])) ?> -
                                    <?= htmlspecialchars(formatThaiDate($post["p_date_end"])) ?>
                                </p>

                                <div class="mt-auto d-flex justify-content-between gap-2 ">
                                    <?php
                                    if (!isset($post["user_status"]) || empty($post["user_status"])) {
                                        ?>
                                        <button class="btn btn-success col-6"
                                            onClick="registerPost('<?= htmlspecialchars($post["p_id"]) ?>')">เข้าร่วม</button>
                                        <?php
                                    } elseif ($post["user_status"] === "อนุมัติ") {
                                        ?>
                                        <div
                                            class="text-success col-6 d-flex justify-content-center align-items-center fw-bold">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" class="me-2"
                                                style="stroke: green; fill: white;">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            เข้าร่วมกิจกรรมแล้ว
                                        </div>

                                        <?php
                                    } elseif ($post["user_status"] === "รอการตรวจสอบ") {
                                        ?>
                                        <button class="btn btn-warning col-6" disabled>รอการตรวจสอบ</button>
                                        <?php
                                    } elseif ($post["user_status"] === "ปฏิเสธ") {
                                        ?>
                                        <div class="text-danger col-6 d-flex justify-content-center align-items-center fw-bold">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" class="me-2"
                                                style="stroke: red; fill: white;">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 6l12 12M6 18L18 6" />
                                            </svg>
                                            ปฏิเสธ
                                        </div>

                                        <?php
                                    }
                                    ?>
                                    <button class="btn btn-primary col-6"
                                        onClick="getDetailPost('<?= htmlspecialchars($post["p_id"]) ?>')"
                                        data-bs-toggle="modal" data-bs-target="#Modal_Activity_1">รายละเอียด</button>
                                </div>

                            </div>
                        </div>
                    </div>
                <? } ?>
            </div>
        </div>
    </div>
    <div class="modal fade text-font" id="Modal_Activity_1" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title" id="exampleModalLabel">กำลังโหลดรายละเอียดกิจกรรม...</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <?php if (count($posts["data"]) >= 10) {
        require_once '../app/component/buttonPage.php';
    } ?>
    <script src="../js/home.js"></script>
</body>

</html>