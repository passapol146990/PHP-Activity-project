document.addEventListener("DOMContentLoaded", function () {
    const preview = document.getElementById("image-preview");
    let existingImages = preview.getAttribute("data-existing-images");
    if (existingImages) {
        existingImages = existingImages.split(",");
        existingImages.forEach((imageName) => {
            if (imageName.trim() !== "") {
                let imageUrl = "/get/image?img=/post/" + imageName.trim();
                addImageToPreview(imageUrl,  imageName.trim());
            }
        });
    }

    function addImageToPreview(src ,image) {
        const div = document.createElement("div");
        div.className = "image-preview-item";
        const img = document.createElement("img");
        img.src = src;
        img.className = "preview-image";
        img.title = "รูปภาพ";
        const removeBtn = document.createElement('button');
        removeBtn.className = 'remove-btn';
        removeBtn.innerHTML = '×';
        removeBtn.title = 'ลบรูปนี้';
        removeBtn.onclick = function() {
            
            const urlParams = new URLSearchParams(window.location.search);
            const pid = urlParams.get("pid");
            div.remove();
            DeleteImage(pid,image);
            return false;
        };

        div.appendChild(img);
        div.appendChild(removeBtn);
        preview.appendChild(div);
    }
    async function DeleteImage(pid, image) {
        const myHeaders = new Headers();
        myHeaders.append("Cookie", "PHPSESSID=db9575d5f43d4160441b3bed57e062fe");
        const formdata = new FormData();
        formdata.append("pid", pid);
        formdata.append("image", image);
        const requestOptions = {
            method: "POST",
            headers: myHeaders,
            body: formdata,
            redirect: "follow"
        };
        let res = await fetch("/api/delete/image", requestOptions);
        res = await res.json();
    }
});

document.getElementById('image-upload').addEventListener('change', function(event) {
    const preview = document.getElementById('image-newupload');
    preview.innerHTML = '';
    const files = event.target.files;
    const maxSize = 2 * 1024 * 1024; // 2MB

    for (let i = 0; i < files.length; i++) {
        const file = files[i];

        if (!file.type.match('image.*')) {
            continue;
        }

        if (file.size > maxSize) {
            alert(`ไฟล์ ${file.name} มีขนาดเกิน 2MB!`);
            continue;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            const div = document.createElement('div');
            div.className = 'image-preview-item';

            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'preview-image';
            img.title = file.name;

            const removeBtn = document.createElement('button');
            removeBtn.className = 'remove-btn';
            removeBtn.innerHTML = '×';
            removeBtn.title = 'ลบรูปนี้';
            removeBtn.onclick = function() {
                div.remove();
                return false;
            };

            div.appendChild(img);
            div.appendChild(removeBtn);
            preview.appendChild(div);
        };
        reader.readAsDataURL(file);
    }
});