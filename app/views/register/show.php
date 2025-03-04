<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="shortcut icon" type="image/x-icon" href="../../Logo_size32.png">
    <title>กิจกรรมที่เข้าร่วม</title>

    <style>
        .text-font {
            font-family: 'Mitr';
            font-size: 18px;
            font-weight: 400;

        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            font-family: 'Mitr';
            font-weight: 200;
            text-align: center;
            vertical-align: middle;
            border: 0px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f8f9fa;
        }

        .btn-success {
            width: 90px;
        }

        .img-thumbnail {
            width: 140px;
            height: 85px;
            object-fit: cover;
        }

        .text-head {
            font-family: 'Mitr';
            font-size: 36px;
            font-weight: 400;
        }

        .raduis {
            border-radius: 15px;
        }

        h5 {
            font-weight: 300;
            justify-content: center;
        }

        .bold_text_modal {
            font-weight: 500;
        }


        .small-text {
            font-size: 0.8rem;
        }

        .success-pad {
            padding: 1%;
            display: flex;
            justify-content: center;
            align-items: center;
            min-width: 120px;
            height: auto;
        }

        .modal-header .btn-close {
            position: absolute;
            top: 0;
            right: 0;
            padding: 1rem;
            margin: 0;
        }

        .img_show {
            width: 200px;
            height: 70px;
        }

        .image-upload-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 20px;
        }

        .image-preview {
            width: 150px;
            height: 150px;
            border: 2px solid #ddd;
            border-radius: 8px;
            margin-bottom: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        #preview-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        button {
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }

        .bt_pri {
            width: 90px;
        }

        p {
            font-size: small;
            margin: 0px;
            text-align: left;
            padding-left: 3%;

        }



        .btn_secondary {
            width: 100px;
            margin-top: 10%;
        }

        .badge-notification {
            position: absolute;
            top: 1px;
            right: 0px;
            background-color: red;
            color: white;
            font-size: 10px;
            font-weight: 500;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0.8;

        }

        .badge-notification:empty {
            display: none;
        }

        .btn-warning {
            margin-top: 10px;
            width: 124px;
            color: rgb(255, 255, 255);
        }

        .modal-header p {
            margin-top: auto;
            margin-bottom: 3px;
        }

        .text_show_data {
            font-family: 'Mitr', sans-serif;
            font-size: 16px;
            font-weight: 200px;

        }

        .modal {
            z-index: 1050 !important;
        }

        #profileModal {
            z-index: 1060 !important;
        }
        .modal-passapol {
            z-index: 111;
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            justify-content: center;
            align-items: center;
            transition: opacity 0.3s ease;

            .content {
                background: white;
                padding: 5px 20px;
                border-radius: 10px;
                max-width: 90%;
                min-width: 30%;
                max-height: 90%;
                overflow: hidden;
                text-align: center;
                box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
                transform: translateY(-20px);
                transition: transform 0.3s ease;

                .close-btn {
                    background: none;
                    border: none;
                    font-size: 20px;
                    cursor: pointer;
                    color: #555;
                    position: absolute;
                    top: 15px;
                    right: 15px;

                    &:hover {
                        color: #000;
                    }
                }

                .header {
                    display: flex;
                    justify-items: center;
                    justify-content: space-between;
                    text-align: start;

                    .title-header {
                        font-size: 30px;
                    }
                }
            }
        }
        .show {
            display: flex;
            opacity: 1;
            .modal-content {
                transform: translateY(0);
            }
        }
    </style>
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
                                <lable style="font-size:12px; font-family: 'Prompt', sans-serif;"><?= htmlspecialchars($doc['register_datetime_th']) ?> </lable>
                            </td>
                            <td class="text-center">
                                <img src="/get/image?img=/post/<?= htmlspecialchars($doc['post_image']) ?>" class="img-thumbnail" alt="กิจกรรม"><br>
                            </td>
                            <td id="title:<?= htmlspecialchars($doc["post_id"]) ?>">
                                <?= htmlspecialchars($doc['post_name'] ?? "") ?>
                            </td>
                            <td style="font-size:14px; font-family: 'Prompt', sans-serif;">
                                <?= htmlspecialchars($doc['post_date_start_th']) ?> - <?= htmlspecialchars($doc['post_date_end_th']) ?>
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
                                        $action = '<buttom onClick="cancelRegister('."'$rid','$pid','$title'".')" class="btn btn-danger bt_pri btn-sm">ลบ</buttom>';
                                        break;
                                    case 'อนุมัติ':
                                        $text = "<span class='text-success'>".htmlspecialchars($doc["register_status"])."</span>";
                                        break;
                                    case 'ปฏิเสธ':
                                        $text = "<span class='text-danger'>".htmlspecialchars($doc["register_status"])."</span>";
                                        break;
                                    default:
                                        $text = "<span class='text-dark'>".htmlspecialchars($doc["register_status"])."</span>";
                                    break;
                                }
                                echo "<td>{$text}</td>";
                                echo "<td>{$action}</td>";
                            ?>
                        </tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-passapol" id="Modal_Activity_1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
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
    <!-- <div class="modal fade text-font" id="Modal_submit_pic_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">รายละเอียดกิจกรรม<br><small class="text-muted small-text">วันที่ 25/2/68 19:25:40 น.</small></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center">
                    <label for="file-upload" class="custom-file-upload">
                        <div class="image-upload-container ">

                            <div id="image-preview" class="image-preview " style="width: 550px; height: 280px;">
                                <img id="preview-img" src="#" alt="Image Preview" style="display: none; object-fit: contain;">
                                <button id="upload-btn" class="btn btn-outline-secondary btn-lg" onclick="document.getElementById('file-upload').click()">อัพโหลดรูปภาพ</button>
                            </div>

                            <div class="d-flex flex-column align-items-center">
                                <input id="file-upload" type="file" accept="image/*" onchange="previewImage(event)" style="display: none;">
                            </div>
                        </div>

                        <script>
                            function previewImage(event) {
                                var reader = new FileReader();
                                reader.onload = function() {
                                    var output = document.getElementById('preview-img');
                                    var uploadBtn = document.getElementById('upload-btn');

                                    output.src = reader.result;
                                    output.style.display = 'block';
                                    uploadBtn.style.display = 'none';
                                }
                                reader.readAsDataURL(event.target.files[0]);
                            }
                        </script>
                </div>
                <div class="success-pad">
                    <button type="button" class="btn btn-success" style="width: 100px; height: 50px">ส่งรูปภาพ</button>
                </div>
            </div>
        </div>
    </div> -->
    <script src="../../js/register.js"></script>
</body>
</html>