<?php
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - จัดการกิจกรรม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- เมนูด้านข้าง -->
            <nav class="col-md-2 d-md-block bg-light sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="create_event.php">สร้างกิจกรรม</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">โปรไฟล์</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- เนื้อหาหลัก -->
            <main class="col-md-10 ms-sm-auto px-4">
                <h1 class="mt-4">Dashboard</h1>

                <!-- ส่วนกิจกรรมของฉัน -->
                <section class="mb-5">
                    <h2>กิจกรรมของฉัน</h2>
                    <div class="row">
                        <?php while($event = $my_events_result->fetch_assoc()): ?>
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($event['title']); ?></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($event['description']); ?></p>
                                    <a href="event_details.php?id=<?php echo $event['id']; ?>" class="btn btn-primary">ดูรายละเอียด</a>
                                    <a href="manage_registrations.php?event_id=<?php echo $event['id']; ?>" class="btn btn-secondary">จัดการผู้สมัคร</a>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </section>

                <!-- ส่วนกิจกรรมที่เข้าร่วม -->
                <section>
                    <h2>กิจกรรมที่เข้าร่วม</h2>
                    <div class="row">
                        <?php while($joined_event = $joined_events_result->fetch_assoc()): ?>
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($joined_event['title']); ?></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($joined_event['description']); ?></p>
                                    <a href="event_details.php?id=<?php echo $joined_event['id']; ?>" class="btn btn-primary">ดูรายละเอียด</a>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </section>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>