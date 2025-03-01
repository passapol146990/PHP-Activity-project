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
        th, td {
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
            width: 90px; /* กำหนดขนาดปุ่มให้เท่ากัน */
        }
        .img-thumbnail {
            width: 140px;
            height: 85px;
            object-fit: cover; /* ป้องกันรูปเบี้ยว */
            
        }

        .text-head {
            font-family: 'Mitr';
            font-size: 36px;
            font-weight: 400;
        }

        .raduis {
            border-radius: 15px;
        }

        tr:first-child th, tr:first-child td {
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
    margin-bottom: 10px; /* ระยะห่างระหว่างรูปและปุ่ม */
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
 <?php // require_once '../app/component/navbar.php'; ?>
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

            <!-- show data-->
                <tbody>
                    <tr>
                        <td>1/1/2568 12:02:73</td>
                        <td><img src="https://htmlcolorcodes.com/assets/images/colors/cream-color-solid-background-1920x1080.png" class="img-thumbnail" alt="กิจกรรม"></td>
                        <td>C4C ค่ายมหาลัยสู่โรงเรียนในชุมชน</td>
                        <td>1/2/2568 - 5/2/2568</td>
                        <td>0/20</td>
                        <td>
                            <button class="btn btn-outline-primary btn-sm raduis" data-bs-toggle="modal" data-bs-target="#Modal_Activity_1">
                                รายละเอียดกิจกรรม
                            </button>
                        </td>
                        <td class="">รอดำเนินรายการ..</td>
                        <td><button class="btn btn-danger btn-sm btn-success">ยกเลิก</button></td>
                    </tr>
                </tbody>

                <tbody>
                    <tr>
                        <td>1/1/2568 12:02:73</td>
                        <td><img src="https://htmlcolorcodes.com/assets/images/colors/cream-color-solid-background-1920x1080.png" class="img-thumbnail" alt="กิจกรรม"></td>
                        <td>C4C ค่ายมหาลัยสู่โรงเรียนในชุมชน</td>
                        <td>1/2/2568 - 5/2/2568</td>
                        <td>0/20</td>
                        <td>
                            <button class="btn btn-outline-primary btn-sm raduis" data-bs-toggle="modal" data-bs-target="#Modal_Activity_1">
                                รายละเอียดกิจกรรม
                            </button>
                        </td>
                        <td class="">รอดำเนินรายการ..</td>
                        <td><button class="btn btn-danger btn-sm btn-success">ยกเลิก</button></td>
                    </tr>
                </tbody>

                <tbody>
                    <tr>
                        <td>1/1/2568 12:02:73</td>
                        <td><img src="https://htmlcolorcodes.com/assets/images/colors/cream-color-solid-background-1920x1080.png" class="img-thumbnail" alt="กิจกรรม"></td>
                        <td>C4C ค่ายมหาลัยสู่โรงเรียนในชุมชน</td>
                        <td>1/2/2568 - 5/2/2568</td>
                        <td>0/20</td>
                        <td>
                            <button class="btn btn-outline-primary btn-sm raduis" data-bs-toggle="modal" data-bs-target="#Modal_Activity_1">
                                รายละเอียดกิจกรรม
                            </button>
                        </td>
                        <td class="">อนุมัติ</td>
                        <td>
                            <button class="btn btn-success btn-sm " data-bs-toggle="modal" data-bs-target="#Modal_submit_pic_1">ส่งรูปภาพ</button>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div> 
    </div>

    <!-- Modal -->
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
                    <div class="success-pad">
                        <button type="button" class="btn btn-success btn-md">เข้าร่วม</button></div>
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
                                <button id="upload-btn" class="btn btn-outline-secondary btn-lg" onclick="document.getElementById('file-upload').click()">อัพโหลดรูปภาพ</button>                            </div>
                            
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
                                    output.style.display = 'block';  // แสดงภาพเมื่อเลือกไฟล์
                                    uploadBtn.style.display = 'none'; // ซ่อนปุ่มอัพโหลดหลังจากอัพโหลดไฟล์
                                }
                                reader.readAsDataURL(event.target.files[0]);
                            }
                        </script>



                    </div>
                    <div class="success-pad">
                        <button type="button" class="btn btn-success" style="width: 100px; height: 50px">ส่งรูปภาพ</button></div>
                </div>
            </div>
        </div>
    
</body>
</html>

