<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="../../Logo_size32.png">
    <link rel="stylesheet" href="../../style/activity/show.css">
    <title>กิจกรรมที่สร้าง</title>
</head>
<body>
    <?php require_once '../app/component/navbar.php'; ?>
    <div class="container bg-white pt-2 rounded" style="margin-top: 20px;">
        <div class="text-head">กิจกรรมที่สร้าง</div>
        <div class="mt-4">
            <table class="table">
                <thead>
                    <tr class="text-font">
                        <th style="width: 16%;">รูปกิจกรรม</th>
                        <th style="width: 15%;">ชื่อกิจกรรม</th>
                        <th style="width: 15%;">รายละเอียด</th>
                        <th style="width: 16%;">วันที่</th>
                        <th style="width: 12%;">จำนวนคนสมัคร</th>
                        <th style="width: 16%;">เพิ่มเติม</th>
                        <th style="width: 12%;"></th>
                    </tr>
                </thead>
                <tbody>
                <? foreach($data["data"] as $key => $doc){ ?>
                    <tr>
                        <td class="text-center">
                            <img src="/get/image?img=/post/<?= htmlspecialchars($doc['image']) ?>" class="img-thumbnail" alt="กิจกรรม"><br>
                            <lable style="font-size:12px; font-family: 'Prompt', sans-serif;"><?= htmlspecialchars(formatThaiDateTime($doc['p_datetime'])) ?> </lable>
                        </td>
                        <td id="title:<?= htmlspecialchars($doc["p_id"]) ?>">
                            <?= htmlspecialchars(mb_strimwidth($doc["p_name"] ?? "", 0, 20, "...")) ?>
                        </td>
                        <td>
                            <button onClick="getDetailPost('<?= htmlspecialchars($doc["p_id"]) ?>')" class="btn btn-outline-primary btn-sm raduis">รายละเอียดกิจกรรม</button>
                        </td>
                        <td style="font-size:14px; font-family: 'Prompt', sans-serif;"><?= htmlspecialchars(formatThaiDate($doc['p_date_start'])) ?> - <?= htmlspecialchars(formatThaiDate($doc['p_date_end'])) ?></td>
                        <td>
                            <lable id="numberpeople:<?= htmlspecialchars($doc["p_id"]) ?>"><?= htmlspecialchars($doc['approved_registers']."/".$doc["p_max"]) ?></lable><br>
                            <div class="position-relative d-inline-block">
                                <button onClick="getRegisterPost('<?= htmlspecialchars($doc['p_id']) ?>')" class="btn btn-outline-secondary btn-sm raduis btn_secondary">คำขอเข้าร่วม</button>
                                <? if($doc["pending_registers"]>0){ ?>
                                    <span class="badge-notification"><?= htmlspecialchars(($doc["pending_registers"]>0)?$doc["pending_registers"]:"") ?></span>
                                <? } ?>
                            </div>
                        </td>
                        <td>
                            <p>คำขอทั้งหมด : <?= htmlspecialchars($doc['total_registers']) ?></p>
                            <p>อนุมัติ : <lable id="approved:<?= htmlspecialchars($doc["p_id"]) ?>"><?= htmlspecialchars($doc['approved_registers']) ?></lable></p>
                            <p>ปฏิเสธ : <lable id="rejected:<?= htmlspecialchars($doc["p_id"]) ?>"><?= htmlspecialchars($doc['rejected_registers']) ?></lable></p>
                            <lable id="pending:<?= htmlspecialchars($doc["p_id"]) ?>" style="display:none;"><?= htmlspecialchars($doc['pending_registers']) ?></lable>
                        </td>
                        <td>
                        <div class="mt-2"></div>
                            <a class="btn btn-primary w-100 mb-1" href="/activity/edit?pid=<?= htmlspecialchars($doc["p_id"]) ?>">แก้ไข</a>
                            <button onClick="checkSubpic('<?= htmlspecialchars($doc['p_id']) ?>')" class="btn btn-warning w-100 mb-1" >ตรวจรูปภาพ</button>
                            <button class="btn btn-danger w-100" onClick="DeletePost('<?= htmlspecialchars($doc["p_id"]) ?>','<?= htmlspecialchars($doc["p_name"]) ?>')">ลบ</button>
                        </td>
                    </tr>
                <? } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-passapol" id="Modal_Activity_1">
        <div class="content">
            <div class="header">
                <div>
                    <h5 class="modal-title" id="exampleModalLabel">กำลังโหลดรายละเอียดกิจกรรม...</h5>
                </div>
                <button type="button" class="btn-close" style="margin-top:-10px;" onClick="closePopUp()"></button>
            </div>
            <div class="body">
            </div>
        </div>
    </div>
    <div class="modal-passapol" id="req_activity_1">
        <div class="content">
            <div class="header mb-3">
                <div>
                    <label class="title-header">คำขอเข้าร่วมกิจกรรม</label>:<br>
                </div>
                <button class="close-btn" style="margin-top:-10px;" onClick="closePopUp(1)">&times;</button>
            </div>
            <div class="body"></div>
        </div>
    </div>
    <div class="modal-passapol" id="check_pic">
        <div class="content" style="width:50%;height:30%;">
            <div class="header mb-3">
                <div>
                    <label class="title-header">ตรวจสอบรูปภาพ</label>:<br>
                </div>
                <button class="close-btn" onClick="closePopUp(1)">&times;</button>
            </div>
            <div class="body text-center p-5">
                <h5>ไม่พบรูปภาพผู้ขอเข้าร่วม</h5>
            </div>
        </div>
    </div>
    <div class="modal-passapol" id="Modal_user_data_1">
        <div class="content" style="width:50%;height:30%;">
            <div class="header mb-3">
                <div>
                    <label class="title-header">ข้อมูลผู้ใช้</label>:<br>
                </div>
                <button class="close-btn" onClick="closePopUp(1)">&times;</button>
            </div>
            <div class="body text-center p-5">
                <h5>ไม่พบข้อมูลของผู้ใช้</h5>
            </div>
        </div>
    </div>
    <?php if(count($data["data"])>=10||(isset($_GET["page"]))){
        require_once '../app/component/buttonPage.php';
    }?>
    <script src="../../js/activity/showx.js"></script>
</body>
</html>