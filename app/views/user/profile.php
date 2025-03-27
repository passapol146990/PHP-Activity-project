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
    <title>โปรไฟล์ผู้ใช้</title>
</head>

<body>
    <?php require_once '../app/component/navbar.php'; ?>
    <div class="event-section text-center">
        <div class="col-md-8 offset-md-2 bg-white p-5 mt-2 mb-5 rounded shadow">
            <?php
                if($account == null){
                    echo "<h2 class='title text-start'>ไม่พบข้อมูลผู้ใช้</h2>";
                    exit();
                }
            ?>
            <div>
                <img src="/get/image?img=/user/<?= htmlspecialchars($account["image"]) ?>" alt="/get/image?img=/user/<?= htmlspecialchars($account["image"]) ?>" width="100px" height="100px" class="rounded-circle">
            </div>
            <h2 class="title text-start">ข้อมูลผู้ใช้ : <?= htmlspecialchars($account["fname"].' '.$account["lname"]) ?></h2>
            <div class="text-start">
                <label>จำนวนกิจกรรมที่เข้าร่วม : <?= htmlspecialchars($c_reg) ?></label>
                <br>
                <label>จำนวนกิจกรรมที่สร้าง : <?= htmlspecialchars($c_post) ?></label>
            </div>
            <button class="btn btn-primary" onclick="SelectMode('creted')">กิจกรรมที่สร้าง</button>
            <button class="btn btn-primary" onclick="SelectMode('reged')">กิจกรรมที่เข้าร่วม</button>
            <div class="">
                <div id="creted" class="row p-3">
                    <? foreach ($post["data"] as $key => $post) { ?>
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
                                        <button class="btn btn-primary w-100"
                                            onClick="getDetailPost('<?= htmlspecialchars($post["p_id"]) ?>')"
                                            data-bs-toggle="modal" data-bs-target="#Modal_Activity_1">รายละเอียด</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <? } ?>
                </div>
                <div id="reged" class="row p-3">
                    <table class="table">
                        <thead>
                            <tr class="text-font">
                                <th style="width: 9%;">วันที่ส่งคำขอ</th>
                                <th style="width: 13%;">รูปกิจกรรม</th>
                                <th style="width: 15%;">กิจกรรม</th>
                                <th style="width: 15%;">ช่วงเวลากิจกรรม</th>
                                <th style="width: 10%;">จำนวนคนสมัคร</th>
                                <th style="width: 15%;">รายละเอียดเพิ่มเติม</th>
                                <th style="width: 13%;">สถานะ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <? foreach ($reg["data"] as $key => $doc) { ?>
                                <tr>
                                    <td>
                                        <lable style="font-size:12px; font-family: 'Prompt', sans-serif;"><?= htmlspecialchars(formatThaiDateTime($doc['register_datetime'])) ?> </lable>
                                    </td>
                                    <td class="text-center">
                                        <img src="/get/image?img=/post/<?= htmlspecialchars($doc['post_image']) ?>" class="img-thumbnail" alt="กิจกรรม"><br>
                                    </td>
                                    <td id="title:<?= htmlspecialchars($doc["post_id"]) ?>">
                                        <?= htmlspecialchars(mb_strimwidth($doc["post_name"] ?? "", 0, 20, "...")) ?>
                                    </td>
                                    <td style="font-size:14px; font-family: 'Prompt', sans-serif;">
                                        <?= htmlspecialchars(formatThaiDate($doc['post_date_start'])) ?> - <?= htmlspecialchars(formatThaiDate($doc['post_date_end'])) ?>
                                    </td>
                                    <td id="numberpeople:<?= htmlspecialchars($doc["post_id"]) ?>">
                                        <?= htmlspecialchars($doc['approved_registers'] . "/" . $doc["post_max"]) ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary w-100"
                                            onClick="getDetailPost('<?= htmlspecialchars($doc["post_id"]) ?>')"
                                            data-bs-toggle="modal" data-bs-target="#Modal_Activity_1">รายละเอียด</button>
                                    </td>
                                    <?php
                                        $text = "";
                                        $action = "";
                                        $rid = htmlspecialchars($doc["register_id"]);
                                        $pid = htmlspecialchars($doc["post_id"]);
                                        $title = htmlspecialchars($doc['post_name']);

                                        switch($doc["register_status"]){
                                            case 'รอการตรวจสอบ':
                                                $text = "<span class='text-warning'>".htmlspecialchars($doc["register_status"])."</span>";
                                                break;
                                            case 'อนุมัติ':
                                                $text = "<span class='text-success'>".htmlspecialchars($doc["register_status"])."</span>";
                                                break;
                                            case 'ปฏิเสธ':
                                                $text = "<span class='text-danger'>".htmlspecialchars($doc["register_status"])."</span>";
                                                break;
                                        }
                                        echo "<td>{$text}</td>";
                                    ?>
                                </tr>
                            <? } ?>
                        </tbody>
                    </table>    
                </div>
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
    <script>
        const x = document.querySelector(".search-container");
        x.remove();
        const creted = document.getElementById("creted");
        const reged = document.getElementById("reged");
        function SelectMode(id){
            if(id==="creted"){
                creted.style.display = "flex";
                reged.style.display = "none";
            }else{
                creted.style.display = "none";
                reged.style.display = "flex";
            }
        }
    </script>
    <script src="../js/user/profile.js"></script>
</body>

</html>