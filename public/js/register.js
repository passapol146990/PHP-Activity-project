var modal = [];
function openPopUp(id) {
    modal.push(document.getElementById(id));
    modal[modal.length - 1].classList.add("show");
}
function closePopUp() {
    modal.pop().classList.remove("show");
}
window.addEventListener("click", (e) => {
    try {
        if (e.target === modal[modal.length - 1]) {
            modal.pop().classList.remove("show");
        }
    } catch {}
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
}
function formatThaiDate(dateString) {
    if (!dateString) return '';

    const date = new Date(dateString);
    const thaiMonths = [
        'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน',
        'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม',
        'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'
    ];

    const day = date.getDate();
    const month = thaiMonths[date.getMonth()];
    const year = date.getFullYear() + 543; 
    return `${day} ${month} ${year}`;
}
function setModal_Activity_1(result) {
    if(result.status!=200){
        return 
    }
    const data = result.data;
    const Modal_Activity_1 = document.getElementById('Modal_Activity_1');
    const create_date = formatThaiDate(data.post_create);
    const activity_date = `${formatThaiDate(data.post_start)} - ${formatThaiDate(data.post_end)}`;
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
                <div class="align-items-center mb-3">
                    <div class="">
                            <div class="d-flex" style="overflow-x: auto; width:100%;">
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

async function cancelRegister(rid,pid,title) {
    const conf = await Swal.fire({
        title: "ชี้แจง?",
        text: `คุณต้องการยกเลิกคำขอเข้าร่วมกิจกรรม ${title} ใช่หรือไม่กดตกลงเพื่อยืนยัน`,
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
        window.location.href = `/register/cancel?rid=${rid}&pid=${pid}`
    }
}   

document.addEventListener("DOMContentLoaded", function() {
    const fileInput = document.getElementById("file-upload");
    const fileNameLabel = document.getElementById("file_name");
    const previewImg = document.getElementById("preview-img");
    const uploadBtn = document.getElementById("upload-btn");

    if (!fileInput || !fileNameLabel || !previewImg || !uploadBtn) return;

    uploadBtn.addEventListener("click", function() {
        fileInput.click();
    });
    previewImg.addEventListener("click", function() {
        fileInput.click();
    });
    function previewImage(event) {
        const files = event.target.files;
        const maxSize = 2 * 1024 * 1024; // 2MB
        if (files.length === 0) return;
        const file = files[0];
        fileNameLabel.innerText = file.name;
        if (!file.type.match("image.*")) {
            alert("กรุณาอัปโหลดไฟล์รูปภาพเท่านั้น");
            return;
        }
        if (file.size > maxSize) {
            alert(`ไฟล์ ${file.name} มีขนาดเกิน 2MB!`);
            return;
        }
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            previewImg.style.display = "block";
            uploadBtn.style.display = "none";
        };
        reader.readAsDataURL(file);
    }

    fileInput.addEventListener("change", previewImage);
});

