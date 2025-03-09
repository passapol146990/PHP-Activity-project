<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style/home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="Logo_size32.png">
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
                            <div class="text-end quota"><?= htmlspecialchars($post["approved_count"] . "/" . $post["p_max"]) ?>
                            </div>
                            <div class="event-image">
                                <img src="/get/image?img=/post/<?= htmlspecialchars($post["image"]) ?>" alt="Event Image" width="100%" loading="lazy">
                            </div>
                            <div class="text-start event-info p-2 d-flex flex-column flex-grow-1">
                                <label class="limited-text"><?= htmlspecialchars(mb_strimwidth($post["p_name"] ?? "", 0, 50, "...")) ?></label>
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
                                        <div class="text-success col-6 d-flex justify-content-start align-items-center fw-bold">
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
                                        <div class="text-warning col-6 d-flex justify-content-start align-items-center fw-bold">
                                            <svg class="me-2" width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                                </g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <g id="style=bulk">
                                                        <g id="warning-circle">
                                                            <path id="vector (Stroke)" fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M1.25 12C1.25 6.06294 6.06294 1.25 12 1.25C17.9371 1.25 22.75 6.06294 22.75 12C22.75 17.9371 17.9371 22.75 12 22.75C6.06294 22.75 1.25 17.9371 1.25 12Z"
                                                                fill="#ffdd00"></path>
                                                            <path id="vector (Stroke)_2" fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M12 6.25C12.4142 6.25 12.75 6.58579 12.75 7V14.1047C12.75 14.5189 12.4142 14.8547 12 14.8547C11.5858 14.8547 11.25 14.5189 11.25 14.1047V7C11.25 6.58579 11.5858 6.25 12 6.25Z"
                                                                fill="#000000"></path>
                                                            <path id="ellipse (Stroke)" fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M11 17C11 16.4477 11.4477 16 12 16H12.01C12.5623 16 13.01 16.4477 13.01 17C13.01 17.5523 12.5623 18 12.01 18H12C11.4477 18 11 17.5523 11 17Z"
                                                                fill="#000000"></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                            รอการตรวจสอบ...
                                        </div>
                                        <?php
                                    } elseif ($post["user_status"] === "ปฏิเสธ") {
                                        ?>
                                        <div class="text-danger col-6 d-flex justify-content-start align-items-center fw-bold">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" class="me-2"
                                                style="stroke: red; fill: white;">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 6l12 12M6 18L18 6" />
                                            </svg>
                                            ปฏิเสธการเข้าร่วม
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
    <?php if (count($posts["data"]) >= 10||(isset($_GET["page"]))) {
        require_once '../app/component/buttonPage.php';
    } ?>
    <script src="../js/homex.js"></script>
</body>

</html>