<!-- app/views/contact.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Form</title>
</head>
<body>
    <?php require_once __DIR__ . '/component/navbar.php'; ?>  <!-- เรียกใช้ Navbar -->

    <h1>Contact Us</h1>

    <form action="/contact/submit" method="POST">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="5" cols="30" required></textarea><br><br>

        <button type="submit">Send</button>
    </form>
</body>
</html>
