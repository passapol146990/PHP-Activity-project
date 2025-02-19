<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>ข้อมูล</title>
</head>
<body class="bg-dark">
    <?php require_once __DIR__ . '/component/navbar.php'; ?>
    <div class="container p-5 text-white">
        <h1><?= htmlspecialchars($data['fname'].' '.$data['lname']) ?></h1></h1>
        <hr>
        <div class="d-block">
            <div>
                <h3>ข้อมูลนิสิต</h3>
                <div class="px-5">
                    <label>ชื่อ <?= htmlspecialchars($data['fname']) ?></label><br>
                    <label>นามสกุล <?= htmlspecialchars($data['lname']) ?></label><br>
                    <label>วันเกิด <?= htmlspecialchars($data['birthday']) ?></label><br>
                    <label>เบอร์โทร <?= htmlspecialchars($data['phone']) ?></label>
                </div>
            </div>
            <hr>
            <div>
                <h3>วิชาที่ลงทะเบียนเรียน</h3>
                <div class="px-5">
                    <table class="table table-dark">
                        <thead>
                          <tr>
                            <th scope="col">ลำดับ</th>
                            <th scope="col">วันที่ลงทะเบียน</th>
                            <th scope="col">ชื่อวิชา</th>
                            <th scope="col">อาจารย์ผู้สอน</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php if ($result->num_rows > 0) { ?>
                              <?php while ($row = $result->fetch_assoc()) { ?>
                                  <tr>
                                    <th scope="row">1</th>
                                    <td>$row['datatime']</td>
                                    <td>$row['rid'].$row['subject_name']</td>
                                    <td>$row['teacher_name']</td>
                                    <td>
                                        <button class="btn btn-danger">ถอนวิชา</button>
                                    </td>
                                  </tr>
                              <?php  } ?>
                            <?php } ?>
                            <!-- <tr>
                              <th scope="row">1</th>
                              <td>12/1/2568 12:00:00</td>
                              <td>1204101 การเงินการลงทุน</td>
                              <td>ดร.พัสพล สุทาธรรม</td>
                              <td>
                                  <button class="btn btn-danger">ถอนวิชา</button>
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