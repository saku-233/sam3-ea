<?php
session_start();

// 安全檢查：如果未登入，強制踢回登入頁
if (!isset($_SESSION['student_logged_in']) || $_SESSION['student_logged_in'] !== true) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="zh-Hant">

<head>
    <meta charset="UTF-8">
    <title>學生主頁 - Moodle</title>
</head>

<body>
    <h1>歡迎回來！學生系統主頁</h1>
    <p>你的學號：<?php echo htmlspecialchars($_SESSION['student_id']); ?></p>
    <p>你的電郵：<?php echo htmlspecialchars($_SESSION['student_email']); ?></p>
    <br>
    <a href="logout.php">安全登出</a>
</body>

</html>