<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/home.css">
    <title>หน้าแรก</title>
</head>
<body>
    <?php require_once '../app/component/navbar.php'; ?>
    <?php require_once '../app/component/slide.php'; ?>
    <div class="event-section text-center bg-white pt-5">
        <div class="container">
            <h1 class="title text-start">กิจกรรมที่เปิดรับสมัคร</h1>
            <div class="row">
                <? foreach ($posts["data"] as $key => $post) { ?>
                    <div class="col-md-4 mb-4 d-flex">
                        <div class="card p-2 d-flex flex-column flex-grow-1">
                            <div class="text-end quota">18/20</div>
                            <div class="event-image">
                                <img src="/get/image?img=/post/<?= htmlspecialchars($post["image"]) ?>" alt="Event Image" width="100%" loading="lazy">
                            </div>
                            <div class="text-start event-info p-2 d-flex flex-column flex-grow-1">
                                <label class="limited-text"><?= htmlspecialchars($post["p_name"]) ?></label>
                                <p class="limited-text"><?= $post["p_date_start"] ?> - <?= $post["p_date_end"] ?></p>
                                <div class="mt-auto d-flex justify-content-between gap-2">
                                    <form class="btn btn-success col-6" action="/api/register/post" method="POST">
                                        <input type="hidden" name="id_post" value="<?php echo $post['p_id']; ?>">
                                        <button type="submit" class="btn btn-success col-6">เข้าร่วม</button>
                                    </form>
                                    <button class="btn btn-primary col-6" onClick="getDetailPost('<?= htmlspecialchars($post["p_id"]) ?>')" data-bs-toggle="modal" data-bs-target="#Modal_Activity_1">รายละเอียด</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <? } ?>
                <div class="modal fade text-font" id="Modal_Activity_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div>
                                    <h5 class="modal-title" id="exampleModalLabel">กำลังโหลดรายละเอียดกิจกรรม...</h5>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
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

            fetch("http://localhost/api/get/post", requestOptions)
                .then((response) => response.text())
                .then((result) => {
                    console.log(result);
                    result = JSON.parse(result);
                    console.log(result);
                    setModal_Activity_1(result)
                })
                .catch((error) => console.error(error));
        }

        function setModal_Activity_1(result) {
            if (result.status != 200) {
                return
            }
            const data = result.data;
            const Modal_Activity_1 = document.getElementById('Modal_Activity_1');
            const create_date = data.post_create; //วันที่ 25/2/68 19:25:40 น
            const activity_date = data.post_start + " - " + data.post_end; //20/2/2568 - 22/2/2568 (3 วัน) 
            let images = ""
            for (let i = 0; i < data.images.length; i++) {
                images += `<img src="/get/image?img=/post/${data.images[i]}" alt="${data.images[i]}" class="mx-2 rounded border" style="width: 300px; height: 250px; object-fit: cover;">`
            }
            let e = ""
            e = `<div class="modal-dialog modal-dialog-centered modal-lg">
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
                                        <img src="${data.img}" style="width: 75px; height: 75px; border-radius: 50%;" alt="รูปโปรไฟล์" loading="lazy">
                                        <h1 class="d-inline-block ms-3 mb-0">${data.fname} ${data.lname}</h1>
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
                               <form class="btn btn-success col-6" action="/api/register/post" method="POST">
                                        <input type="hidden" name="id_post" value="<?php echo $post['p_id']; ?>">
                                        <button type="submit" class="btn btn-success col-6">เข้าร่วม</button>
                                    </form>
                            </div>
                        </div>
                    </div>`
            Modal_Activity_1.innerHTML = e;
        }
    </script>
</body>

</html>
