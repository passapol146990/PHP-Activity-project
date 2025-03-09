const x = document.querySelector(".search-container");
x.remove();
function s(event) {
    event.preventDefault();
    const form = document.querySelector("form");
    if (!form.checkValidity()) {
        Swal.fire({
            title: "warning",
            text: "กรุณากรอกข้อมูลให้ครบถ้วนก่อนสร้างกิจกรรม",
            icon: "warning"
        });
        return;
    }
    const btn = event.target;
    btn.disabled = true;
    btn.innerHTML = "กำลังสร้างกิจกรรม...";
    form.submit();
}
document.getElementById('image-upload').addEventListener('change', function(event) {
    const preview = document.getElementById('image-preview');
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
            continue; // ข้ามไฟล์นี้
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