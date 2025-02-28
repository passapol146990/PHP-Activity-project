<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="/save/image/submit" method="post" enctype="multipart/form-data">
        <input type="file" name="image">
        <button type="submit">อัปโหลด</button>
    </form>
    <form action="/save/image/post" method="post" enctype="multipart/form-data">
        <input type="file" name="image">
        <button type="submit">อัปโหลด</button>
    </form>
</body>
</html>