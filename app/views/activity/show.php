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
    <title>กิจกรรมที่สร้าง</title>
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
            /*border-top: 2px solid black; */
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
            /* ดันให้ <p> ลงไปชิดด้านล่าง */
            margin-bottom: 3px;
        }

        .text_show_data {
            font-family: 'Mitr', sans-serif;
            font-size: 16px;
            font-weight: 200px;

        }

        /* modal ทับ modal */
        .modal-backdrop {
            z-index: 1040 !important;
            /* ป้องกัน backdrop ซ้อนทับ modal ตัวแรก */
        }

        .modal {
            z-index: 1050 !important;
            /* กำหนดให้ modal 1 อยู่ระดับกลาง */
        }

        #profileModal {
            z-index: 1060 !important;
            /* กำหนดให้ modal 2 อยู่ด้านบนสุด */
        }
    </style>
</head>

<body>
    <?php require_once '../app/component/navbar.php'; ?>
    <div class="container" style="margin-top: 20px;">
        <div class="text-head">กิจกรรมที่สร้าง</div>
        <div class="mt-4">
            <table class="table">
                <thead>
                    <div style="border-top: 2px solid black;"></div>
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

                <!-- show data-->
                <tbody>
                    <tr>
                        <td><img src="https://htmlcolorcodes.com/assets/images/colors/cream-color-solid-background-1920x1080.png" class="img-thumbnail" alt="กิจกรรม"></td>
                        <td>C4C ค่ายมหาลัยสู่โรงเรียนในชุมชน</td>
                        <td>
                            <button class="btn btn-outline-primary btn-sm raduis" data-bs-toggle="modal" data-bs-target="#Modal_Activity_1">
                                รายละเอียดกิจกรรม
                            </button>
                        </td>
                        <td>1/2/2568 - 5/2/2568</td>
                        <td>
                            1/20
                            <div class="position-relative d-inline-block">
                                <button class="btn btn-outline-secondary btn-sm raduis btn_secondary"
                                    data-bs-toggle="modal" data-bs-target="#req_activity_1">คำขอเข้าร่วม
                                </button>
                                <span class="badge-notification">3</span>
                            </div>
                        </td>

                        <td>
                            <p>คำขอทั้งหมด : 3</p>
                            <p>อนุมัติ : 1</p>
                            <p>ปฏิเสธ : 1</p>
                            <p>สร้างกิจกรรมเมื่อ : 21/2/2568 </p>
                        </td>
                        <td>
                            <button class="btn btn-primary bt_pri btn-sm">แก้ไข</button>
                            <div class="mb-3"></div>
                            <button class="btn btn-danger bt_pri btn-sm">ลบ</button>
                        </td>
                    </tr>
                </tbody>

                <tbody>
                    <tr>
                        <td><img src="https://htmlcolorcodes.com/assets/images/colors/cream-color-solid-background-1920x1080.png" class="img-thumbnail" alt="กิจกรรม"></td>
                        <td>C4C ค่ายมหาลัยสู่โรงเรียนในชุมชน</td>
                        <td>
                            <button class="btn btn-outline-primary btn-sm raduis" data-bs-toggle="modal" data-bs-target="#Modal_Activity_1">
                                รายละเอียดกิจกรรม
                            </button>
                        </td>
                        <td>1/2/2568 - 5/2/2568</td>
                        <td>
                            1/20
                            <div class="position-relative d-inline-block">
                                <button class="btn btn-outline-secondary btn-sm raduis btn_secondary">คำขอเข้าร่วม</button>
                                <span class="badge-notification">2</span>
                            </div>
                        </td>

                        <td>
                            <p>คำขอทั้งหมด : 2</p>
                            <p>อนุมัติ : 0</p>
                            <p>ปฏิเสธ : 0</p>
                            <p>สร้างกิจกรรมเมื่อ : 21/2/2568 </p>
                        </td>
                        <td>
                            <button class="btn btn-primary bt_pri btn-sm">แก้ไข</button>
                            <div class="mb-3"></div>
                            <button class="btn btn-danger bt_pri btn-sm">ลบ</button>
                        </td>
                    </tr>
                </tbody>

                <tbody>
                    <tr>
                        <td><img src="https://htmlcolorcodes.com/assets/images/colors/cream-color-solid-background-1920x1080.png" class="img-thumbnail" alt="กิจกรรม"></td>
                        <td>C4C ค่ายมหาลัยสู่โรงเรียนในชุมชน</td>
                        <td>
                            <button class="btn btn-outline-primary btn-sm raduis" data-bs-toggle="modal" data-bs-target="#Modal_Activity_1">
                                รายละเอียดกิจกรรม
                            </button>
                        </td>
                        <td>1/2/2568 - 5/2/2568</td>
                        <td>
                            20/20
                            <div class="position-relative d-inline-block">
                                <button class="btn btn-outline-secondary btn-sm raduis btn_secondary">คำขอเข้าร่วม</button>
                                <span class="badge-notification"></span>
                            </div>
                        </td>

                        <td>
                            <p>คำขอทั้งหมด : 0</p>
                            <p>อนุมัติ : 20</p>
                            <p>ปฏิเสธ : 0</p>
                            <p>สร้างกิจกรรมเมื่อ : 21/2/2568 </p>
                        </td>
                        <td>
                            <div class="position-relative d-inline-block">
                                <button class="btn btn-warning bt_pri btn-sm">ตรวจสอบรูปภาพ</button>
                                <span class="badge-notification">4</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal  มันคือ modal แรก-->
    <div class="modal fade text-font" id="Modal_Activity_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">รายละเอียดกิจกรรม<br><small class="text-muted small-text">วันที่ 25/2/68 19:25:40 น.</small></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row d-flex align-items-center mb-2">
                        <div class="col-3  text-end">ผู้สร้าง : </div>
                        <div class="col-9">
                            <img src="https://htmlcolorcodes.com/assets/images/colors/cream-color-solid-background-1920x1080.png" style="width: 75px; height: 75px; border-radius: 50%;" alt="รูปโปรไฟล์">
                            <p class="d-inline-block ms-2" style="margin-bottom: 0;">พัสพล สุธาธรรม</p>

                        </div>
                    </div>

                    <div class="row d-flex align-items-center mb-3">
                        <div class="col-3 text-end">กิจกรรม : </div>
                        <div class="col-9">
                            <img src="https://htmlcolorcodes.com/assets/images/colors/cream-color-solid-background-1920x1080.png" alt="กิจกรรม" style="width: 350px; height: 230px; object-fit: cover;">
                        </div>
                    </div>


                    <div class="row d-flex align-items-center mb-2">
                        <div class="col-3 text-end"></div>
                        <div class="col-9">
                            <div><span class="bold_text_modal">ชื่อกิจกรรม :</span> กิจกรรม c4c เข้าค่ายเพื่อโรงเรียนทางบ้าน</div>
                            <div><span class="bold_text_modal">ช่วงเวลา :</span> 20/2/2568 - 22/2/2568 (3 วัน)</div>
                            <div><span class="bold_text_modal">รายละเอียด :</span> มหาลัยมหาสารคามออกค่ายเพื่อช่วงเหลือโรงเรียนทางบ้าน ร่วมเป็นส่วนหนึ่งกับเรา ค่าเดินทาง 0 บาท</div>
                            <div><span class="bold_text_modal">จำนวนที่เปิดรับ :</span> 20</div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- Modal show people req activity-->
    <div class="modal fade text-font" id="req_activity_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">คำขอเข้าร่วมกิจกรรม : </h5>
                    <p>C4C ค่ายมหาลัยสู่โรงเรียนในชุมชน</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <table class="table">

                            <tr style="font-size: meduim;">
                                <td style="width: 15%;">3/20</td>
                                <td style="width: 55%;">ยังไม่ได้ดำเนินการ : 1</td>
                                <td style="width: 15%;">อนุมัติ : 1 </td>
                                <td style="width: 15%;">ปฏิเสธ : 1</td>
                            </tr>
                        </table>

                        <div class="container">
                            <div class="row d-flex justify-content-start align-items-center text-left text_show_data">
                                <!-- วันที่และเวลา (2 ส่วน) -->
                                <div class="col-1 p-0">
                                    <div class="d-inline text-left" style="font-size: 16px;">1/2/2568</div>
                                    <div class="d-inline text-left" style="font-size: 16px;">12:3:44</div>
                                </div>

                                <!-- รูปโปรไฟล์ (1 ส่วน) -->
                                <div class="col-2 d-inline justify-content-center align-items-center">
                                    <img src="https://i.pinimg.com/736x/54/e5/58/54e558799bef9dd570f990d3079b85ef.jpg"
                                        style="width: 55px; height: 55px; border-radius: 50%;" alt="รูปโปรไฟล์" class="ms-3">
                                                                                                <!-- modalซ้อนทับ -->
                                    <div style="font-size: small; color: blue; cursor: pointer;" onclick="openModal2()">
                                        <img src="https://cdn-icons-png.flaticon.com/512/6388/6388049.png"
                                            style="width: 15px; height: 15px; border-radius: 0%;" alt="">
                                        ข้อมูลเพิ่มเติม
                                    </div>
                                </div>

                                <div class="col-5 p-0">
                                    <p>ชื่อ ภานุมาศ ท่าสะอาด</p>
                                    <p>เพศ : ชาย</p>
                                    <p>อายุ : 19</p>



                                </div>

                                <div class="col-2 text-center">
                                    <button class="btn btn-success bt_pri btn-sm">อนุมัติ</button>
                                    <div class="mb-2"></div>
                                    <button class="btn btn-danger bt_pri btn-sm mb-2">ปฏิเสธ</button>
                                </div>
                                <div class="col-2 p-0" style="color:rgb(230, 191, 62);">⏳ยังไม่ดำเนินการ</div>

                                <div class="p-1" style="border-top: 2px solid black;"></div>

                            </div>


                        </div>

                        <div class="container">
                            <div class="row d-flex justify-content-start align-items-center text-left text_show_data">
                                <!-- วันที่และเวลา (2 ส่วน) -->
                                <div class="col-1 p-0">
                                    <div class="d-inline text-left" style="font-size: 16px;">1/2/2568</div>
                                    <div class="d-inline text-left" style="font-size: 16px;">12:3:44</div>
                                </div>

                                <!-- รูปโปรไฟล์ (1 ส่วน) -->
                                <div class="col-2 d-inline justify-content-center align-items-center">
                                    <img src="https://i.pinimg.com/736x/54/e5/58/54e558799bef9dd570f990d3079b85ef.jpg"
                                        style="width: 55px; height: 55px; border-radius: 50%;" alt="รูปโปรไฟล์" class="ms-3">
                                    <div style="font-size: small; color: blue;"><img src="https://cdn-icons-png.flaticon.com/512/6388/6388049.png"
                                            style="width: 15px; height: 15px; border-radius: 0%;" alt="">ข้อมูลเพิ่มเติม</div>
                                </div>

                                <div class="col-5 p-0">
                                    <p>ชื่อ นฤพล ท่าสะอาด</p>
                                    <p>เพศ : ชาย</p>
                                    <p>อายุ : 19</p>



                                </div>

                                <div class="col-2 text-center">✅</div>
                                <div class="col-2" style="color:rgb(32, 185, 21);">อนุมัติ</div>
                                <div style="border-top: 2px solid black;"></div>
                            </div>
                        </div>

                        <div class="container">
                            <div class="row d-flex justify-content-start align-items-center text-left text_show_data">
                                <!-- วันที่และเวลา (2 ส่วน) -->
                                <div class="col-1 p-0">
                                    <div class="d-inline text-left" style="font-size: 16px;">1/2/2568</div>
                                    <div class="d-inline text-left" style="font-size: 16px;">12:3:44</div>
                                </div>

                                <!-- รูปโปรไฟล์ (1 ส่วน) -->
                                <div class="col-2 d-inline justify-content-center align-items-center">
                                    <img src="https://i.pinimg.com/736x/54/e5/58/54e558799bef9dd570f990d3079b85ef.jpg"
                                        style="width: 55px; height: 55px; border-radius: 50%;" alt="รูปโปรไฟล์" class="ms-3">
                                    <div style="font-size: small; color: blue;"><img src="https://cdn-icons-png.flaticon.com/512/6388/6388049.png"
                                            style="width: 15px; height: 15px; border-radius: 0%;" alt="">ข้อมูลเพิ่มเติม</div>
                                </div>

                                <div class="col-5 p-0">
                                    <p>ชื่อ นฤพล ท่าสะอาด</p>
                                    <p>เพศ : ชาย</p>
                                    <p>อายุ : 19</p>



                                </div>

                                <div class="col-2 text-center">❌</div>
                                <div class="col-2" style="color:rgb(230, 0, 65);">ปฏิเสธ</div>
                                <div style="border-top: 2px solid black;"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal_submit_picture -->
    <div class="modal fade text-font" id="Modal_submit_pic_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">รายละเอียดกิจกรรม<br><small class="text-muted small-text">วันที่ 25/2/68 19:25:40 น.</small></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center">
                    <label for="file-upload" class="custom-file-upload">
                        <div class="image-upload-container ">
                            <!-- แสดงรูปภาพเป็นสี่เหลี่ยม -->
                            <div id="image-preview" class="image-preview " style="width: 550px; height: 280px;">
                                <img id="preview-img" src="#" alt="Image Preview" style="display: none; object-fit: contain;">
                                <button id="upload-btn" class="btn btn-outline-secondary btn-lg" onclick="document.getElementById('file-upload').click()">อัพโหลดรูปภาพ</button>
                            </div>

                            <div class="d-flex flex-column align-items-center">
                                <!-- input สำหรับเลือกไฟล์ -->
                                <input id="file-upload" type="file" accept="image/*" onchange="previewImage(event)" style="display: none;">
                            </div>
                        </div>

                        <!-- show picture -->
                        <script>
                            function previewImage(event) {
                                var reader = new FileReader();
                                reader.onload = function() {
                                    var output = document.getElementById('preview-img');
                                    var uploadBtn = document.getElementById('upload-btn');

                                    output.src = reader.result;
                                    output.style.display = 'block'; // แสดงภาพเมื่อเลือกไฟล์
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
    </div>


    <!-- Modal Profile คนขอเข้าร่วม มันคือ modal2-->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content p-4 position-relative">
                <div class="text-start mb-3">
                    <h5 class="fw-bold">ข้อมูลเพิ่มเติม :ภานุมาศ ท่าสะอาด</h5>
                </div>
                <button type="button" class="btn-close position-absolute end-0 top-0 m-3" data-bs-dismiss="modal"></button>

            
                <div class="d-flex align-items-center">
                    <img src="https://i.pinimg.com/736x/54/e5/58/54e558799bef9dd570f990d3079b85ef.jpg" class="rounded-circle border me-4" width="150" height="150" alt="Profile Image">

                    <!-- 🔹 ข้อมูลผู้ใช้ -->
                    <div class="ms-5">
                        <h2 class="mb-1"><strong>ชื่อ:</strong> ภานุมาศ ท่าสะอาด</h2>
                        <p class="mb-0">
                            <strong>อายุ:</strong>20
                        </p>
                        <p><strong>เพศ:</strong> ชาย</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function openModal2() {
            var modal1 = document.getElementById("req_activity_1");
            var modal2 = new bootstrap.Modal(document.getElementById("profileModal"));

            // ✅ ลดความสว่างของ modal 1 (ทำให้ดูเหมือนถูกบัง)
            modal1.style.opacity = "0.5";

            // ✅ เปิด modal 2
            modal2.show();

            // ✅ คืนค่า opacity กลับมาเมื่อ modal 2 ปิด
            document.getElementById("profileModal").addEventListener("hidden.bs.modal", function() {
                modal1.style.opacity = "1";
            });
        }
    </script>



</body>

</html>