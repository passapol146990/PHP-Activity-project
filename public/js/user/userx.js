const from = document.getElementById("update-user-from");
from.addEventListener("submit", async (e) => {
    e.preventDefault();
    const fname = from.fname.value;
    const lname = from.lname.value;
    const birthday = new Date(from.birthday.value);
    const gender = from.gender.value;

    const ageDifMs = Date.now() - birthday.getTime();
    const ageDate = new Date(ageDifMs);
    const age = Math.abs(ageDate.getUTCFullYear() - 1970);

    if (age < 12) {
        Swal.fire({
            icon: 'warning',
            title: 'โปรดทราบ',
            text: 'กรุณาระบุวันเกิดจริงๆของท่าเพื่อให้ใช้งานในระบบได้ถูกต้องที่สุด'
        });
        return;
    }
    const formdata = new FormData();
    formdata.append("fname", fname);
    formdata.append("lname", lname);
    formdata.append("birthday", from.birthday.value);
    formdata.append("gender", gender);

    const requestOptions = {
        method: "POST",
        body: formdata,
        redirect: "follow"
    };
    let res = await fetch("/update/user/data", requestOptions);
    res = await res.json();
    if(res.status==440){
        window.location.href = "/logout";
        return
    }
    Swal.fire({
        icon: (res.status==200)?'success':'warning',
        title: (res.status==200)?'สำเร็จ':'แจ้งเตือน',
        text: res.message
    });
    setTimeout(() => {
        window.location.reload();
    }, 1200);
});