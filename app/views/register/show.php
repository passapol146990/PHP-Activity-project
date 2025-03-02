<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                max-height:90%;
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
                .header{
                    display: flex;
                    justify-items: center;
                    justify-content: space-between;
                    text-align: start;
                    .title-header{
                        font-size: 30px;
                    }
                }
                .body{

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
        .link-about-user-passpol{
            user-select: none;
            display: flex;
            justify-items: center;
            justify-content: center;
            font-size: small; 
            color: blue; 
            cursor: pointer;
            img{
                width: 15px;
                height:15px;
            }
            &:hover{
                transform: scale(1.02);
            }
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
                <? foreach($myactivities["data"] as $key => $doc){ ?>
                    <tr>
                        <td><?= htmlspecialchars($doc["register_datetime"]) ?></td>
                        <td><img src='/get/image?img=/post/<?= htmlspecialchars($doc['post_image']) ?>' class='img-thumbnail' alt='กิจกรรม' style='width: 200px; height: auto;'></td>
                        <td>$post_name</td>
                        <td>$post_date_start - $post_date_end</td>
                        <td>$registered_count / $post_max</td>
                        <td>
                            <button class='btn btn-outline-primary btn-sm raduis' onClick="getDetailPost('<?= htmlspecialchars($doc["post_id"]) ?>')">
                                รายละเอียดกิจกรรม
                            </button>
                        </td>
                        <td style='$status_color'>$register_status_th</td>
                        <td>$action_button</td>
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
    <script>
        var modal = [];
        function openPopUp(id){
            modal.push(document.getElementById(id));
            modal[modal.length-1].classList.add("show");
        }
        function closePopUp(){
            modal.pop().classList.remove("show");
        }
        window.addEventListener("click", (e) => {
            try{
                if (e.target === modal[modal.length-1]) {
                    modal.pop().classList.remove("show");
                }
            }catch{}
        });
        async function getDetailPost(id){
            openPopUp("Modal_Activity_1");
            const myHeaders = new Headers();
            myHeaders.append("Cookie", "PHPSESSID=db9575d5f43d4160441b3bed57e062fe");

            const formdata = new FormData();
            formdata.append("id_post", id);

            const requestOptions = {
            method: "POST",
            headers: myHeaders,
            body: formdata,
            redirect: "follow"
            };
            let res = await fetch("/api/get/post", requestOptions);
            res = await res.json();
            setModal_Activity_1(res)
        }function setModal_Activity_1(result) {
            if(result.status!=200){
                return 
            }
            const data = result.data;
            const Modal_Activity_1 = document.getElementById('Modal_Activity_1');
            const create_date = data.post_create; //วันที่ 25/2/68 19:25:40 น
            const activity_date = data.post_start+" - "+data.post_end;//20/2/2568 - 22/2/2568 (3 วัน) 
            let images = ""
            for(let i = 0;i<data.images.length;i++){
                images += `<img src="/get/image?img=/post/${data.images[i]}" alt="${data.images[i]}" class="mx-2 rounded border" style="width: 300px; height: 250px; object-fit: cover;">`
            }
            let e = ""
            e = `
                <div class="content" style="width:50%;">
                    <div class="header mb-3">
                        <div>
                            <label class="title-header">รายละเอียดกิจกรรม</label>:<label> <h5 class="card-title">${data.post_name}</h5></label><br>
                            <label class="small-text">${create_date}</label>
                        </div>
                        <button class="close-btn" style="margin-top:-10px;" onClick="closePopUp()">&times;</button>
                    </div>
                    <div class="body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="col-12">
                                    <div class="overflow-x d-flex">
                                        ${images}
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <div class="card">
                                    <div class="card-body" style="overflow-y: auto; max-height:300px;">
                                        <h5 class="card-title">${data.post_name}</h5>
                                        <p class="card-text">
                                        <b>ชื่อกิจกรรม:</b> ${data.post_name}<br>
                                        <b>ช่วงเวลา:</b> ${activity_date}<br>
                                        <b>รายละเอียด:</b> ${data.post_about}<br>
                                        <b>สถานที่:</b> ${data.post_address}<br>
                                        <b>สิ่งที่ได้:</b> ${data.post_give}<br>
                                        <b>จำนวนที่เปิดรับ:</b> ${data.post_people} คน<br>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`
            Modal_Activity_1.innerHTML = e;
        }
    </script>
</body>
</html>