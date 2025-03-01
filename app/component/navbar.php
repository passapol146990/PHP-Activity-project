<nav class="navbar">
    <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown link
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
      </ul>
        <a class="navbar-brand">Navbar</a>
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>
    <!-- <div class="navbar-left">
        <div class="dropdown profile-dropdown pointer" class="dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="<?= htmlspecialchars($_SESSION["login_image"]) ?>" alt="โปรไฟล์" >
            <span class="profile-name"><?= htmlspecialchars($_SESSION["login_name"]) ?></span>
            <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                <li><a class="dropdown-item" href="/seting">ตั้งค่า</a></li>
                <li><a class="dropdown-item" href="/logout">ออกจากระบบ</a></li>
            </ul>
        </div>
        <a href="/activity/create">สร้างกิจกรรม</a>
        <a href="#">กิจกรรมที่สร้าง 
            <span class=" top-0 start-100 translate-middle badge rounded-pill bg-danger">
                5<span class="visually-hidden">unread messages</span>
            </span></a>
        <a href="#">กิจกรรมที่เข้าร่วม <span class=" top-0 start-100 translate-middle badge rounded-pill bg-danger">
                5<span class="visually-hidden">unread messages</span>
            </span></a>
    </div>
    <div class="navbar-right">
        <div class="container-fluid">
            <form class="d-flex" role="search">
                <div class="search-container">
                    <input class="form-control" style="width: 20%;  background:pink" type="search" placeholder="ค้นหากิจกรรม..." aria-label="Search">
                    <button class="search-btn" type="submit">
                        <img src="https://cdn-icons-png.flaticon.com/512/622/622669.png" alt="ค้นหา" width="20">
                    </button>
                </div>
            </form>
        </div>
        <div class="dropdown">
            <button class="filter-btn dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                Filter
            </button>
            <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                <li><a class="dropdown-item" href="#">One</a></li>
                <li><a class="dropdown-item" href="#">Two</a></li>
                <li><a class="dropdown-item" href="#">Three</a></li>
            </ul>
        </div>
    </div> -->
</nav>