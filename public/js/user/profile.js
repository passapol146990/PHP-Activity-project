function escapeHtml(unsafe) {
    if (typeof unsafe !== "string") return "";
    let safe = unsafe
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");

    return safe;
}
function stribwird(text) {
    if (typeof text !== "string") return "";
    return text.length > 20 ? text.substring(0, 20) + "..." : text;
}
async function registerPost(id) {
    try{
        const formdata = new FormData();
        formdata.append("id_post", id);
        const requestOptions = {
            method: "POST",
            body: formdata,
            redirect: "follow"
        };
        let res = await fetch("/api/register/post", requestOptions);
        res = await res.json();
        if (res.status == 200) {
            Swal.fire({
                title: "สำเร็จ",
                text: res.message,
                icon: "success"
            });
        } else {
            Swal.fire({
                title: "แจ้งเตือน",
                text: res.message,
                icon: "warning"
            });
        }
        setTimeout(() => {
            window.location.reload();
        }, 1000);
    }catch{
        Swal.fire({
            title: "Error",
            text: "เกิดข้อผิดพลาดในการอัพเดทสถานะของผู้ใช้ กรุณารีหน้าเว็บแล้วลองใหม่อีกครั้ง",
            icon: "error"
        });
    }
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
function formatThaiDateTime(dateString) {
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
    const hours = date.getHours().toString().padStart(2, '0');
    const minutes = date.getMinutes().toString().padStart(2, '0');
    const seconds = date.getSeconds().toString().padStart(2, '0');
    
    return `${day} ${month} ${year} ${hours}:${minutes}:${seconds}`;
}
async function getDetailPost(id) {
    try{
        const formdata = new FormData();
        formdata.append("id_post", id);
    
        const requestOptions = {
            method: "POST",
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
    }catch{
        Swal.fire({
            title: "Error",
            text: "เกิดข้อผิดพลาดในการอัพเดทสถานะของผู้ใช้ กรุณารีหน้าเว็บแล้วลองใหม่อีกครั้ง",
            icon: "error"
        });
    }
}
function setModal_Activity_1(result) {
    if (result.status != 200) {
        return;
    }

    const data = result.data;
    const Modal_Activity_1 = document.getElementById('Modal_Activity_1');
    const create_date = formatThaiDateTime(data.post_create);
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
        buttonHtml = `<div class="text-warning col-6 d-flex justify-content-center align-items-center fw-bold">
                        <svg class="me-2" width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                            </g>
                            <g id="SVGRepo_iconCarrier">
                                <g id="style=bulk">
                                    <g id="warning-circle">
                                        <path id="vector (Stroke)" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M1.25 12C1.25 6.06294 6.06294 1.25 12 1.25C17.9371 1.25 22.75 6.06294 22.75 12C22.75 17.9371 17.9371 22.75 12 22.75C6.06294 22.75 1.25 17.9371 1.25 12Z"
                                            fill="#ffdd00"></path>
                                        <path id="vector (Stroke)_2" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12 6.25C12.4142 6.25 12.75 6.58579 12.75 7V14.1047C12.75 14.5189 12.4142 14.8547 12 14.8547C11.5858 14.8547 11.25 14.5189 11.25 14.1047V7C11.25 6.58579 11.5858 6.25 12 6.25Z"
                                            fill="#000000"></path>
                                        <path id="ellipse (Stroke)" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M11 17C11 16.4477 11.4477 16 12 16H12.01C12.5623 16 13.01 16.4477 13.01 17C13.01 17.5523 12.5623 18 12.01 18H12C11.4477 18 11 17.5523 11 17Z"
                                            fill="#000000"></path>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        รอการตรวจสอบ...
                    </div>`;
    } else if (data.user_status === "ปฏิเสธ") {
        buttonHtml = `<div class="text-danger col-6 d-flex justify-content-center align-items-center fw-bold">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"viewBox="0 0 24 24" stroke="currentColor" class="me-2"style="stroke: red; fill: white;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M6 6l12 12M6 18L18 6" />
        </svg>ปฏิเสธการเข้าร่วม</div>`;
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
                            <h3 class="d-inline-block ms-3 mb-0">${escapeHtml(data.fname)} ${escapeHtml(data.lname)}</h3>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center mb-3">
                        <div class="col-12">
                            <div class="overflow-x d-flex">
                                ${images}
                            </div>
                        </div>
                    </div>
                    <div class="text-start card p-3">
                        <p><strong>ชื่อกิจกรรม:</strong> ${escapeHtml(data.post_name)}</p>
                        <p><strong>ช่วงเวลา:</strong> ${activity_date}</p>
                        <p><strong>รายละเอียด:</strong> ${escapeHtml(data.post_about)}</p>
                        <p><strong>สถานที่:</strong> ${escapeHtml(data.post_address)}</p>
                        <p><strong>สิ่งที่ได้:</strong> ${escapeHtml(data.post_give)}</p>
                        <p><strong>จำนวนที่เปิดรับ:</strong> ${escapeHtml(data.p_max)} คน</p>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    ${buttonHtml}
                </div>
            </div>
        </div>`;

    Modal_Activity_1.innerHTML = e;
}