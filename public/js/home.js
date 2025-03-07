async function registerPost(id) {
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
    let res = await  fetch("/api/register/post", requestOptions);
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
    setTimeout(() => {
        window.location.reload();
    }, 1000);
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
async function getDetailPost(id) {
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

    fetch("/api/get/post", requestOptions)
    .then((response) => response.text())
    .then((result) => {
        result = JSON.parse(result);
        setModal_Activity_1(result)
    })
    .catch((error) => console.error(error));
}
function setModal_Activity_1(result) {
    if (result.status != 200) {
        return;
    }

    const data = result.data;
    const Modal_Activity_1 = document.getElementById('Modal_Activity_1');
    const create_date =  formatThaiDate(data.post_create);
    const activity_date = `${formatThaiDate(data.post_start)} - ${formatThaiDate(data.post_end)}`;
    let images = "";

    for (let i = 0; i < data.images.length; i++) {
        images += `<img src="/get/image?img=/post/${data.images[i]}" alt="${data.images[i]}" class="mx-2 rounded border" style="width: 300px; height: 250px; object-fit: cover;">`
    }

    let buttonHtml = "";
    if (!data.user_status || data.user_status === "") {
        buttonHtml = `<button class="btn btn-success col-6" onClick="registerPost('${data.post_id}')">เข้าร่วม</button>`;
    } else if (data.user_status === "อนุมัติ") {
        buttonHtml = `<div
                                            class="text-success col-6 d-flex justify-content-center align-items-center fw-bold">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" class="me-2"
                                                style="stroke: green; fill: white;">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            เข้าร่วมกิจกรรมแล้ว
                                        </div>`;
    } else if (data.user_status === "รอการตรวจสอบ") {
        buttonHtml = `<button class="btn btn-warning col-6" disabled>รอการตรวจสอบ</button>`;
    } else if (data.user_status === "ปฏิเสธ") {
        buttonHtml = `<div class="text-danger col-6 d-flex justify-content-center align-items-center fw-bold">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"viewBox="0 0 24 24" stroke="currentColor" class="me-2"style="stroke: red; fill: white;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M6 6l12 12M6 18L18 6" />
        // </svg>ปฏิเสธ</div>`;
    }

    let e = `
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title" id="exampleModalLabel">รายละเอียดกิจกรรม</h5>
                        <p class="small-text">${create_date}</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row d-flex align-items-center mb-3">
                        <div class="col-2 text-start"><strong>ผู้สร้าง:</strong></div>
                        <div class="col-10 d-flex align-items-center">
                            <img src="/get/image?img=/user/${data.img}" style="width: 75px; height: 75px; border-radius: 50%;" alt="รูปโปรไฟล์" loading="lazy">
                            <h3 class="d-inline-block ms-3 mb-0">${data.fname} ${data.lname}</h3>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center mb-3">
                        <div class="col-12">
                            <div class="overflow-x d-flex">
                                ${images}
                            </div>
                        </div>
                    </div>
                    <div class="text-start">
                        <p><strong>ชื่อกิจกรรม:</strong> ${data.post_name}</p>
                        <p><strong>ช่วงเวลา:</strong> ${activity_date}</p>
                        <p><strong>รายละเอียด:</strong> ${data.post_about}</p>
                        <p><strong>สถานที่:</strong> ${data.post_address}</p>
                        <p><strong>สิ่งที่ได้:</strong> ${data.post_give}</p>
                        <p><strong>จำนวนที่เปิดรับ:</strong> ${data.post_people} คน</p>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    ${buttonHtml}
                </div>
            </div>
        </div>`;

    Modal_Activity_1.innerHTML = e;
}
