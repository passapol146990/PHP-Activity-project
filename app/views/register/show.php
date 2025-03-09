<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../style/register/show.css">

    <link rel="shortcut icon" type="image/x-icon" href="../../Logo_size32.png">
    <title>กิจกรรมที่เข้าร่วม</title>

    
</head>
<body>
    <?php require_once '../app/component/navbar.php'; ?>
    <div class="container bg-white pt-2 rounded" style="margin-top: 20px;">
        <div class="text-head">กิจกรรมที่ขอเข้าร่วม</div>
        <div class="mt-4">
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
                        <th style="width: 10%;"></th>
                    </tr>
                </thead>
                <tbody>
                    <? foreach ($myactivities["data"] as $key => $doc) { ?>
                       
                        <tr>
                            <td>
                                <lable style="font-size:12px; font-family: 'Prompt', sans-serif;"><?= htmlspecialchars(formatThaiDate($doc['register_datetime'])) ?> </lable>
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
                                <button onClick="getDetailPost('<?= htmlspecialchars($doc["post_id"]) ?>')" class="btn btn-outline-primary btn-sm raduis">รายละเอียดกิจกรรม</button>
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
                                        $action = '<button onClick="cancelRegister('."'$rid','$pid','$title'".')" class="btn btn-danger">ลบ</button>';
                                        break;
                                    case 'อนุมัติ':
                                        $text = "<span class='text-success'>".htmlspecialchars($doc["register_status"])."</span>";
                                        if(!isset($doc["reg_image"])){
                                            $action = '<button onClick="openModal(\'' . $pid . '\')" class="btn btn-success">ส่งรูปภาพ</button>';
                                        }else{
                                            $action = '<a target="_blank" href="/get/image?img=/submit/'.htmlentities($doc["reg_image"]).'" class="btn text-primary">ดูรูปภาพ</a>';
                                        }
                                        break;
                                    case 'ปฏิเสธ':
                                        $text = "<span class='text-danger'>".htmlspecialchars($doc["register_status"])."</span>";
                                        $action = '<button onClick="cancelRegister('."'$rid','$pid','$title'".')" class="btn btn-danger">ลบ</button>';
                                        break;
                                }
                                echo "<td>{$text}</td>";
                                echo "<td>{$action}</td>";
                            ?>
                        </tr>
                        <? if(!isset($doc["reg_image"])){?>
                            <div class="modal fade text-font" id="Modal_submit_pic_<?= $pid ?>">
                                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">รายละเอียดกิจกรรม <?= htmlspecialchars($doc["post_name"]) ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="/image/submit" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="pid" value="<?= $pid ?>">
                                            <label id="file-name-<?= $pid ?>" class="text-muted text-center" style="display: none;"></label>
                                            <div class="image-upload-container">
                                                <div id="image-preview-<?= $pid ?>" class="image-preview" 
                                                    style="width: 550px; height: 280px; display: flex; align-items: center; justify-content: center; border: 1px dashed #ccc; position: relative; cursor: pointer;" 
                                                    onclick="triggerFileInput('file-upload-<?= $pid ?>')">
                                                    <img id="preview-img-<?= $pid ?>" src="#" alt="Image Preview" style="display: none; object-fit: contain; width: 100%; height: 100%;">
                                                    <button id="upload-btn-<?= $pid ?>" class="btn btn-outline-secondary btn-lg" type="button">อัพโหลดรูปภาพ</button>
                                                </div>
                                                <input id="file-upload-<?= $pid ?>" type="file" accept="image/*" name="image" style="display: none;" onchange="previewImage(this, '<?= $pid ?>')">
                                            </div>
                                            <div class="success-pad">
                                                <button id="submit-btn-<?= $pid ?>" type="submit" class="btn btn-success" disabled>ส่งรูปภาพ</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <? } ?>
                    <? } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-passapol" id="Modal_Activity_1">
        <div class="modal-dialog modal-dialog-centered modal-lg bg-white p-3" style="width: 50%;height:20%;">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title" id="exampleModalLabel">กำลังโหลดรายละเอียดกิจกรรม...</h5>
                    </div>
                    <button type="button" class="btn-close" onClick="closePopUp()"></button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div> 
    <?php if(count($myactivities["data"])>=10||(isset($_GET["page"]))){
        require_once '../app/component/buttonPage.php';
    }?>
    <script src="../../js/register/show.js"></script>
</body>
</html>