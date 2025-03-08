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
        .modal-header p {
            margin-top: auto;
            margin-bottom: 3px;
        }

        .text_show_data {
            font-family: 'Mitr', sans-serif;
            font-size: 16px;
            font-weight: 200px;

        }
        
        #profileModal {
            z-index: 1060 !important;
        }
        .modal {
            z-index: 1050 !important;
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
    <script src="../../js/activity.js"></script>
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
                            <lable style="font-size:12px; font-family: 'Prompt', sans-serif;"><?= htmlspecialchars(formatThaiDate($doc['p_datetime'])) ?> </lable>
                        </td>
                        <td id="title:<?= htmlspecialchars($doc["p_id"]) ?>"><?= htmlspecialchars($doc['p_name']??"") ?></td>
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
    <script>
        // async function openModelCheckImage(id){
            // openPopUp("check_pic");
            // const res = await API_getcheckImg(id);
            // setCheck_pic(res,id)
        // }
    </script>
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
                    <label class="title-header">ข้อมูลผู้ใช้</label>:<br>
                </div>
                <button class="close-btn" onClick="closePopUp()">&times;</button>
            </div>
            <div class="body text-center p-5">
                <h5>ไม่พบข้อมูลของผู้ใช้</h5>
            </div>
        </div>
    </div>
    <div class="modal-passapol" id="check_pic">
        <div class="content" style="width:50%;height:30%;">
            <div class="header mb-3">
                <div>
                    <label class="title-header">ตรวจสอบรูปภาพ</label>:<br>
                </div>
                <button class="close-btn" onClick="closePopUp()">&times;</button>
            </div>
            <div class="body text-center p-5">
                <h5>ไม่พบรูปภาพผู้ขอเข้าร่วม</h5>
            </div>
        </div>
    </div>
    <script>
        async function API_getcheckImg(id) {
    const myHeaders = new Headers();
    myHeaders.append("Cookie", "PHPSESSID=db9575d5f43d4160441b3bed57e062fe");
    const formdata = new FormData();
    formdata.append("pid", id);
    const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: formdata,
        redirect: "follow"
    };
    let res = await fetch("/api/get/picSubmit", requestOptions);
    res = await res.json();
    
    return res;
}
async function checkSubpic(id){
    openPopUp("check_pic");
    const res = await API_getcheckImg(id);
    setCheck_pic(res,id)
}
function setCheck_pic(result, pid) {
    const checkSubpic = document.getElementById('check_pic');
    if (result.status != 200) {
        return checkSubpic.innerHTML = `
        <div class="content">
            <div class="header mb-3">
                <div>
                    <label class="title-header">ตรวจสอบรูปภาพ</label>:<br>
                </div>
                <button class="close-btn" onClick="closePopUp()">&times;</button>
            </div>
            <div class="body text-center p-5">
                <h5>ไม่มีรูปภาพยืนยันผู้เข้าร่วมกิจกกรรม</h5>
            </div>
        </div>`;
       
    }

    let user = "";
    const data = result.data;
    data.forEach(doc => {
        const status = (doc.status_submit == "รอการตรวจสอบ") ? `<div class="text-warning">${doc.status_submit}</div>` : ((doc.status_submit == "อนุมัติ") ? `<div class="text-success">${doc.status_submit}</div>` : `<div class="text-danger">${doc.status_submit}</div>`);
        const thaiDate = formatThaiDate(doc.datetime_submit); // แปลงวันที่เป็นรูปแบบไทย
        const image = (doc.image_submit!=null)?`<img src="/get/image?img=/submit/${doc.image_submit}" style="width: 150px; height: 100px;" alt=".">`:`<label>ยังไม่ส่งรูปภาพ</label>`
        user += `
            <div class="row d-flex justify-content-between align-items-center" style="width:100%;">
                <div class="col-2">
                    <label>${thaiDate}</label> <!-- แสดงวันที่ในรูปแบบไทย -->
                </div>
                <div class="col-1 justify-content-center align-items-center">
                    <img src="/get/image?img=/user/${doc.image_user}" style="width: 50px; height: 50px; border-radius: 50%;" alt=".">
                    <buttom class="link-about-user-passpol" onClick="SelectDtailUser('${pid}','${doc.aid}')">
                        <img src="https://cdn-icons-png.flaticon.com/512/6388/6388049.png" alt=".">
                        profile
                    </buttom>
                </div>
                <div class="col-2">
                    <p>ชื่อ ${doc.fname}</p><p class="ms-2"> ${doc.lname}</p>
                    <p>เพศ : ${doc.gender}</p>
                    <p>อายุ : ${calculateAge(doc.birthday)}</p>
                </div>
                <div class="col-3 my-1 text-center">${image}</div>
                <div class="col-2 text-center">
                    <button class="btn btn-success bt_pri btn-sm" onClick="setStatusRegisterUser('${pid}','${doc.aid}',1)">อนุมัติ</button>
                    <div class="mb-2"></div>
                    <button class="btn btn-danger bt_pri btn-sm mb-2" onClick="setStatusRegisterUser('${pid}','${doc.aid}',0)">ปฏิเสธ</button>
                </div>
                <div class="col-2 ">
                    ${status}
                </div>
            </div>`;
    });

    let e = `
        <div class="content" style="width:50%;">
            <div class="header">
                <div>
                    <label class="title-header">ตรวจสอบรูปภาพ</label><br>
                </div>
                <button class="close-btn" style="margin-top:-10px;" onClick="closePopUp()">&times;</button>
            </div>
            <div class="body">
                <div>
                    ${user}
                </div>
            </div>
        </div>`;
    checkSubpic.innerHTML = e;
}
//check_pic
    </script>

    <?php if(count($data["data"])>=10){
        require_once '../app/component/buttonPage.php';
    } ?>
</body>
</html>