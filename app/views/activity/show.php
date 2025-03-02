<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <title>กิจกรรมที่สร้าง</title>
    <style>
        .overflow-x {
            width: 100%; 
            overflow-x: auto; 
            overflow-y: hidden; 
            white-space: nowrap;
            display: flex;
            gap: 10px;
            
            .overflow-x::-webkit-scrollbar {
                height: 8px;
            }
            
            .overflow-x::-webkit-scrollbar-thumb {
                background-color: #888;
                border-radius: 4px;
            }
            
            .overflow-x::-webkit-scrollbar-thumb:hover {
                background-color: #555;
            }
        }
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
                            <lable style="font-size:12px; font-family: 'Prompt', sans-serif;"><?= htmlspecialchars($doc['p_datetime']) ?> </lable>
                        </td>
                        <td id="title:<?= htmlspecialchars($doc["p_id"]) ?>"><?= htmlspecialchars($doc['p_name']) ?></td>
                        <td>
                            <button onClick="getDetailPost('<?= htmlspecialchars($doc["p_id"]) ?>')" class="btn btn-outline-primary btn-sm raduis">รายละเอียดกิจกรรม</button>
                        </td>
                        <td style="font-size:14px; font-family: 'Prompt', sans-serif;"><?= htmlspecialchars($doc['p_date_start']) ?> - <?= htmlspecialchars($doc['p_date_end']) ?></td>
                        <td>
                            <lable id="numberpeople:<?= htmlspecialchars($doc["p_id"]) ?>"><?= htmlspecialchars($doc['approved_registers']."/".$doc["p_max"]) ?></lable><br>
                            <div class="position-relative d-inline-block">
                                <button onClick="getRegisterPost('<?= htmlspecialchars($doc['p_id']) ?>')" class="btn btn-outline-secondary btn-sm raduis btn_secondary">คำขอเข้าร่วม</button>
                                <span class="badge-notification"><?= htmlspecialchars(($doc["pending_registers"]>0)?$doc["pending_registers"]:"") ?></span>
                            </div>
                        </td>
                        <td>
                            <p>คำขอทั้งหมด : <?= htmlspecialchars($doc['total_registers']) ?></p>
                            <p>อนุมัติ : <lable id="approved:<?= htmlspecialchars($doc["p_id"]) ?>"><?= htmlspecialchars($doc['approved_registers']) ?></lable></p>
                            <p>ปฏิเสธ : <lable id="rejected:<?= htmlspecialchars($doc["p_id"]) ?>"><?= htmlspecialchars($doc['rejected_registers']) ?></lable></p>
                            <lable id="pending:<?= htmlspecialchars($doc["p_id"]) ?>" style="display:none;"><?= htmlspecialchars($doc['pending_registers']) ?></lable>
                        </td>
                        <td>
                            <button class="btn btn-primary bt_pri btn-sm">แก้ไข</button>
                            <div class="mb-3"></div>
                            <a href="/activity/delete?pid=<?= htmlspecialchars($doc["p_id"]) ?>" class="btn btn-danger bt_pri btn-sm">ลบ</a>
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
                <button class="close-btn" style="margin-top:-10px;" onClick="closePopUp()">&times;</button>
            </div>
            <div class="body"></div>
        </div>
    </div>
    <div class="modal-passapol" id="Modal_user_data_1">
        <div class="content" style="width:50%;height:30%;">
            <div class="header mb-3">
                <div>
                    <label class="title-header">คำขอเข้าร่วมกิจกรรม</label>:<br>
                </div>
                <button class="close-btn" onClick="closePopUp()">&times;</button>
            </div>
            <div class="body text-center p-5">
                <h5>ไม่พบข้อมูลของผู้ใช้</h5>
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
            let res = await fetch("http://localhost/api/get/post", requestOptions);
            res = await res.json();
            setModal_Activity_1(res)
        }
        function setModal_Activity_1(result) {
            console.log(result)
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
        // 
        async function getRegisterPost(id){
            openPopUp("req_activity_1");
            const myHeaders = new Headers();
            myHeaders.append("Cookie", "PHPSESSID=db9575d5f43d4160441b3bed57e062fe");

            const formdata = new FormData();
            formdata.append("id_post", id);
            formdata.append("page", 1);

            const requestOptions = {
            method: "POST",
            headers: myHeaders,
            body: formdata,
            redirect: "follow"
            };

            let res = await fetch("http://localhost/api/get/register", requestOptions);
            res = await res.json();
            setReq_activity_1(res,id)
        }
        function calculateAge(birthday) {
            const birthDate = new Date(birthday);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
            }
            return age;
        }
        function setReq_activity_1(result,pid){
            const req_activity_1 = document.getElementById('req_activity_1');
            if(result.status!=200){
                return req_activity_1.innerHTML = `
                <div class="content">
                    <div class="header mb-3">
                        <div>
                            <label class="title-header">คำขอเข้าร่วมกิจกรรม</label>:<br>
                        </div>
                        <button class="close-btn" onClick="closePopUp()">&times;</button>
                    </div>
                    <div class="body text-center p-5">
                        <h5>ไม่พบคำขอร่วมในกิจกรรมนี้</h5>
                    </div>
                </div>`
            }
            const data = result.data;
            const title = document.getElementById(`title:${pid}`).textContent;
            const numberpeople = document.getElementById(`numberpeople:${pid}`).textContent;
            const pending = document.getElementById(`pending:${pid}`).textContent;
            const approved = document.getElementById(`approved:${pid}`).textContent;
            const rejected = document.getElementById(`rejected:${pid}`).textContent;
            let user = ""
            data.forEach(doc => {
                const status = (doc.status=="รอการตรวจสอบ")?`<div class="text-warning">${doc.status}</div>`:((doc.status=="อนุมัติ")?`<div class="text-success">${doc.status}</div>`:`<div class="text-danger">${doc.status}</div>`);
                user += `<div class="container">
                            <div class="d-flex justify-content-between align-items-center" style="width:100%;">
                                <div class="col-2">
                                    <label>${doc.datetime}</label>
                                </div>
                                <div class="col-2 justify-content-center align-items-center">
                                    <img src="/get/image?img=/user/${doc.image}" style="width: 50px; height: 50px; border-radius: 50%;" alt=".">
                                    <buttom class="link-about-user-passpol" onClick="SelectDtailUser('${pid}','${doc.aid}')">
                                        <img src="https://cdn-icons-png.flaticon.com/512/6388/6388049.png" alt=".">
                                        ข้อมูลเพิ่มเติม
                                    </buttom>
                                </div>
                                <div class="col-3">
                                    <p>ชื่อ ${doc.fname} ${doc.lname}</p>
                                    <p>เพศ : ${doc.gender}</p>
                                    <p>อายุ : ${calculateAge(doc.birthday)}</p>
                                </div>
                                <div class="col-2 text-center">
                                    <button class="btn btn-success bt_pri btn-sm" onClick="setStatusUser('${doc.aid}','1')">อนุมัติ</button>
                                    <div class="mb-2"></div>
                                    <button class="btn btn-danger bt_pri btn-sm mb-2" onClick="setStatusUser('${doc.aid}','0')">ปฏิเสธ</button>
                                </div>
                                <div class="d-flex justify-content-center align-items-center w-100" style="height:100px">
                                    ${status}
                                </div>
                            </div>
                        </div>`
            });
            let e = '';
            e = `
                <div class="content" style="width:50%;">
                    <div class="header">
                        <div>
                            <label class="title-header">คำขอเข้าร่วมกิจกรรม</label>:<label> <h5 class="card-title">${title}</h5></label><br>
                        </div>
                        <button class="close-btn" style="margin-top:-10px;" onClick="closePopUp()">&times;</button>
                    </div>
                    <div class="body">
                        <div>
                            <table class="table">
                                <tr style="font-size: meduim;">
                                    <td style="width: 15%;">${numberpeople}</td>
                                    <td style="width: 55%;">ยังไม่ได้ดำเนินการ : ${pending}</td>
                                    <td style="width: 15%;">อนุมัติ : ${approved}</td>
                                    <td style="width: 15%;">ปฏิเสธ : ${rejected}</td>
                                </tr>
                            </table>${user}
                        </div>
                    </div>
                </div>`
            req_activity_1.innerHTML = e;
        }
        // 
        async function SelectDtailUser(pid,uid) {
            openPopUp("Modal_user_data_1");
            const myHeaders = new Headers();
            myHeaders.append("Cookie", "PHPSESSID=db9575d5f43d4160441b3bed57e062fe");

            const formdata = new FormData();
            formdata.append("pid", pid);
            formdata.append("uid", uid);

            const requestOptions = {
                method: "POST",
                headers: myHeaders,
                body: formdata,
                redirect: "follow"
            };

            let res = await fetch("http://localhost/api/get/userdetail", requestOptions);
            res = await res.json();
            setModal_user_data_1(res)
        }function setModal_user_data_1(result){
            const Modal_user_data_1 = document.getElementById('Modal_user_data_1');
            if(result.status!=200){
                return req_activity_1.innerHTML = `
                <div class="content">
                    <div class="header mb-3">
                        <div>
                            <label class="title-header">คำขอเข้าร่วมกิจกรรม</label>:<br>
                        </div>
                        <button class="close-btn" onClick="closePopUp()">&times;</button>
                    </div>
                    <div class="body text-center p-5">
                        <h5>ไม่พบข้อมูลของผู้ใช้</h5>
                    </div>
                </div>`
            }
            const data = result.data[0];
            let e = '';
            e = `<div class="content" style="width:50%;height:30%;">
                    <div class="header">
                        <div>
                            <label class="title-header">ข้อมูลเพิ่มเติม</label>:<label> <h5>${data.fname} ${data.lname}</h5></label><br>
                        </div>
                        <button class="close-btn" style="margin-top:-10px;" onClick="closePopUp()">&times;</button>
                    </div>
                    <div class="body">
                        <div class="d-flex justify-content-center align-items-center p-5">
                            <img src="/get/image?img=/user/${data.image}" class="rounded-circle border me-4" width="150" height="150" alt="Profile Image">
                            <div class="ms-5 text-start">
                                <label><strong>ชื่อ:</strong> ${data.fname}</label><br>
                                <label><strong>นามสกุล:</strong> ${data.lname}</label><br>
                                <label><strong>วันเกิด:</strong> ${data.birthday}</label><br>
                                <label><strong>อายุ:</strong> ${calculateAge(data.birthday)}</label><br>
                                <label><strong>เพศ:</strong> ${data.gender}</label><br>
                            </div>
                        </div>
                    </div>
                </div>`
            Modal_user_data_1.innerHTML = e;
        }
    </script>
</body>
</html>