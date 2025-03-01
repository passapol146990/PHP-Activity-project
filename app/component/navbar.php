<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Prompt', sans-serif;
    }

    body {
        height: 10000px;
        font-family: 'Prompt', sans-serif;
    }

    .navbar {
        position: sticky;
        top: 0;
        height: 80px;
        display: flex;
        align-items: center;
        background-color: white;
        padding: 10px 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        .logo-container {
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
                font-size: 16px;
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
                    background: #fff;
                    padding: 10px;
                    &:hover{
                        cursor: pointer;
                        background: rgb(210, 210, 210);
                    }
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
        }
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

    .search-container {
        display: flex;
        align-items: center;
        margin-left: auto;
    }

    .search-box {
        display: flex;
        align-items: center;
        background-color: #f1f1f1;
        border-radius: 20px;
        padding: 5px 15px;
        margin-right: 10px;
    }

    .search-input {
        border: none;
        background-color: transparent;
        outline: none;
        width: 200px;
        padding: 5px;
        font-size: 14px;
    }

    .search-input::placeholder {
        color: #aaa;
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
    }

    .filter-text {
        margin-right: 5px;
    }

    .search-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: white;
        margin-left: 10px;
        cursor: pointer;
    }
</style>
<nav class="navbar">
    <div class="logo-container">
        <div>
            <div class="box-logo">
                <div class="logo">
                    <img src="https://lh3.googleusercontent.com/a/ACg8ocLEtsi8D0taNDubAOmqHCRyp6Wag9lUo0Qe3lArfOI9ZEE2oj6e=s96-c" alt="Logo">
                </div>
            </div>
            <div class="site-name">สังคม ชุมชมสมุด</div>
        </div>
        <div class="menu-user">
            <div class="menu">
                <a>ตั้งค่า</a>
            </div>
            <div class="menu">
                <a>ออกจากระบบ</a>
            </div>
        </div>
    </div>
    
    <div class="nav-links">
        <a href="#" class="nav-item">สร้างกิจกรรม</a>
        <a href="#" class="nav-item">กิจกรรมที่สร้าง<span class="notification-badge">1</span></a>
        <a href="#" class="nav-item">กิจกรรมที่เข้าร่วม<span class="notification-badge">1</span></a>
    </div>
    <form action="#" method="get" class="search-container">
        <div class="search-box">
            <input type="search" class="search-input" placeholder="ค้นหากิจกรรม...">
        </div>
        <select class="filter-button">
            <option class="filter-text" value="all">ฟิวเตอร์</option>
            <option class="filter-text" value="created">กิจกรรมที่สร้าง</option>
            <option class="filter-text" value="joined">กิจกรรมที่เข้าร่วม</option>
        </select>
        <button type="submit" class="search-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </button>
    </form>
</nav>