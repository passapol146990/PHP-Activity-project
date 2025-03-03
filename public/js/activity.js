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
//
async function API_RegisterPost(id,page) {
    const myHeaders = new Headers();
    myHeaders.append("Cookie", "PHPSESSID=db9575d5f43d4160441b3bed57e062fe");
    const formdata = new FormData();
    formdata.append("id_post", id);
    formdata.append("page", page);
    const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: formdata,
        redirect: "follow"
    };
    let res = await fetch("/api/get/register", requestOptions);
    res = await res.json();
    return res;
}
async function getRegisterPost(id){
    openPopUp("req_activity_1");
    const res = await API_RegisterPost(id,1);
    setReq_activity_1(res,id)
}function setReq_activity_1(result,pid){
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
                            <button class="btn btn-success bt_pri btn-sm" onClick="setStatusRegisterUser('${pid}','${doc.aid}',1)">อนุมัติ</button>
                            <div class="mb-2"></div>
                            <button class="btn btn-danger bt_pri btn-sm mb-2" onClick="setStatusRegisterUser('${pid}','${doc.aid}',0)">ปฏิเสธ</button>
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

    let res = await fetch("/api/get/userdetail", requestOptions);
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
    e = `<div class="content" style="width:50%;min-height:30%;">
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
//
async function setStatusRegisterUser(pid,uid,status) {
    const conf = await Swal.fire({
        title: "ชี้แจง?",
        text: `คุณต้องการ `+((status==0)?"ปฏิเสธ":"อนุมัติ")+" คำขอเข้าร่วมกดตกลงเพื่อยืนยัน",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ตกลง"
      }).then((result) => {
        if (result.isConfirmed) {
          return true
        }
        return false
    });
    if(conf){
        const myHeaders = new Headers();
        myHeaders.append("Cookie", "PHPSESSID=db9575d5f43d4160441b3bed57e062fe");
        const formdata = new FormData();
        formdata.append("pid", pid);
        formdata.append("uid", uid);
        formdata.append("status", status);
        const requestOptions = {
            method: "POST",
            headers: myHeaders,
            body: formdata,
            redirect: "follow"
        };
        let res = await fetch("/api/update/register", requestOptions);
        res = await res.json();
        if(res.status==200){
            Swal.fire({
                title: "สำเร็จ",
                text: res.message,
                icon: "success"
            });
        }else{
            Swal.fire({
                title: "แจ้งเตือน",
                text: res.message,
                icon: "warning"
            });
        }
        const respose = await API_RegisterPost(pid,1);
        setReq_activity_1(respose,pid)
    }
}   

async function DeletePost(pid,title) {
    const conf = await Swal.fire({
        title: "ชี้แจง?",
        text: `คุณต้องการลบกิจกรรม ${title} ใช่หรือไม่กดตกลงเพื่อลบกิจกรรม`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#cc0f0f",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "ตกลง"
      }).then((result) => {
        if (result.isConfirmed) {
          return true
        }
        return false
    });
    if(conf){
        window.location.href = `/activity/delete?pid=${pid}`
    }
}  