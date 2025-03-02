<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/home.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                            <div class="text-end quota">18/20</div>
                            <div class="event-image">
                                <img src="/get/image?img=/post/<?= htmlspecialchars($post["image"]) ?>" alt="Event Image" width="100%" loading="lazy">
                            </div>
                            <div class="text-start event-info p-2 d-flex flex-column flex-grow-1">
                                <label class="limited-text"><?= htmlspecialchars($post["p_name"]??"") ?></label>
                                <p class="limited-text"><?= $post["p_date_start"] ?> - <?= $post["p_date_end"] ?></p>
                                <div class="mt-auto d-flex justify-content-between gap-2">
                                    <button class="btn btn-success col-6" onClick="registerPost('<?= htmlspecialchars($post["p_id"]) ?>')">เข้าร่วม</button>
                                    <button class="btn btn-primary col-6" onClick="getDetailPost('<?= htmlspecialchars($post["p_id"]) ?>')" data-bs-toggle="modal" data-bs-target="#Modal_Activity_1">รายละเอียด</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <? } ?>
            </div>
        </div>
    </div>
    <div class="modal fade text-font" id="Modal_Activity_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div><h5 class="modal-title" id="exampleModalLabel">กำลังโหลดรายละเอียดกิจกรรม...</h5></div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <script src="../js/home.js"></script>
</body>
</html>
