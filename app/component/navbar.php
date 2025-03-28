<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Prompt', sans-serif;
    }
    body {
        background: linear-gradient(to right, #f77062, #fe5196);
        /* height: 10000px; */
        font-family: 'Prompt', sans-serif;
    }
    .navbar-component{
        z-index: 100;
        position: sticky;
        top: 0;
        height: 80px;
        display: flex;
        align-items: center;
        background-color: white;
        padding: 10px 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        .logo-container {
            width: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            &:hover {
                cursor: pointer;
                border-radius: 5px;
                .menu-user{
                    display: block;
                }
            }
            .box-logo{
                display: flex;
                justify-content: center;
                .logo {
                    width: 40px;
                    height: 40px;
                    border-radius: 50%;
                    overflow: hidden;
                    margin-right: 10px;
                }
                .logo img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }
            }
            .site-name {
                font-size: 12px;
                color: #333;
            }
            .menu-user{
                display: none;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                position: fixed;
                top: 60px;
                &:hover {
                    cursor: pointer;
                    display: block;
                }
                .menu{
                    display:block;
                    background: #fff;
                    padding: 10px;
                    text-decoration: none;
                    color: black;
                    &:hover{
                        cursor: pointer;
                        background: rgb(210, 210, 210);
                    }
                }
            }
        }
        .nav-links {
            display: flex;
            flex-grow: 1;
            .nav-item {
                text-decoration: none;
                color: #333;
                padding: 0 15px;
                position: relative;
                font-size: 16px;
                padding: 10px 20px;
                &:hover{
                    border-radius: 5px;
                    background: rgb(210, 210, 210);
                }
                .notification-badge {
                    position: absolute;
                    top: -5px;
                    right: 5px;
                    background-color: #f44336;
                    color: white;
                    border-radius: 50%;
                    width: 18px;
                    height: 18px;
                    font-size: 12px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                
            }
        }
        .search-container {
            display: flex;
            align-items: center;
            margin-left: auto;
            .search-box {
                display: flex;
                align-items: center;
                background-color:rgb(224, 223, 223);
                border-radius: 20px;
                padding: 5px 15px;
                margin-right: 10px;
                .search-input {
                    border: none;
                    background-color: transparent;
                    outline: none;
                    width: 200px;
                    padding: 5px;
                    font-size: 14px;
                    &::placeholder {
                        color: #aaa;
                    }
                }
            }
            .filter-button {
                background-color: #f44336;
                color: white;
                border: none;
                border-radius: 20px;
                padding: 5px 15px;
                display: flex;
                align-items: center;
                cursor: pointer;
                .filter-text {
                    margin-right: 5px;
                }
            }
            .search-icon {
                padding: 10px 20px;
                cursor: pointer;
                font-size: 16px;
                display: flex;
                align-items: center;
                justify-content: center;
                border:none;
                background:none;
                border-radius: 50%;
                &:hover{
                    transform: scale(1.1);
                }
            }
            input[type="date"]::-webkit-datetime-edit, input[type="date"]::-webkit-inner-spin-button, input[type="date"]::-webkit-clear-button {
  color: #fff;
  position: relative;
}

input[type="date"]::-webkit-datetime-edit-year-field{
  position: absolute !important;
  border-left:1px solid #8c8c8c;
  padding: 2px;
  color:#000;
  left: 56px;
}

input[type="date"]::-webkit-datetime-edit-month-field{
  position: absolute !important;
  border-left:1px solid #8c8c8c;
  padding: 2px;
  color:#000;
  left: 26px;
}


input[type="date"]::-webkit-datetime-edit-day-field{
  position: absolute !important;
  color:#000;
  padding: 2px;
  left: 4px;
  
}
            
        }
    }
    
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php if(isset($_GET["status"])){?>
    <script>
        Swal.fire({
            position: "center",
            icon: '<?= htmlspecialchars($_GET["status"]) ?>',
            title: <?= json_encode(isset($_GET["message"])?$_GET["message"]:"") ?>,
            showConfirmButton: false,
            timer: 1500
        }).then((result) => {
            const currentPath = new URL(document.URL).pathname;
            window.location.href = currentPath
        });
    </script>
<?php } ?>
<nav class="navbar-component">
    <div class="logo-container">
        <div>
            <div class="box-logo">
                <div class="logo">
                <img src="/get/image?img=/user/<?= htmlspecialchars($_SESSION["login_image"]) ?>" alt="Logo">
                </div>
            </div>
            <div class="site-name"><?= htmlspecialchars($_SESSION["login_name"]) ?></div>
            <script>
                const name = document.querySelector(".site-name");
                if(name.textContent.length > 15){
                    name.textContent = name.textContent.substring(0, 15) + '...';
                }
            </script>
        </div>
        <div class="menu-user">
            <a class="menu" href="/user/dashboard">
                <span>แดชบอร์ด</span>
            </a>
            <a class="menu" href="/user/setting">
                <span>ตั้งค่า</span>
            </a>
            <a class="menu" href="/logout">
                <span>ออกจากระบบ</span>
            </a>
        </div>
    </div>
    <div class="nav-links">
        <a href="/" class="nav-item">หน้าแรก</a>
        <a href="/activity/create" class="nav-item">สร้างกิจกรรม</a>
        <a href="/activity/create/show" class="nav-item" id="ac_created">กิจกรรมที่สร้าง
            <? if(isset($total_registers)&&$total_registers>0) { ?>
                <span class="notification-badge"><?= htmlspecialchars($total_registers) ?></span>
            <? } ?>
        </a>
        <a href="/activity/register/show" class="nav-item">กิจกรรมที่เข้าร่วม
            <? if(isset($waitReg)&&$waitReg>0) { ?>
                <span class="notification-badge"><?= htmlspecialchars($waitReg) ?></span>
            <? } ?>
        </a>
    </div>
    <form action="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>" method="get" class="search-container">
        <div class="search-box">
            <? if(isset($_GET["search"])) { ?>
                <input type="search" class="search-input" name="search" placeholder="ค้นหากิจกรรม..." value="<?= htmlspecialchars($_GET["search"]??"") ?>">
            <? }else{ ?>
                <input type="search" class="search-input" name="search" placeholder="ค้นหากิจกรรม..." >
            <? } ?>
        </div>
        <select class="filter-button me-2" id="filter">
            <option class="filter-text" value="none">ฟิวเตอร์</option>
            <option class="filter-text" value="all">เลือกวันที่</option>
        </select>
        <div class="filter-container" id="dateFilter" style="display: none;">
            
                <script>document.getElementById("dateFilter").style.display='block';</script>
                <?php if(isset($_GET["start_date"])) { ?>
                <label for="start_date">วันที่:</label>
                <input type="date" name="start_date" id="start_date" value="<?= htmlspecialchars($_GET['start_date']) ?>">

                <label for="end_date">ถึง:</label>
                <input type="date" name="end_date" id="end_date" value="<?= htmlspecialchars($_GET['end_date']) ?>">
              <?php } ?>
               
        </div>
        <button type="submit" class="search-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </button>
    </form>
</nav>
<script>
    document.getElementById("filter").addEventListener("change", function() {
        var filterValue = this.value;
        var dateFilter = document.getElementById("dateFilter");
        if (filterValue === "all") {
            const e = `<label for="start_date">วันที่:</label>
            <input type="date" name="start_date" id="start_date">
            <label for="end_date">ถึง:</label>
            <input type="date" name="end_date" id="end_date" >`
            dateFilter.innerHTML = e;
            dateFilter.style.display = "block";
        } else {
            dateFilter.style.display = "none";
            dateFilter.innerHTML = "";
        }
    });
</script>