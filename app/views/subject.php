<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>รายวิชา</title>
</head>
<body class="bg-dark">
    <?php require_once __DIR__ . '/component/navbar.php'; ?>
    <div class="container p-5 text-white">
        <h1>ระบบลงทะเบียนเรียน</h1>
        <hr>
        <div class="d-block">
            <div>
                <h3>รายวิชาที่เปิดให้ลงทะเบียน</h3>
                <div class="px-5">
                    <table class="table table-dark">
                        <thead>
                          <tr>
                            <th scope="col">รหัสวิชา</th>
                            <th scope="col">ชื่อวิชา</th>
                            <th scope="col">อาจารย์ผู้สอน</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <? while ($row = $result->fetch_assoc()){ ?>
                              <tr>
                                  <td scope="row"><?= htmlspecialchars($row['sub_id']) ?></td>
                                  <td><?= htmlspecialchars($row['sub_name']) ?></td>
                                  <td><?= htmlspecialchars($row['t_name']) ?></td>
                                  <td>
                                      <a href="/registion?id=<?= htmlspecialchars($row['sub_id']) ?>" class="btn btn-primary">ลงทะเบียน</a>
                                  </td>
                              </tr>    
                          <? } ?>
                          <!-- <tr>
                            <th scope="row">CS123</th>
                            <td>1204101 การเงินการลงทุน</td>
                            <td>ดร.พัสพล สุทาธรรม</td>
                            <td>
                                <button class="btn btn-primary">ลงทะเบียน</button>
                            </td>
                          </tr> -->
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>