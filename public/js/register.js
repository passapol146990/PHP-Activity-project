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