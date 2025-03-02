<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <title>req Activity</title>

    <style>
        .text-font {
            font-family: 'Mitr';
            font-size: 18px;
            font-weight: 300;

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
            /*white-space: nowrap; /* ป้องกันข้อความขึ้นบรรทัดใหม่ */
        }

        th {
            background-color: #f8f9fa;
        }

        .btn-success {
            width: 90px;
            /* กำหนดขนาดปุ่มให้เท่ากัน */
        }

        .img-thumbnail {
            width: 140px;
            height: 85px;
            object-fit: cover;
            /* ป้องกันรูปเบี้ยว */

        }

        .text-head {
            font-family: 'Mitr';
            font-size: 36px;
            font-weight: 400;
        }

        .raduis {
            border-radius: 15px;
        }

        tr:first-child th,
        tr:first-child td {
            border-top: 2px solid black;
            border-bottom: 2px solid black;
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
            /* ระยะห่างระหว่างรูปและปุ่ม */
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
    </style>
</head>

<body>
<?php require_once '../app/component/navbar.php'; ?>
<div class="container" style="margin-top: 20px;">
    <div class="text-head">
        กิจกรรมที่ขอเข้าร่วม
    </div>
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
                <?php
                $account_id = $_SESSION["login_token"];
                $activities = getRegisteredActivities($account_id);

                $status_mapping = [
                    'pending' => 'รอการตรวจสอบ',
                    'approved' => 'อนุมัติ',
                    'rejected' => 'ปฏิเสธ',
                    'cancelled' => 'ยกเลิก'
                ];

                foreach ($activities as $activity) {
                    $register_datetime = $activity["register_datetime"];
                    $post_image = htmlspecialchars($activity["post_image"]);
                    $post_name = htmlspecialchars($activity["post_name"]);
                    $post_date_start = $activity["post_date_start"];
                    $post_date_end = $activity["post_date_end"];
                    $registered_count = $activity["approved_registers"];
                    $post_max = $activity["post_max"];
                    $post_about = htmlspecialchars($activity["post_about"]);
                    $register_status = $activity["register_status"];
                    $post_id = $activity["post_id"];
                    $register_id = $activity["register_id"];
                    $imageUrl = $post_image ? "/get/image?img=/post/" . urlencode($post_image) : "/path/to/default/image.jpg";
                    $register_status_th = $status_mapping[$register_status] ?? $register_status;

                    $action_button = '';
                    if ($register_status == 'รอการตรวจสอบ') {
                        $action_button = '<button class="btn btn-danger btn-sm" onclick="cancelRegistration(' . $register_id . ')">ยกเลิก</button>';
                    } elseif ($register_status == 'อนุมัติ') {
                        $action_button = '<button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#Modal_submit_pic_' . $post_id . '">ส่งรูปภาพ</button>';
                    }

                    echo "
                    <tr>
                        <td>$register_datetime</td>
                        <td><img src='$imageUrl' class='img-thumbnail' alt='กิจกรรม' style='width: 100px; height: auto;'></td>
                        <td>$post_name</td>
                        <td>$post_date_start - $post_date_end</td>
                        <td>$registered_count / $post_max</td>
                        <td>
                            <button class='btn btn-outline-primary btn-sm raduis' data-bs-toggle='modal' data-bs-target='#Modal_Activity_$post_id'>
                                รายละเอียดกิจกรรม
                            </button>
                        </td>
                        <td>$register_status_th</td>
                        <td>$action_button</td>
                    </tr>
                    ";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal สำหรับแสดงรายละเอียดกิจกรรม -->
    <?php
    foreach ($activities as $activity) {
        $post_id = $activity["post_id"];
        $post_name = htmlspecialchars($activity["post_name"]);
        $post_date_start = $activity["post_date_start"];
        $post_date_end = $activity["post_date_end"];
        $post_about = htmlspecialchars($activity["post_about"]);
        $post_max = $activity["post_max"];
        $post_image = htmlspecialchars($activity["post_image"]);
        $register_datetime = $activity["register_datetime"];
        $imageUrl = "/get/image?img=/post/" . urlencode($post_image);

       
        $creator_fname = htmlspecialchars($activity["creator_fname"]);
        $creator_lname = htmlspecialchars($activity["creator_lname"]);
        $creator_image = htmlspecialchars($activity["creator_image"]);
        $creatorImageUrl = "/get/image?img=/profile/" . urlencode($creator_image);

        echo "
    <div class='modal fade text-font' id='Modal_Activity_$post_id' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        <div class='modal-dialog modal-dialog-scrollable modal-lg'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='exampleModalLabel'>รายละเอียดกิจกรรม<br><small class='text-muted small-text'>วันที่ $register_datetime</small></h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                    <div class='row d-flex align-items-center mb-3'>
                        <div class='col-3 text-end'>ผู้สร้างกิจกรรม :</div>
                        <div class='col-9'>
                            <div class='d-flex align-items-center'>
                                <img src='$creatorImageUrl' alt='ผู้สร้าง' style='width: 50px; height: 50px; border-radius: 50%; object-fit: cover; margin-right: 10px;'>
                                <div>
                                     <div><span class='bold_text_modal'>ชื่อผู้สร้าง :</span> $creator_fname $creator_lname</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='row d-flex align-items-center mb-3'>
                        <div class='col-3 text-end'>กิจกรรม :</div>
                        <div class='col-9'>
                            <img src='$imageUrl' alt='กิจกรรม' style='width: 350px; height: 230px; object-fit: cover;'>
                        </div>
                    </div>
                    <div class='row d-flex align-items-center mb-2'>
                        <div class='col-3 text-end'></div>
                        <div class='col-9'>
                            <div><span class='bold_text_modal'>ชื่อกิจกรรม :</span> $post_name</div>
                            <div><span class='bold_text_modal'>ช่วงเวลา :</span> $post_date_start - $post_date_end</div>
                            <div><span class='bold_text_modal'>รายละเอียด :</span> $post_about</div>
                            <div><span class='bold_text_modal'>จำนวนที่เปิดรับ :</span> $post_max</div>
                        </div>
                    </div>
                   
                </div>
                <div class='success-pad'>
                    <button type='button' class='btn btn-success btn-md'>เข้าร่วม</button>
                </div>
            </div>
        </div>
    </div>
    ";
    }
    ?>
    <!-- Modal สำหรับอัปโหลดรูปภาพ -->
    <?php
    foreach ($activities as $activity) {
        $post_id = $activity["post_id"];
        $register_datetime = $activity["register_datetime"];

        echo "
        <div class='modal fade text-font' id='Modal_submit_pic_$post_id' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-scrollable modal-lg'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='exampleModalLabel'>รายละเอียดกิจกรรม<br><small class='text-muted small-text'>วันที่ $register_datetime</small></h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body d-flex justify-content-center'>
                        <label for='file-upload-$post_id' class='custom-file-upload'>
                            <div class='image-upload-container'>
                                <div id='image-preview-$post_id' class='image-preview' style='width: 550px; height: 280px;'>
                                    <img id='preview-img-$post_id' src='#' alt='Image Preview' style='display: none; object-fit: contain;'>
                                    <button id='upload-btn-$post_id' class='btn btn-outline-secondary btn-lg' onclick=\"document.getElementById('file-upload-$post_id').click()\">อัพโหลดรูปภาพ</button>
                                </div>
                                <div class='d-flex flex-column align-items-center'>
                                    <input id='file-upload-$post_id' type='file' accept='image/*' onchange=\"previewImage(event, '$post_id')\" style='display: none;'>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class='success-pad'>
                        <button type='button' class='btn btn-success' style='width: 100px; height: 50px'>ส่งรูปภาพ</button>
                    </div>
                </div>
            </div>
        </div>
        ";
    }
    ?>

    <!-- Script สำหรับแสดงรูปภาพที่อัปโหลด -->
    <script>
        function previewImage(event, postId) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview-img-' + postId);
                var uploadBtn = document.getElementById('upload-btn-' + postId);

                output.src = reader.result;
                output.style.display = 'block'; // แสดงภาพเมื่อเลือกไฟล์
                uploadBtn.style.display = 'none'; // ซ่อนปุ่มอัพโหลดหลังจากอัพโหลดไฟล์
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>

</html>